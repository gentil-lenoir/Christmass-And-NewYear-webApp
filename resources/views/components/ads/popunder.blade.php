{{-- Popunder Ad --}}
@props([
    'key' => env('ADSTERRA_POPUNDER_KEY'),
])

@if(\App\Http\Controllers\AdManagementController::isAdEnabled('popunder'))
    @php
        $adKey = $key ?: \App\Http\Controllers\AdManagementController::getAdKey('popunder');
    @endphp

    @if($adKey)
        {{-- Le popunder s'exécute via le script --}}
        <script type='text/javascript'>
            var atOptions = {
                'key' : '{{ $adKey }}',
                'format' : 'iframe',
                'height' : 50,
                'width' : 320,
                'params' : {}
            };
        </script>
        <script type='text/javascript' src='//www.highperformanceformat.com/{{ $adKey }}/invoke.js'></script>
    @endif
@endif
