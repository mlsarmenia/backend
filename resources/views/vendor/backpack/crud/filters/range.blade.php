{{-- Example Backpack CRUD filter --}}
<li filter-name="{{ $filter->name }}"
    filter-type="{{ $filter->type }}"
    filter-key="{{ $filter->key }}"
	class="nav-item dropdown rangeFilterWrapper {{ Request::get($filter->name)?'active':'' }} col-{{ $filter->options['col']  ?? ''}}">


			<div class="form-group backpack-filter mb-0">
					<?php
                        $from = '';
                        $to = '';
                        if ($filter->currentValue) {
                            $range = (array) json_decode($filter->currentValue);
                            $from = $range['from'];
                            $to = $range['to'];
                        }
                    ?>
					<div class="input-group">


                        <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $filter->label }}</a>
				        <input class="form-control range-input pull-right from"
				        		type="number"
									@if($from)
										value = "{{ $from }}"
									@endif
									@if(array_key_exists('label_from', $filter->options))
										placeholder = "{{ $filter->options['label_from'] }}"
									@else
										placeholder = "սկսած"
									@endif
				        		>
								<input class="form-control range-input pull-right to"
				        		type="number"
									@if($to)
										value = "{{ $to }}"
									@endif
									@if(array_key_exists('label_to', $filter->options))
										placeholder = "{{ $filter->options['label_to'] }}"
									@else
										placeholder = "մինչև"
									@endif
				        		>
				        <div class="input-group-append range-filter-{{ $filter->key }}-clear-button">
				          <a class="input-group-text" href=""><i class="la la-times"></i></a>
				        </div>
				    </div>
			</div>
  </li>


{{-- ########################################### --}}
{{-- Extra CSS and JS for this particular filter --}}

{{-- FILTERS EXTRA CSS --}}
{{-- push things in the after_styles section --}}

{{-- @push('crud_list_styles')
	no css
@endpush --}}


{{-- FILTERS EXTRA JS --}}
{{-- push things in the after_scripts section --}}


{{-- FILTER JAVASCRIPT CHECKLIST

- redirects to a new URL for standard DataTables
- replaces the search URL for ajax DataTables
- users have a way to clear this filter (and only this filter)
- filter:clear event on li[filter-name], which is called by the "Remove all filters" button, clears this filter;

END OF FILTER JAVSCRIPT CHECKLIST --}}

@push('crud_list_scripts')
	<script>
		jQuery(document).ready(function($) {
            var shouldUpdateUrl = false;
			$("li[filter-key={{ $filter->key }}] .from, li[filter-key={{ $filter->key }}] .to").change(function(e) {
				e.preventDefault();
				var from = $("li[filter-key={{ $filter->key }}] .from").val();
				var to = $("li[filter-key={{ $filter->key }}] .to").val();
                var filterName = $(this).attr('data-filter-name');
                var element = $(this);
                let currentValue = element.find(":selected").text();
                let filter_name_value = $("li[filter-key='{{ $filter->key }}']").find('.nav-link.dropdown-toggle');
                let filter_name_origin_value = filter_name_value.text();

                // console.log(from)

				if (from || to) {
					var range = {
						'from': from,
						'to': to
					};
					var value = JSON.stringify(range);
                    // filter_name_value.html('<strong>'+filter_name_origin_value +': ' + from + ' - ' + to +'</strong>');

				} else {
					//this change to empty string,because addOrUpdateUriParameter method just judgment string
					var value = '';
				}
				var parameter = '{{ $filter->name }}';

				var new_url = updateDatatablesOnFilterChange(parameter, value, value || shouldUpdateUrl);
				shouldUpdateUrl = false;

				// mark this filter as active in the navbar-filters
				if (URI(new_url).hasQuery('{{ $filter->name }}', true)) {
					$('li[filter-key={{ $filter->key }}]').removeClass('active').addClass('active');



				}
			});

			$('li[filter-key={{ $filter->key }}]').on('filter:clear', function(e) {
				$('li[filter-key={{ $filter->key }}]').removeClass('active');
				$("li[filter-key={{ $filter->key }}] .from").val("");
				$("li[filter-key={{ $filter->key }}] .to").val("");
				$("li[filter-key={{ $filter->key }}] .to").trigger('change');
			});

			// focus on the input when filter is open
			$('li[filter-key={{ $filter->key }}] a').on('click', function(e) {
				setTimeout(() => {
					$("li[filter-key={{ $filter->key }}] .from").focus();
				}, 50);
			});

			// range clear button
			$(".range-filter-{{ $filter->key }}-clear-button").click(function(e) {
				e.preventDefault();
                shouldUpdateUrl = true;
				$('li[filter-key={{ $filter->key }}]').trigger('filter:clear');
			})

		});
	</script>
@endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
