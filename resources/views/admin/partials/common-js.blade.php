{{-- Common JavaScript for all admin pages --}}
<script src="{{ asset('js/admin-common.js') }}"></script>

{{-- Add any page-specific JavaScript below this line --}}
@if(isset($pageSpecificJs))
    {!! $pageSpecificJs !!}
@endif
