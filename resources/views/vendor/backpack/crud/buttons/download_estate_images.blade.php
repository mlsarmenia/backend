

  @if ($crud->hasAccess('create'))
      <a href="javascript:void(0)" onclick="downloadEstateImages(this)" data-estate-id="{{$entry->getKey() }}" data-route="{{ url($crud->route.'/'.$entry->getKey().'/download-estate-images') }}" title="Ներբեռնել բոլոր նկարները"
         class="btn btn-sm btn-link" data-button-type="clone">
          <i class="las la-cloud-download-alt"></i></a>
  @endif

  {{-- Button Javascript --}}
  {{-- - used right away in AJAX operations (ex: List) --}}
  {{-- - pushed to the end of the page, after jQuery is loaded, for non-AJAX operations (ex: Show) --}}
  @push('after_scripts') @if (request()->ajax()) @endpush @endif
  <script>
      if (typeof downloadEstateImages != 'function') {
          $("[data-button-type=clone]").unbind('click');

          function downloadEstateImages(button) {
              // ask for confirmation before deleting an item
              // e.preventDefault();
              var button = $(button);
              var route = button.attr('data-route');
              var estate_id = button.attr('data-estate-id');

              $.ajax({
                  url: route,
                  type: 'POST',
                  success: async function (result) {

                      Swal.fire({
                          title: "Խնդրում ենք սպասել․․․",
                          showLoaderOnConfirm: false,
                          timer: 10000,
                          timerProgressBar: true,
                      });


                      const files = result;

                      const zip = new JSZip();

                      // Add each file to the ZIP archive
                      for (const file of files) {
                          // Fetch the file's blob
                          const fileResponse = await fetch(file.url);
                          const fileBlob = await fileResponse.blob();

                          // Add the file to the ZIP archive
                          zip.file(file.name, fileBlob);
                      }

                      // Generate the ZIP file as a Blob
                      const zipBlob = await zip.generateAsync({ type: 'blob' });

                      Swal.fire({
                          text: "Պատրաստ է։", //TODO: translations
                          icon: "success",
                          html: estate_id+'-original.zip',
                          confirmButtonText: "Ներբեռնել",
                      }).then(function(){
                          saveAs(zipBlob, estate_id+'-original.zip');
                          }
                      );


                      /*server side logic*/

                      // if (result.zipFileUrl) {
                      //     // Create a hidden anchor tag to trigger the download
                      //     var downloadLink = document.createElement('a');
                      //     downloadLink.href = result.zipFileUrl;
                      //     downloadLink.download = result.zipName; // Specify the desired filename
                      //
                      //     // Trigger a click event to start the download
                      //     downloadLink.click();
                      // } else {
                      //     // Handle the case where the response doesn't contain the file URL
                      //     console.error('No download URL found in the response.');
                      // }
                      //
                      //
                      // if (typeof crud !== 'undefined') {
                      //     crud.table.ajax.reload();
                      // }
                  },
                  error: function(result) {
                      // Show an alert with the result
                      Swal.fire({
                          title: "Անհնար է ներբեռնել։",
                          html: 'Գույքի կոդը։ '+estate_id,
                          icon: "error",
                          timer: 4000,
                          buttons: false,
                      });
                  }
              });
          }
      }

      // make it so that the function above is run after each DataTable draw event
      // crud.addFunctionToDataTablesDrawEventQueue('downloadEstateImages');
  </script>
  @if (!request()->ajax()) @endpush @endif
