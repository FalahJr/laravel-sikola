<!-- Reusable confirmation modal component -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="confirmModalMessage">Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmModalYes">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        (function() {
            // store the form to submit or href to navigate when confirmed
            let formToSubmit = null;
            let hrefToNavigate = null;

            // helper to show modal
            function showModalWithMessage(message) {
                const modalMessage = document.getElementById('confirmModalMessage');
                if (modalMessage) modalMessage.textContent = message;
                if (window.jQuery) {
                    jQuery('#confirmModal').modal('show');
                } else {
                    const m = document.getElementById('confirmModal');
                    if (m) {
                        m.classList.add('show');
                        m.style.display = 'block';
                    }
                }
            }

            // open modal when any .btn-delete or .btn-confirm is clicked
            document.addEventListener('click', function(e) {
                const target = e.target.closest && (e.target.closest('.btn-delete') || e.target.closest(
                    '.btn-confirm'));
                if (!target) return;
                e.preventDefault();

                // reset previous action
                formToSubmit = null;
                hrefToNavigate = null;

                // get closest form (if any) and data-href
                formToSubmit = target.closest('form');
                hrefToNavigate = target.getAttribute('data-href') || null;

                // message can be customized via data-message attribute
                const defaultMsg = target.classList.contains('btn-delete') ?
                    'Apakah Anda yakin ingin menghapus data ini?' :
                    'Apakah Anda yakin ingin melanjutkan aksi ini?';
                const message = target.getAttribute('data-message') || defaultMsg;

                showModalWithMessage(message);
            });

            // handle confirmation
            document.addEventListener('click', function(e) {
                if (e.target && e.target.id === 'confirmModalYes') {
                    // perform navigation if href provided, otherwise submit stored form
                    if (hrefToNavigate) {
                        window.location.href = hrefToNavigate;
                    } else if (formToSubmit) {
                        formToSubmit.submit();
                    }

                    // reset and hide modal
                    formToSubmit = null;
                    hrefToNavigate = null;
                    if (window.jQuery) {
                        jQuery('#confirmModal').modal('hide');
                    }
                }
            });
        })();
    </script>
@endpush
