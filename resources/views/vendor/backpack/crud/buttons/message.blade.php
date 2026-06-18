@can('update', $entry)
<a href="javascript:void(0)"  data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" class="btn btn-sm btn-link" data-button-type="delete">
    <i class="las la-envelope"></i></a>
@endcan
