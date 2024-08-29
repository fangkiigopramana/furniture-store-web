<div>
    <div class="d-flex">
        <div class="p-2 flex-fill">
            <div class="mb-3">
                <input type="text" class="form-control" name="search" placeholder="Cari Transaksi">
            </div>
        </div>
        <div class="p-2 flex-fill">
            <div class="mb-3">
                <select class="form-select select2" name="statusSelect" aria-label="Pilih Status">
                    <option value="all">Semua Status</option>
                    <option value="ongoing">Transaksi Berlangsung</option>
                    <option value="success">Berhasil</option>
                    <option value="failed">Gagal</option>
                </select>
            </div>
        </div>
        <div class="p-2 flex-fill">
            <div class="mb-3">
                <select class="form-select select2" name="dateSelect" aria-label="Pilih Tanggal">
                    <option value="all">Semua Tanggal</option>
                    <option value="30day">30 Hari Terakhir</option>
                    <option value="90day">90 Hari Terakhir</option>
                    <option value="set">Pilih Tanggal Sendiri</option>
                </select>
            </div>
        </div>
    </div>
</div>
