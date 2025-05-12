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

        // Create HTTP client with headers
        $httpClient = Http::withHeaders($headers);

        // Forward the request to the target URL with the same method
        try {
            $response = match($method) {
                'get' => $httpClient->get($url, $request->query()),
                'post' => $httpClient->withBody($content, $request->header('Content-Type', 'application/json'))->post($url),
                'put' => $httpClient->withBody($content, $request->header('Content-Type', 'application/json'))->put($url),
                'patch' => $httpClient->withBody($content, $request->header('Content-Type', 'application/json'))->patch($url),
                'delete' => $httpClient->delete($url, $request->all()),
                default => abort(405, 'Method not allowed'),
            };

            // Create a response with the same status code and body
            $proxyResponse = response($response->body(), $response->status());

            // Copy headers from the target response to our response
            foreach ($response->headers() as $key => $value) {
                // Skip headers that Laravel will set
                if (!in_array(strtolower($key), ['content-length'])) {
                    $proxyResponse->header($key, $value);
                }
            }

            return $proxyResponse;
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

        return $headers;
    }
}
