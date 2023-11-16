<?= $this->extend('Admin/Layouts') ?>
<?= $this->section('content') ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">Penilaian</li>
                </ol>
            </div>
            <h4 class="page-title">Penilaian</h4>
        </div>

    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card ribbon-box shadow-sm mt-2">
            <div class="card-body">
                <div class="ribbon ribbon-success float-start shadow-sm"><i class="mdi mdi-table me-1"></i> Perhitungan
                    Metode MAUT</div>
                <div class="ribbon-content">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="periode_id">Periode Penilaian</label>
                                <select id="periode_id" class="form-control mb-3">
                                    <option value="">Periode Penilaian</option>
                                    <?php
                                    if (!empty(Periode())) {
                                        foreach (Periode() as $p) {
                                    ?>
                                    <option value="<?= $p['id'] ?>" <?= $p['is_active'] == 1 ? 'selected' : null ?>>
                                        <?= $p['periode'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="sekolah_id">Tingkat Sekolah</label>
                                <select id="sekolah_id" class="form-control mb-3">
                                    <option value="">Pilih Sekolah</option>
                                    <?php
                                    if (!empty(Sekolah())) {
                                        foreach (Sekolah() as $p) {
                                    ?>
                                    <option value="<?= $p['id'] ?>"><?= $p['nama_sekolah'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <button onclick="CetakLaporan()" class="btn-cetak btn btn-info d-none">Cetak</button>
                        </div>
                    </div>

                    <div id="table_nilai_alternatif">
                        <div class="alert alert-warning">
                            Pilih periode penilaian dan tingkat pendidikan untuk melihat hasil
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- Card -->
    </div>
</div>
<!--Row-->

<script>
var periode_default = $('#periode_id').val();
var sekolah_default = $('#sekolah_id').val();
// console.log(sekolah_default)
// Mendapatkan nilai awal periode
$(document).ready(function() {
    // TableNilaiAlternatif(sekolah_default, periode_default);
    // Memanggil fungsi dengan nilai awal periode

    $('#periode_id').change(function(e) {
        e.preventDefault();
        // Lakukan sesuatu saat terjadi perubahan
        periode_default = $(this).val(); // Mengambil nilai yang baru dipilih
        TableNilaiAlternatif(sekolah_default,
            periode_default); // Memanggil fungsi dengan periode yang baru dipilih
    });

    $('#sekolah_id').change(function(e) {
        e.preventDefault();
        // Lakukan sesuatu saat terjadi perubahan
        sekolah_default = $(this).val(); // Mengambil nilai yang baru dipilih
        TableNilaiAlternatif(sekolah_default,
            periode_default); // Memanggil fungsi dengan periode yang baru dipilih
    });
});

function TableNilaiAlternatif(sekolah_id, periode_id) {
    $.ajax({
        url: "<?= base_url('admin/skors/nilai-alternatif') ?>",
        data: {
            sekolah_id: sekolah_id,
            periode_id: periode_id
        },
        dataType: "json",
        success: function(response) {
            $('#table_nilai_alternatif').html(response.list_alternatif);
        }
    });
}

// Cetak 
$('#sekolah_id').change(function(e) {
    e.preventDefault();
    if ($(this).val() !== "") {
        $('.btn-cetak').removeClass('d-none')
    } else {
        $('.btn-cetak').addClass('d-none')
    }

});

// Cetak Laporan 
function CetakLaporan() {
    const periode_id = $('#periode_id').val();
    const sekolah_id = $('#sekolah_id').val();
    if (periode_id == "" || sekolah_id == "") {
        alert('Periode Penilian Atau Sekolah Belum dipilih.')
    } else {
        const url = `<?= base_url('report/pkg/') ?>${periode_id}/${sekolah_id}`;
        const newTab = window.open(url, '_blank');
        if (newTab) {
            newTab.focus(); // Fokuskan tab baru jika berhasil dibuka
        } else {
            // Jika browser memblokir popup, berikan pesan ke pengguna
            alert('Popup diblokir oleh browser. Silakan izinkan pop-up untuk membuka laporan.');
        }
    }


}
</script>


<?= $this->endSection() ?>