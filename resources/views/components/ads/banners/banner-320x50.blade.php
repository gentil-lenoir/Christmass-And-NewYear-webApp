{{-- Banner 320x50 --}}
@props([
    'key' => env('ADSTERRA_BANNER_320x50_KEY'),
    'margin' => '0.5rem'
])

<div class="adsterra-banner banner-320x50" style="margin: {{ $margin }}; text-align: center;">
    <script type="text/javascript">
        atOptions = {
            'key' : '{{ $key }}',
            'format' : 'iframe',
            'height' : 50,
            'width' : 320,
            'params' : {}
        };
    </script>
    <script type="text/javascript" src="//www.highperformanceformat.com/{{ $key }}/invoke.js"></script>
</div>

<style>
    .banner-320x50 {
        min-height: 50px;
        min-width: 320px;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }
    
    @media (max-width: 480px) {
        .banner-320x50 {
            min-width: 280px;
            width: 95%;
        }
    }
</style>