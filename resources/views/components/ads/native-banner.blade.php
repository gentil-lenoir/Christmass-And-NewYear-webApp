{{-- Native Banner Ad --}}
@props([
    'key' => env('ADSTERRA_NATIVE_KEY'),
    'margin' => '0.5rem'
])

<div class="adsterra-native" style="margin: {{ $margin }}; text-align: center;">
    <script 
        async 
        data-cfasync="false" 
        src="//pl{{ $key }}.effectivegatecpm.com/{{ $key }}/invoke.js"
    ></script>
    <div id="container-native-{{ $key }}"></div>
</div>

<style>
    .adsterra-native {
        min-height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }
</style>