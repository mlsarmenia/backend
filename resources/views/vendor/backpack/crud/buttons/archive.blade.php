@can('update', $entry)
    @if (!$crud->model->translationEnabled())


        @if($entry->estate_status_id == 6 || $entry->estate_status_id == 7)
            @php
                $url = null;
                if ($entry->estate_type_id == 1) {
                    $url = url('/admin/estate/'.$entry->getKey().'/edit?action=archive#lracvoucich');
                } elseif ($entry->estate_type_id == 2) {
                    $url = url('/admin/house/'.$entry->getKey().'/edit?action=archive#lracvoucich');
                } elseif ($entry->estate_type_id == 3) {
                    $url = url('/admin/commercial/'.$entry->getKey().'/edit?action=archive#lracvoucich');
                } elseif ($entry->estate_type_id == 4) {
                    $url = url('/admin/land/'.$entry->getKey().'/edit?action=archive#lracvoucich');
                } elseif ($entry->estate_type_id == 5) {
                    $url = url('/admin/townhouse/'.$entry->getKey().'/edit?action=archive#lracvoucich');
                }
            @endphp

            @if($url)
                <a href="{{ $url }}" class="btn btn-sm btn-link"  title="Արխիվ"
                   aria-label="Արխիվ"><i class="la la-file-download"></i></a>
            @endif
        @endif




    @else

        {{-- show button group --}}
        <div class="btn-group">
            <a href="{{ url($crud->route.'/'.$entry->getKey().'/edit?action=archive') }}" class="btn btn-sm btn-link pr-0"><i class="la la-file-download"></i> {{ trans('backpack::crud.preview') }}</a>
            <a class="btn btn-sm btn-link dropdown-toggle text-primary pl-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">{{ trans('backpack::crud.preview') }}:</li>
                @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                    <a class="dropdown-item" href="{{ url($crud->route.'/'.$entry->getKey().'/edit?action=archive') }}?_locale={{ $key }}">{{ $locale }}</a>
                @endforeach
            </ul>
        </div>

    @endif
@endcan
