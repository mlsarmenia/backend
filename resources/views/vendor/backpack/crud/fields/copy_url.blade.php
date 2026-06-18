@php
    $value = $field['value'] ?? '';
@endphp

<div @include('crud::fields.inc.wrapper_start') >
    <label>{!! $field['label'] !!}</label>

    <div class="input-group">
        <input
            type="text"
            name="{{ $field['name'] }}"
            value="{{ $value }}"
            readonly
            class="form-control"
        >
        <button
            class="btn btn-outline-secondary"
            type="button"
            onclick="navigator.clipboard.writeText('{{ $value }}').then(() => new Noty({type:'success', text:'Copied!'}).show())"
        >
            <i class="la la-copy"></i>
        </button>
    </div>
</div>
