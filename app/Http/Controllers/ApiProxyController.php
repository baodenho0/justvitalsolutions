<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiProxyController extends Controller
{
    protected $targetUrl = 'https://getjustvital.com/api';

    public function proxyRequest(Request $request, $path = '')
    {
        // Build the target URL
        $url = $this->targetUrl . '/' . $path;

        // Get all headers from the original request
        $headers = $this->getHeadersFromRequest($request);

        // Get the request method
        $method = strtolower($request->method());

        // Get the request body/content
        $content = $request->getContent();

        // Get the Content-Type header to determine how to handle the request
        $contentType = $request->header('Content-Type', '');

        // Log the content type for debugging
        \Log::info('Content-Type: ' . $contentType);

        // Check if this is a form-data request
        $isFormData = strpos($contentType, 'multipart/form-data') !== false;
        $hasFiles = false;

        // For form-data, we need special handling
        if ($isFormData) {
            $requestData = $request->all();
            \Log::info('Handling as form-data');

            // Make sure we're getting all form fields, including empty ones
            foreach ($request->request->keys() as $key) {
                $requestData[$key] = $request->input($key);
            }

            // Check if we have any files
            $files = $request->allFiles();
            if (!empty($files)) {
                $hasFiles = true;
                \Log::info('Form contains files: ' . count($files));

                // We'll need to use a different approach for files
                // The Http client will automatically handle multipart requests with files
                foreach ($files as $key => $file) {
                    $requestData[$key] = $file;
                }
            } else {
                // If no files, treat as x-www-form-urlencoded instead
                \Log::info('Form-data without files - treating as x-www-form-urlencoded');

                // Create a clean array with just the form values
                $cleanRequestData = [];
                foreach ($requestData as $key => $value) {
                    // Only include non-null values
                    if ($value !== null) {
                        $cleanRequestData[$key] = $value;
                    }
                }

                // Replace the request data with the clean version
                $requestData = $cleanRequestData;

                $isFormData = false;
                // Set the Content-Type to x-www-form-urlencoded
                $contentType = 'application/x-www-form-urlencoded';

                // Clean up headers that might be causing issues
                // Remove any form-data related headers
                foreach ($headers as $key => $value) {
                    if (stripos($key, 'form-data') !== false || stripos($value, 'form-data') !== false) {
                        unset($headers[$key]);
                    }
                }
                \Log::info('Headers after cleaning: ' . json_encode($headers));

                \Log::info('Cleaned request data: ' . json_encode($requestData));
            }

            \Log::info('Form data after processing: ' . json_encode($requestData));
        }
        // For empty content or non-JSON content, use request->all()
        else if (empty($content) || strpos($contentType, 'application/json') === false) {
            $requestData = $request->all();
        }
        // For JSON content, try to parse it
        else {
            try {
                $requestData = $request->json()->all();
            } catch (\Exception $e) {
                \Log::warning('JSON parsing failed: ' . $e->getMessage());
                $requestData = $request->all();
            }
        }

        // Debug the request data and files
        \Log::info('Request data: ' . json_encode($requestData));
        \Log::info('Request files: ' . json_encode($request->allFiles()));
        \Log::info('Is form-data: ' . ($isFormData ? 'Yes' : 'No'));

        // Get the Accept header from the request
        $acceptHeader = $request->header('Accept');

        // Add Content-Type to headers if it exists
        // For multipart/form-data with files, we let Laravel's HTTP client set the Content-Type with the correct boundary
        // For form-data without files that was converted to x-www-form-urlencoded, we set it explicitly
        if ($contentType && (!$isFormData || !$hasFiles)) {
            $headers['Content-Type'] = $contentType;
        }

        // Add Accept header if it exists, otherwise default to application/json
        if ($acceptHeader) {
            $headers['Accept'] = $acceptHeader;
        } else {
            $headers['Accept'] = 'application/json';
        }

        // Forward the request to the target URL with the same method
        try {
            // Check if we have content and how to handle it
            $hasContent = !empty($content);

            // For form-data with files, we need to use a different approach
            if ($isFormData && $hasFiles) {
                // For form-data with files, we should use multipart
                // Log the request data before sending
                \Log::info('Sending multipart form-data request to: ' . $url);

                $response = match($method) {
                    'get' => Http::withHeaders($headers)->get($url, $requestData),
                    'post' => Http::asMultipart()->withHeaders($headers)->post($url, $requestData),
                    'put' => Http::asMultipart()->withHeaders($headers)->put($url, $requestData),
                    'patch' => Http::asMultipart()->withHeaders($headers)->patch($url, $requestData),
                    'delete' => Http::asMultipart()->withHeaders($headers)->delete($url, $requestData),
                    default => abort(405, 'Method not allowed'),
                };

                // Log the response for debugging
                \Log::info('Response status: ' . $response->status());
                \Log::info('Response body: ' . $response->body());
            }
            // For form-data without files (converted to x-www-form-urlencoded)
            else if (strpos($contentType, 'application/x-www-form-urlencoded') !== false) {
                \Log::info('Sending x-www-form-urlencoded request to: ' . $url);
                \Log::info('Using Content-Type: application/x-www-form-urlencoded');
                \Log::info('Request data (raw): ' . json_encode($requestData));
                \Log::info('Request data (urlencoded): ' . http_build_query($requestData));
                \Log::info('Original headers: ' . json_encode($headers));

                // Remove Content-Type from headers as Http::asForm() will set it automatically
                $headersWithoutContentType = $headers;
                if (isset($headersWithoutContentType['Content-Type'])) {
                    unset($headersWithoutContentType['Content-Type']);
                }
                \Log::info('Headers after removing Content-Type: ' . json_encode($headersWithoutContentType));

                $httpClient = Http::withHeaders($headersWithoutContentType);
                // For x-www-form-urlencoded, we need to ensure the data is properly formatted
                // Use http_build_query to format the data as a query string
                $formattedData = $requestData;

                // For x-www-form-urlencoded, manually encode the data
                $urlEncodedData = http_build_query($formattedData);

                // Add Content-Type header back manually
                $headersWithoutContentType['Content-Type'] = 'application/x-www-form-urlencoded';

                // Log the final request details
                \Log::info('Final request headers: ' . json_encode($headersWithoutContentType));
                \Log::info('Final request data: ' . $urlEncodedData);

                // For POST, PUT, PATCH, we'll use withBody to manually set the body
                $response = match($method) {
                    'get' => $httpClient->get($url, $formattedData),
                    'post' => Http::withHeaders($headersWithoutContentType)->withBody($urlEncodedData, 'application/x-www-form-urlencoded')->post($url),
                    'put' => Http::withHeaders($headersWithoutContentType)->withBody($urlEncodedData, 'application/x-www-form-urlencoded')->put($url),
                    'patch' => Http::withHeaders($headersWithoutContentType)->withBody($urlEncodedData, 'application/x-www-form-urlencoded')->patch($url),
                    'delete' => Http::withHeaders($headersWithoutContentType)->withBody($urlEncodedData, 'application/x-www-form-urlencoded')->delete($url),
                    default => abort(405, 'Method not allowed'),
                };

                // Log the response for debugging
                \Log::info('Response status: ' . $response->status());
                \Log::info('Response body: ' . $response->body());
            } else {
                // For non-form-data requests
                $httpClient = Http::withHeaders($headers);
                $response = match($method) {
                    'get' => $httpClient->get($url, $request->query()),
                    'post' => $hasContent ?
                        $httpClient->withBody($content, $contentType)->post($url) :
                        $httpClient->post($url, $requestData),
                    'put' => $hasContent ?
                        $httpClient->withBody($content, $contentType)->put($url) :
                        $httpClient->put($url, $requestData),
                    'patch' => $hasContent ?
                        $httpClient->withBody($content, $contentType)->patch($url) :
                        $httpClient->patch($url, $requestData),
                    'delete' => $hasContent ?
                        $httpClient->withBody($content, $contentType)->delete($url) :
                        $httpClient->delete($url, $requestData),
                    default => abort(405, 'Method not allowed'),
                };
            }

            return $response->body();
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Proxy error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get headers from the request, excluding some that should be set by the proxy
     */
    protected function getHeadersFromRequest(Request $request)
    {
        $headers = [];

        foreach ($request->headers as $key => $value) {
            // Skip headers that should be set by the proxy or that might cause issues
            if (!in_array(strtolower($key), ['host', 'content-length', 'connection'])) {
                $headers[$key] = $value[0];
            }
        }

        // Add API-specific headers
        $headers['X-Requested-With'] = 'XMLHttpRequest';

        return $headers;
    }
}
