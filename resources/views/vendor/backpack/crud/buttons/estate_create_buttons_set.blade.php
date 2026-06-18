@can('create', \App\Models\Estate::class)
    <div id="createActions" class="form-group my-3">


            <div class="btn-group" role="group">
                <button type="submit" class="btn btn-success text-white">
                    <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                </button>
                <button id="bpSaveButtonsGroup" type="button" class="btn btn-success text-white dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="d-none visually-hidden">Toggle Dropdown</span>
                    <span data-value="create">Ստեղծել նոր</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="bpSaveButtonsGroup">
                        <li><a href="/admin/estate/create" class="dropdown-item" ><i class="las la-city"></i>Բնակարան</a></li>
                        <li><a href="/admin/house/create" class="dropdown-item" ><i class="las la-home"></i> Առանձնատուն</a></li>
                        <li><a href="/admin/townhouse/create" class="dropdown-item" ><i class="las la-home"></i> Թաունհաուս</a></li>
                        <li><a href="/admin/commercial/create" class="dropdown-item" ><i class="las la-university"></i> Կոմերցիալ</a></li>
                        <li><a href="/admin/land/create" class="dropdown-item" ><i class="las la-mountain"></i>Հող</a></li>
                </ul>
            </div>

    </div>
@endcan
