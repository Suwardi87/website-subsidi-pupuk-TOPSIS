
<div class="modal fade" id="modalVerifikasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                    <i class="fas fa-check"></i> verifikasi
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="verifikasiForm">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="verifikasi">verifikasi</label>
                        <select name="verifikasi" id="verifikasi" class="form-select">
                            <option value="" hidden>-- choose --</option>
                            <option value="setuju">Setuju</option> <!-- Ensure value matches validation -->
                            <option value="tolak">Ditolak</option></option> <!-- Ensure value matches validation -->
                        </select>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" form="verifikasiForm" class="btn btn-secondary">
                    <i class="fas fa-save"></i> Submit
                </button>
            </div>
        </div>
    </div>
</div>
