@props([
    'key' => env('ADSTERRA_SOCIAL_BAR_KEY'),
    'margin' => '0.5rem'
])

@if(\App\Http\Controllers\AdManagementController::isAdEnabled('social_bar'))
    @php
        $adKey = $key ?: \App\Http\Controllers\AdManagementController::getAdKey('social_bar');
    @endphp

    @if($adKey)
        <div class="adsterra-social-bar" style="margin: {{ $margin }};">
            <script
                type='text/javascript'
                src='//pl{{ $adKey }}.effectivegatecpm.com/{{ $adKey }}.js'
            ></script>
        </div>
    @endif
@endif
