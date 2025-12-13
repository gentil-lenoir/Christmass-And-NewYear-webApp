{{-- Banner 160x300 --}}
@props([
    'key' => env('ADSTERRA_BANNER_160x300_KEY'),
    'margin' => '0.5rem'
])

<div class="adsterra-banner banner-160x300" style="margin: {{ $margin }}; text-align: center;">
    <script type="text/javascript">
        atOptions = {
            'key' : '{{ $key }}',
            'format' : 'iframe',
            'height' : 300,
            'width' : 160,
            'params' : {}
        };
    </script>
    <script type="text/javascript" src="https://www.highperformanceformat.com/{{ $key }}/invoke.js"></script>
</div>

<style>
    .banner-160x300 {
        min-height: 300px;
        min-width: 160px;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }
    
    @media (max-width: 768px) {
        .banner-160x300 {
            min-width: 120px;
            min-height: 225px;
        }
    }
</style>