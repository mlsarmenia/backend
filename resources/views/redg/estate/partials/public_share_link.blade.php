@if ($estate->is_published)
    @php($publicUrl = route('estates.show', ['estate' => $estate->getKey()]))
    <span class="ml-auto d-inline-flex align-items-center d-print-none">
        <a href="{{ $publicUrl }}" target="_blank" rel="noopener noreferrer" class="text-primary font-weight-bold"
           title="Բացել հանրային էջը">
            Ուղարկել հաճախորդին
        </a>
        <button type="button" class="btn btn-sm btn-link p-1 ml-1" data-estate-public-url="{{ $publicUrl }}"
                title="Պատճենել հանրային հղումը" aria-label="Պատճենել հանրային հղումը">
            <i class="la la-copy" aria-hidden="true"></i>
        </button>
        <span class="sr-only" role="status" aria-live="polite" data-estate-copy-status></span>
    </span>

    @push('after_scripts')
        <script>
            document.addEventListener('click', async function (event) {
                const button = event.target.closest('[data-estate-public-url]');
                if (!button) return;

                const url = button.dataset.estatePublicUrl;
                try {
                    if (!navigator.clipboard?.writeText) throw new Error('Clipboard unavailable');
                    await navigator.clipboard.writeText(url);

                    const icon = button.querySelector('i');
                    const status = button.parentElement.querySelector('[data-estate-copy-status]');
                    icon.className = 'la la-check text-success';
                    button.title = 'Հղումը պատճենված է';
                    status.textContent = 'Հղումը պատճենված է';
                    setTimeout(function () {
                        icon.className = 'la la-copy';
                        button.title = 'Պատճենել հանրային հղումը';
                        status.textContent = '';
                    }, 2000);
                } catch (error) {
                    window.prompt('Պատճենեք հանրային հղումը', url);
                }
            });
        </script>
    @endpush
@else
    <span class="ml-auto text-muted d-print-none" title="Հանրային հղումը հասանելի է հրապարակելուց հետո">
        Չհրապարակված
    </span>
@endif
