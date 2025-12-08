{{-- Popunder Ad --}}
@props([
    'key' => env('ADSTERRA_POPUNDER_KEY'), 
])

{{-- Le popunder s'exécute via le script --}}
<script type='text/javascript'>
    var atOptions = {
        'key' : '{{ $key }}',
        'format' : 'iframe',
        'height' : 50,
        'width' : 320,
        'params' : {}
    };
</script>
<script type='text/javascript' src='//www.highperformanceformat.com/{{ $key }}/invoke.js'></script>