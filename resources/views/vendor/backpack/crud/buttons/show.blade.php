@if ($crud->hasAccess('show'))
	@if (!$crud->model->translationEnabled())


    @if($entry->contact_type_id)
        @if($entry->contact_type_id == 1)
            <a href="{{ url('/admin/seller/'.$entry->getKey().'/show?type=viewOnly') }}"
               class="btn btn-sm btn-link"><i class="la la-eye"></i></a>
        @endif
        @if($entry->contact_type_id == 2)
            <a href="{{ url('/admin/owner/'.$entry->getKey().'/show?type=viewOnly') }}"
               class="btn btn-sm btn-link"><i class="la la-eye"></i></a>
        @endif
        @if($entry->contact_type_id == 3)
            <a href="{{ url('/admin/agent/'.$entry->getKey().'/show?type=viewOnly') }}"
               class="btn btn-sm btn-link"><i class="la la-eye"></i></a>
        @endif
        @if($entry->contact_type_id == 4)
            <a href="{{ url('/admin/buyer/'.$entry->getKey().'/show?type=viewOnly') }}"
               class="btn btn-sm btn-link"><i class="la la-eye"></i></a>
        @endif
        @if($entry->contact_type_id == 5)
            <a href="{{ url('/admin/renter/'.$entry->getKey().'/show?type=viewOnly') }}"
               class="btn btn-sm btn-link"><i class="la la-eye"></i></a>
        @endif
    @else
        <a href="{{ url($crud->route.'/'.$entry->getKey().'/show?type=viewOnly') }}" class="btn btn-sm btn-link"><i class="la la-eye"></i> </a>
    @endif



	@else

	{{-- show button group --}}
	<div class="btn-group">
	  <a href="{{ url($crud->route.'/'.$entry->getKey().'/show?type=viewOnly') }}" class="btn btn-sm btn-link pr-0"><i class="la la-eye"></i> {{ trans('backpack::crud.preview') }}</a>
	  <a class="btn btn-sm btn-link dropdown-toggle text-primary pl-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    <span class="caret"></span>
	  </a>
	  <ul class="dropdown-menu dropdown-menu-right">
  	    <li class="dropdown-header">{{ trans('backpack::crud.preview') }}:</li>
	  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
		  	<a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/show?type=viewOnly') }}?_locale={{ $key }}">{{ $locale }}</a>
	  	@endforeach
	  </ul>
	</div>

	@endif
@endif
