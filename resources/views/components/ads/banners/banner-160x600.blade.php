{{-- Banner 160x600 (Skyscraper) --}}
@props([
    'key' => env('ADSTERRA_BANNER_160x600_KEY'),
    'margin' => '0.5rem',
    'float' => 'right'  {{-- 'left', 'right', ou 'none' --}}
])

<div class="adsterra-banner banner-160x600 {{ $float !== 'none' ? 'float-' . $float : '' }}" 
     style="margin: {{ $margin }}; text-align: center;">
    <script type="text/javascript">
        atOptions = {
            'key' : '{{ $key }}',
            'format' : 'iframe',
            'height' : 600,
            'width' : 160,
            'params' : {}
        };
    </script>
    <script type="text/javascript" src="https://www.highperformanceformat.com/{{ $key }}/invoke.js"></script>
</div>

<style>
    .banner-160x600 {
        min-height: 600px;
        min-width: 160px;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .float-left {
        float: left;
        margin-right: 20px;
    }
    
    .float-right {
        float: right;
        margin-left: 20px;
    }
    
    @media (max-width: 768px) {
        .banner-160x600 {
            float: none;
            margin: 1rem auto;
            min-width: 120px;
            min-height: 400px;
        }
    }
</style>