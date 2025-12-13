{{-- Social Bar Ad --}}
@props([
    'key' => env('ADSTERRA_SOCIAL_KEY'),
    'enabled' => true,
    'margin' => '0.5rem'
])

@if(filter_var($enabled, FILTER_VALIDATE_BOOLEAN) && !empty($key))
    <div class="adsterra-social-bar" style="margin: {{ $margin }};">
        <script
            type='text/javascript'
            src='//pl{{ $key }}.effectivegatecpm.com/{{ $key }}.js'
        ></script>
    </div>
@endif

<style>
    .adsterra-social-bar {
        min-height: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        padding: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .adsterra-social-bar::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.3;
    }
</style>