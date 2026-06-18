@can('update', $entry)
    @if (!$crud->model->translationEnabled())


        @if($entry->estate_status_id == 8)
            @if($entry->estate_type_id == 1)
                @php $url = url('/admin/estate/'.$entry->getKey().'/edit?action=recover'); @endphp
            @elseif($entry->estate_type_id == 2)
                @php $url = url('/admin/house/'.$entry->getKey().'/edit?action=recover'); @endphp
            @elseif($entry->estate_type_id == 3)
                @php $url = url('/admin/commercial/'.$entry->getKey().'/edit?action=recover'); @endphp
            @elseif($entry->estate_type_id == 4)
                @php $url = url('/admin/land/'.$entry->getKey().'/edit?action=recover'); @endphp
            @elseif($entry->estate_type_id == 5)
                @php $url = url('/admin/townhouse/'.$entry->getKey().'/edit?action=recover'); @endphp
            @else
                @php $url = null; @endphp
            @endif

            @if($url)
                <a href="{{ $url }}" title="Վերականգնել" aria-label="Վերականգնել" class="btn btn-sm btn-link">
                    <i class="la la-spinner"></i>
                </a>
            @endif
        @endif




    @else

        {{-- show button group --}}
        <div class="btn-group">
            <a href="{{ url($crud->route.'/'.$entry->getKey().'/edit?action=recover') }}" class="btn btn-sm btn-link pr-0"><i class="la la-spinner"></i> {{ trans('backpack::crud.preview') }}</a>
            <a class="btn btn-sm btn-link dropdown-toggle text-primary pl-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">{{ trans('backpack::crud.preview') }}:</li>
                @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                    <a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/edit?action=recover') }}?_locale={{ $key }}">{{ $locale }}</a>
                @endforeach
            </ul>
        </div>

    @endif
@endcan
