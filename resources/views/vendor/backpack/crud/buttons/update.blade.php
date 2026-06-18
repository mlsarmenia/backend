@can('update', $entry)
    @if (!$crud->model->translationEnabled())
        {{-- Single edit button --}}

        @php
            $url = null;
            if ($entry->estate_type_id && !$entry->contact_type_id) {
                if ($entry->estate_type_id == 1) {
                    $url = url($crud->route.'/'.$entry->getKey().'/edit?estateType='.$entry->estate_type_id);
                } elseif ($entry->estate_type_id == 2) {
                    $url = url('/admin/house/'.$entry->getKey().'/edit');
                } elseif ($entry->estate_type_id == 3) {
                    $url = url('/admin/commercial/'.$entry->getKey().'/edit');
                } elseif ($entry->estate_type_id == 4) {
                    $url = url('/admin/land/'.$entry->getKey().'/edit');
                } elseif ($entry->estate_type_id == 5) {
                    $url = url('/admin/townhouse/'.$entry->getKey().'/edit');
                }
            } elseif ($entry->contact_type_id) {
                if ($entry->contact_type_id == 1) {
                    $url = url('/admin/seller/'.$entry->getKey().'/edit');
                } elseif ($entry->contact_type_id == 2) {
                    $url = url('/admin/owner/'.$entry->getKey().'/edit');
                } elseif ($entry->contact_type_id == 3) {
                    $url = url('/admin/agent/'.$entry->getKey().'/edit');
                } elseif ($entry->contact_type_id == 4) {
                    $url = url('/admin/buyer/'.$entry->getKey().'/edit');
                } elseif ($entry->contact_type_id == 5) {
                    $url = url('/admin/renter/'.$entry->getKey().'/edit');
                }
            } else {
                $url = url($crud->route.'/'.$entry->getKey().'/edit');
            }
        @endphp

        @if($url)
            <a href="{{ $url }}" class="btn btn-sm btn-link" title="Խմբագրել" aria-label="Խմբագրել"><i class="la la-edit"></i></a>
        @endif
    @else

        {{-- Edit button group --}}
        <div class="btn-group">
            <a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-sm btn-link pr-0" title="Խմբագրել" aria-label="Խմբագրել"><i
                    class="la la-edit"></i> {{ trans('backpack::crud.edit') }}</a>
            <a class="btn btn-sm btn-link dropdown-toggle text-primary pl-1" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header">{{ trans('backpack::crud.edit_translations') }}:</li>
                @foreach ($crud->model->getAvailableLocales() as $key => $locale)
                    <a class="dropdown-item"
                       href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?_locale={{ $key }}">{{ $locale }}</a>
                @endforeach
            </ul>
        </div>

    @endif
@endcan
