{{-- Banner 300x250 --}}
@props([
    'key' => env('ADSTERRA_BANNER_300x250_KEY'),
    'margin' => '0.5rem'
])

<div class="adsterra-banner banner-300x250" style="margin: {{ $margin }}; text-align: center;">
    <script type="text/javascript">
        atOptions = {
            'key' : '{{ $key }}',
            'format' : 'iframe',
            'height' : 250,
            'width' : 300,
            'params' : {}
        };
    </script>
    <script type="text/javascript" src="//www.highperformanceformat.com/{{ $key }}/invoke.js"></script>
</div>

<style>
    .banner-300x250 {
        min-height: 250px;
        min-width: 300px;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
    }
    
    @media (max-width: 768px) {
        .banner-300x250 {
            min-width: 250px;
            width: 90%;
        }
    }
</style>