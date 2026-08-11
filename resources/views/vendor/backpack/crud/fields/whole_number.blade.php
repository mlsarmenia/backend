@php
    $field['value'] = old_empty_or_null($field['name'], '') ?? $field['value'] ?? $field['default'] ?? '';
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    @if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if(isset($field['prefix'])) <span class="input-group-text">{!! $field['prefix'] !!}</span> @endif
        <input
            type="text"
            name="{{ $field['name'] }}"
            value="{{ $field['value'] }}"
            inputmode="numeric"
            pattern="[0-9]*"
            bp-field-main-input
            data-init-function="bpFieldInitWholeNumberElement"
            @include('crud::fields.inc.attributes')
        >
        @if(isset($field['suffix'])) <span class="input-group-text">{!! $field['suffix'] !!}</span> @endif
    @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

@push('crud_fields_scripts')
    @bassetBlock('mls/fields/whole-number-v1.js')
    <script>
        function bpFieldInitWholeNumberElement(element) {
            var input = element[0];

            if (input.dataset.wholeNumberInitialized) {
                return;
            }

            input.dataset.wholeNumberInitialized = 'true';

            function digitsOnly(value) {
                return value.replace(/[^0-9]/g, '');
            }

            input.addEventListener('beforeinput', function(event) {
                if (event.data && /[^0-9]/.test(event.data)) {
                    event.preventDefault();
                }
            });

            input.addEventListener('paste', function(event) {
                var pastedValue = (event.clipboardData || window.clipboardData).getData('text');
                var sanitizedValue = digitsOnly(pastedValue);

                if (pastedValue !== sanitizedValue) {
                    event.preventDefault();

                    var selectionStart = input.selectionStart ?? input.value.length;
                    var selectionEnd = input.selectionEnd ?? input.value.length;
                    input.setRangeText(sanitizedValue, selectionStart, selectionEnd, 'end');
                    input.dispatchEvent(new Event('input', { bubbles: true }));
                }
            });

            input.addEventListener('input', function() {
                var sanitizedValue = digitsOnly(input.value);

                if (input.value !== sanitizedValue) {
                    input.value = sanitizedValue;
                }
            });
        }
    </script>
    @endBassetBlock
@endpush
