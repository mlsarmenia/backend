@can('update', $entry)
    @if (isset($entry->contract_type_id) )
        <a href="javascript:void(0)" onclick="estateCloneEntry(this)"
           data-route="{{ url($crud->route.'/'.$entry->getKey().'/clone') }}"
           data-status="{{ $entry->estate_status_id ?? '' }}"
           data-status-name="{{ $entry->estate_status->name_arm ?? '' }}"
           data-contract="{{ $entry->contract_type_id ?? '' }}"
           data-contract-name="{{ $entry->contract_type->name_arm ?? '' }}"
           class="btn btn-sm btn-link"
           title="Կրկնօրինակել"
           aria-label="Կրկնօրինակել"
           data-button-type="clone">

            <i class="la la-copy"></i>

        </a>


    {{-- Button Javascript --}}
    {{-- - used right away in AJAX operations (ex: List) --}}
    {{-- - pushed to the end of the page, after jQuery is loaded, for non-AJAX operations (ex: Show) --}}
    @push('after_scripts') @if (request()->ajax()) @endpush @endif
    <script>

        if (typeof estateCloneEntry != 'function') {
            $("[data-button-type=delete]").unbind('click');







            function estateCloneEntry(button) {
                // ask for confirmation before deleting an item
                // e.preventDefault();
                var route = $(button).attr('data-route');
                var contractType = $(button).attr('data-contract');
                var contractName = $(button).attr('data-contract-name');
                var estateStatus = $(button).attr('data-status');
                var estateStatusName = $(button).attr('data-status-name');


                var inputOptions = {
                    '1': 'Վաճառք',
                    '2': 'Վարձ.',
                    '3': 'Օրավարձ'
                };

                var excludedOption = contractType;



                if(estateStatus != 7 && estateStatus !=8) {
                    if (inputOptions[excludedOption]) {
                        delete inputOptions[excludedOption];
                    }
                }

               Swal.fire({
                    title: "Կրկնօրինակել",
                    html: 'Ներկա գործարքային տիպը։ '+contractName+'<br/>'+'Ներկա ստատուս: '+estateStatusName,
                    input: 'select',
                    inputOptions: inputOptions,
                    inputPlaceholder: 'Ընտրել նոր  գործարքային տիպ',
                    showConfirmButton: true,
                    confirmButtonText: "Հաստատել",
                    cancelButtonText: "Չեղարկել",
                    confirmButtonColor: '#7c69ef',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                   allowOutsideClick: () => !Swal.isLoading(),
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            if (value) {
                                resolve()
                            } else {
                                resolve('Խնդրում ենք  ընտրել նոր  գործարքային տիպ։')
                            }
                        })
                    },

                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Կրկնօրինակվում է․․․",
                            showLoaderOnConfirm: false,
                            timer: 30000,
                            timerProgressBar: true,
                        });

                        $.ajax({
                            url: route,
                            type: 'POST',
                            data: {'contract_type': result.value},
                            dataType: 'text',
                            success: function (result) {
                                if (result == 1) {
                                    // Redraw the table
                                    if (typeof crud != 'undefined' && typeof crud.table != 'undefined') {
                                        // Move to previous page in case of deleting the only item in table
                                        if (crud.table.rows().count() === 1) {
                                            crud.table.page("previous");
                                        }

                                        crud.table.draw(false);
                                    }

                                    // Show a success notification bubble
                                    Swal.fire({
                                        text: "Կրկնօրինակված է", //TODO: translations
                                        icon: "success",
                                        timer: 8000,
                                        timerProgressBar: true,
                                    }).then(function(){

                                        }
                                    );

                                    // Hide the modal, if any
                                    $('.modal').modal('hide');
                                } else {
                                    Swal.fire({
                                        title: "Անհնար է կրկնօրինակել",
                                        html: 'Նման կարգավիճակով գույք կա: Գույքի կոդը։ '+result,
                                        icon: "error",
                                        timer: 4000,
                                        buttons: false,
                                    });
                                }
                            },
                            error: function (err) {
                                // Show an alert with the result
                                Swal.fire({
                                    title: err.statusText,
                                    icon: "error",
                                    timer: 4000,
                                    buttons: false,
                                });
                            }
                        });
                    };
                });

            }
        }

    </script>
    @if (!request()->ajax()) @endpush @endif
    @endif
@endcan
