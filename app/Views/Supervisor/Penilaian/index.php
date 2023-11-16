<?= $this->extend('Supervisor/Layouts') ?>
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
                <!-- <div class="alert alert-info" role="alert">
    <i class="dripicons-information me-2"></i> This is a <strong>info</strong> alert - check it out!
</div> -->
                <div class="ribbon ribbon-success float-start shadow-sm"><i class="mdi mdi-table me-1"></i> Data
                    Penilaian</div>
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
                                    <option value="<?=$p['id']?>" <?=$p['is_active']==1 ? 'selected' : null ?>>
                                        <?=$p['tahun_akademik']?> - <?=$p['periode']?></option>
                                    <?php
                            }
                        }

                        ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="table_guru_mapel"></div>
                </div>
            </div>
        </div> <!-- Card -->
    </div>
</div>
<!--Row-->
<div class="modalview"></div>
<script>
var periodeAktif = $('#periode_id').val(); // Mendapatkan nilai awal periode
$(document).ready(function() {
    TableGuruMapel(periodeAktif); // Memanggil fungsi dengan nilai awal periode
    $('#periode_id').change(function(e) {
        e.preventDefault();
        // Lakukan sesuatu saat terjadi perubahan
        periodeAktif = $(this).val(); // Mengambil nilai yang baru dipilih
        TableGuruMapel(periodeAktif); // Memanggil fungsi dengan periode yang baru dipilih
    });
});

function TableGuruMapel(periode_id) {
    $.ajax({
        url: "<?=base_url('superv/penilaian/guru')?>",
        data: {
            periode_id: periode_id
        },
        dataType: "json",
        success: function(response) {
            $('#table_guru_mapel').html(response.guru_mapel_list);
        }
    });
}
</script>

<?= $this->endSection() ?>