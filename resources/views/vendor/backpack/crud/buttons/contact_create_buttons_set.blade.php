
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
                    @can('createSeller', \App\Models\Contact::class)
                        <li><a href="/admin/seller/create" class="dropdown-item" ><i class="las la-city"></i> Վաճառող</a></li>
                        <li><a href="/admin/owner/create" class="dropdown-item" ><i class="las la-home"></i> Վարձատու</a></li>
                    @endcan
                    @can('createRealtor', \App\Models\Contact::class)
                        <li><a href="/admin/agent/create" class="dropdown-item" ><i class="las la-university"></i> Գործակալ</a></li>
                    @endcan
                    @can('create', \App\Models\Contact::class)
                        <li><a href="/admin/buyer/create" class="dropdown-item" ><i class="las la-university"></i> Գնորդ</a></li>
                    @endcan
                    @can('createRenter', \App\Models\Contact::class)
                        <li><a href="/admin/renter/create" class="dropdown-item" ><i class="las la-university"></i> Վարձակալ</a></li>
                    @endcan
                </ul>
            </div>

    </div>

