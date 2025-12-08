@props([
    'key' => env('ADSTERRA_SOCIAL_BAR_KEY'), 
    'margin' => '0.5rem'
])

<div class="adsterra-social-bar" style="margin: {{ $margin }};">
    <script 
        type='text/javascript' 
        src='//pl{{ $key }}.effectivegatecpm.com/{{ $key }}.js'
    ></script>
</div>