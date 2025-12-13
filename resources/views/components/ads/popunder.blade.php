{{-- Native Banner Ad --}}
@props([
    'key' => env('ADSTERRA_POPUNDER_KEY'),
])

<div class="adsterra-native" style="text-align: center;">
    <script
        type="text/javascript"
        src="https://pl28251515.effectivegatecpm.com/ed757b08360db2ad11f1d38b1a1d1cb1/invoke.js"
    ></script>
    <div id="container-{{ $key }}"></div>
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