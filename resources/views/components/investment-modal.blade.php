<div class="modal fade" id="investmentModal" tabindex="-1" aria-labelledby="investmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="investmentModalLabel">Investasi Seikhlasnya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yuk pilih nominal investasi terbaik Anda</p>
                <ul class="list-group" id="nominal-list">
                    <li class="list-group-item" data-value="100000">
                        <span>Rp {{ number_format(100000, 0, ',', '.') }}</span>
                        <i class="fas fa-chevron-right"></i>
                    </li>
                    <li class="list-group-item" data-value="200000">
                        <span>Rp {{ number_format(200000, 0, ',', '.') }}</span>
                        <i class="fas fa-chevron-right"></i>
                    </li>
                    <li class="list-group-item" data-value="300000">
                        <span>Rp {{ number_format(300000, 0, ',', '.') }}</span>
                        <i class="fas fa-chevron-right"></i>
                    </li>
                </ul>
                <p class="mt-3">Atau masukkan investasi terbaik anda</p>
                <div class="input-group mb-3">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control" id="custom-price" placeholder="0">
                </div>
                <p class="text-danger">Minimal Rp 10.000</p>
                <button type="button" class="btn btn-primary w-100" id="pay-button" onclick="redirectToPayment()"
                    disabled>Lanjutkan
                    pembayaran</button>
            </div>
        </div>
    </div>
</div>

<script>
    function redirectToPayment() {
        let price = document.getElementById('custom-price').value;
        let currentUrl = window.location.href;
        let baseUrl = currentUrl.split('?')[0];
        window.location.href = `${baseUrl}/pembayaran?price=${price}`;
    }
</script>
