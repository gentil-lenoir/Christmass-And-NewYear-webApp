{{-- Smartlink Ad --}}
@props([
    'key' => env('ADSTERRA_SMARTLINK_KEY'),
    'enabled' => true,
    'margin' => '10px 0'
])

@if(filter_var($enabled, FILTER_VALIDATE_BOOLEAN) && !empty($key))
    <div class="adsterra-smartlink" style="margin: {{ $margin }};">
        <script
            type="text/javascript"
            async
            data-cfasync="false"
            src="//pl{{ $key }}.effectivegatecpm.com/{{ $key }}/invoke.js"
        ></script>
        <div id="container-smartlink-{{ $key }}"></div>
    </div>
@endif

<style>
    .adsterra-smartlink {
        min-height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        padding: 15px;
        text-align: center;
    }
    
    .adsterra-smartlink:hover {
        background: #f5f5f5;
        border-color: #d0d0d0;
    }
</style>