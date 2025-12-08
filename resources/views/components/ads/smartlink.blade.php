{{-- Smartlink Ad --}}
@props([
    'key' => env('ADSTERRA_SMARTLINK_KEY'), 
])

<div style="margin: 10px 0;">
    <script 
        async 
        data-cfasync="false" 
        src="//pl{{ $key }}.effectivegatecpm.com/{{ $key }}/invoke.js"
    ></script>
    <div id="container-smartlink-{{ $key }}"></div>
</div>