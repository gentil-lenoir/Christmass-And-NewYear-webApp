{{-- Smartlink Ad --}}
@props([
    'key' => null,
])

@if(\App\Http\Controllers\AdManagementController::isAdEnabled('smartlink'))
    @php
        $adKey = $key ?: \App\Http\Controllers\AdManagementController::getAdKey('smartlink');
    @endphp

    @if($adKey)
        <div style="margin: 10px 0;">
            <script
                async
                data-cfasync="false"
                src="//pl{{ $adKey }}.effectivegatecpm.com/{{ $adKey }}/invoke.js"
            ></script>
            <div id="container-smartlink-{{ $adKey }}"></div>
        </div>
    @endif
@endif
