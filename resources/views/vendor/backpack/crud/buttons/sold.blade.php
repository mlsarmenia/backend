@can('update', $entry)
    @if (!$crud->model->translationEnabled())


        @if($entry->estate_status_id != 8)
            @php
                $url = null;
                if (in_array($entry->estate_type_id, [1, 2, 3, 4])) {
                    $url = url('/admin/estate/'.$entry->getKey().'/edit?action=selled#lracvoucich');
                } elseif ($entry->estate_type_id == 5) {
                    $url = url('/admin/townhouse/'.$entry->getKey().'/edit?action=selled#lracvoucich');
                }
            @endphp

            @if($url)
                <a href="{{ $url }}"  title="Վաճառք"
                   aria-label="Վաճառք" class="btn btn-sm btn-link"><i class="la la-check-square"></i></a>
            @endif
        @endif




    @else

        {{-- show button group --}}
        <div class="btn-group">
            <a href="{{ url($crud->route.'/'.$entry->getKey().'/edit?action=selled') }}" class="btn btn-sm btn-link pr-0"><i class="la la-check-square"></i> {{ trans('backpack::crud.preview') }}</a>
            <a class="btn btn-sm btn-link dropdown-toggle text-primary pl-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">{{ trans('backpack::crud.preview') }}:</li>
                @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                    <a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/edit?action=selled') }}?_locale={{ $key }}">{{ $locale }}</a>
                @endforeach
            </ul>
        </div>

    @endif
@endcan
