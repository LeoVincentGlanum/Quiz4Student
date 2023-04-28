@php
    $field['value'] = old_empty_or_null($field['name'], '') ?? $field['value'] ?? $field['default'] ?? '';
    $field['config'] = array_merge([
        'initialCountry' => $field['value'] ? false : 'auto',
        'separateDialCode' => true,
        'nationalMode' => true,
        'autoHideDialCode' => false,
        'placeholderNumberType' => 'MOBILE',
        'utilsScript' => asset('packages/intl-tel-input/build/js/utils.js'),
        'hiddenInput' => $field['name'],
        'customContainer' => 'form-group',
    ], $field['config'] ?? []);
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>

    @include('crud::fields.inc.translatable_icon')

    <input
        type="tel"
        data-config="{{json_encode($field['config'])}}"
        bp-field-main-input
        data-init-function="bpFieldInitPhoneElement"
        value="{{ $field['value'] }}"
        @include('crud::fields.inc.attributes')
    >
    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        {{-- include intl-tel-input css --}}
        @loadOnce('packages/intl-tel-input/build/css/intlTelInput.min.css')
        @loadOnce('phone_field_custom_styles')
        <style>
        .iti { width: 100%; margin-bottom: 0rem !important;}
        .iti__country-name, .iti__selected-dial-code { color: #1b2a4e !important; }
        .iti__country-list { z-index: 3!important; }
        </style>
        @endLoadOnce
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        {{-- include intl-tel-input js --}}
        @loadOnce('packages/intl-tel-input/build/js/intlTelInput.min.js')
        @loadOnce('bpFieldInitintlTelElement')
        <script>
            function bpFieldInitPhoneElement(element) {
                let $phoneConfig = element.data('config');

                var input = element[0];
                var countryCode = 'us';

                if($phoneConfig.initialCountry === 'auto') {
                    $phoneConfig.geoIpLookup = function(success, failure) {
                        $.get('https://ipinfo.io', function() {}, 'jsonp').always(function(resp) {
                            countryCode = (resp && resp.country) ? resp.country : countryCode;
                            success(countryCode);
                        });
                    }
                }

                /* Init phone object */
                var iti = window.intlTelInput(input, $phoneConfig);

                iti.promise.then(function() {
                    if (input.value.trim().length > 0) {
                        iti.setCountry(countryCode);
                    }

                    //Fix error classes
                    if(element.parent().find('.invalid-feedback').length > 0) {
                        let error = element.parent().find('.invalid-feedback');
                        $(error).appendTo(element.parent().parent());
                        element.parent().find('.invalid-feedback').remove();
                        element.parent().removeClass('text-danger');
                        element.parent().parent().addClass('text-danger');
                    }
                });
            }
        </script>
        @endLoadOnce
    @endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
