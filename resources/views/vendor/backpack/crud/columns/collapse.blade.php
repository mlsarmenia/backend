{{-- regular object attribute --}}
@php

    $column['value'] = $column['value'] ?? data_get($entry, $column['name']);
    $column['escaped'] = $column['escaped'] ?? true;
    $column['limit'] = $column['limit'] ?? 32;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['text'] = $column['default'] ?? '-';

    if($column['value'] instanceof \Closure) {
        $column['value'] = $column['value']($entry);
    }

    if(is_array($column['value'])) {
        $column['value'] = json_encode($column['value']);
    }

    if(!empty($column['value'])) {
        $column['text'] = $column['prefix'].Str::limit($column['value'], $column['limit'], '…').$column['suffix'];
    }
@endphp

    <!-- Button to trigger the collapse -->
<a  data-toggle="collapse"
    style="    width: 100%;
    display: block;
    background: #eee;
    padding: 16px;"
    href="#collapse--{{ $column['name'] }}" class="collapse-link collapsed" role="button" aria-expanded="false" aria-controls="collapse--{{ $column['name'] }}">
    {{ $column['label'] }}
</a>

<!-- Content to be collapsed -->
<div id="collapse--{{ $column['name']}}" class="collapse mt-3">
    <div class="card card-body">{{ $column['text'] }}</div>
</div>

