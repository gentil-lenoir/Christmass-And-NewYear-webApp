{{-- Banner 728x90 --}}
@props([
    'key' => env('ADSTERRA_BANNER_320x50_KEY'),
    'margin' => '0.5rem'
])

<div class="adsterra-banner banner-728x90" style="margin: {{ $margin }}; text-align: center;">
    <script type="text/javascript">
        atOptions = {
            'key' : '{{ $key }}',
            'format' : 'iframe',
            'height' : 90,
            'width' : 728,
            'params' : {}
        };
    </script>
    <script type="text/javascript" src="//www.highperformanceformat.com/{{ $key }}/invoke.js"></script>
</div>

<style>
    .banner-728x90 {
        min-height: 90px;
        min-width: 728px;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }
    
    @media (max-width: 768px) {
        .banner-728x90 {
            min-width: 300px;
            width: 100%;
        }
    }
</style>