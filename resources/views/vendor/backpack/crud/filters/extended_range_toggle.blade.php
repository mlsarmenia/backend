<li
    filter-name="{{ $filter->name }}"
    filter-type="{{ $filter->type }}"
    filter-key="{{ $filter->key }}"
    data-basic-filter="{{ $filter->options['basic_filter'] }}"
    data-range-filter="{{ $filter->options['range_filter'] }}"
    class="nav-item {{ Request::get($filter->name) ? 'active' : '' }}"
>
    <a
        class="btn text-left"
        href="#"
        aria-pressed="{{ Request::get($filter->name) ? 'true' : 'false' }}"
    >{{ $filter->label }}</a>
</li>

@push('crud_list_scripts')
    @bassetBlock('mls/filters/extended-range-toggle-v1.js')
    <script>
        jQuery(document).ready(function($) {
            var toggles = $('li[filter-type="extended_range_toggle"]');

            toggles.children('a').on('click', function(event) {
                event.preventDefault();

                var toggle = $(this).closest('li');
                var parameter = toggle.attr('filter-name');
                var basicFilter = toggle.attr('data-basic-filter');
                var rangeFilter = toggle.attr('data-range-filter');
                var url = URI(window.location.href).normalizeQuery();

                if (url.hasQuery(parameter)) {
                    url.removeQuery(parameter);
                    url.removeQuery(rangeFilter);
                } else {
                    url.removeQuery(basicFilter);
                    url.addQuery(parameter, true);
                }

                window.location.assign(normalizeAmpersand(url.toString()));
            });

            toggles.on('filter:clear', function() {
                $(this).removeClass('active').find('a').attr('aria-pressed', 'false');
            });
        });
    </script>
    @endBassetBlock
@endpush
