<?= $this->extend('Admin/Layouts') ?>
<?= $this->section('content') ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kelas</li>
                    </ol>
                </div>
                <h4 class="page-title">Pengaturan Kelas</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
<div class="row">
    <div class="col-lg-12">    
        <div class="card ribbon-box shadow-sm mt-2">
            <div class="card-body">
            <div class="ribbon ribbon-secondary float-start shadow-sm"><i class="mdi mdi-table me-1"></i> Data Kelas</div>
                <!-- <h4 class="header-title">Data Kriteria Penilaian</h4> -->
                <div class="ribbon-content">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <select id="sekolah_id" class="form-control mb-3">
                        <option value="all">Semua Tingkat Sekolah</option>
                        <?php
                        if (!empty(Sekolah())) {
                        foreach (Sekolah() as $p) {
                        ?>
                        <option value="<?=$p['id']?>"><?=$p['nama_sekolah']?></option>
                        <?php
                        }
                        }
                        ?>
                        </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    <button onclick="NewKelas()" class="btn btn-primary btn-rounded shadow-sm btn-sm">
                <i class="mdi mdi-plus"></i> New
                </button>
                    </div>
                </div>

                <div id="table-kelas"></div>
                </div>
            </div>
        </div>
    </div>
</div> <!--Row-->
<div class="modalview"></div>
<script>
    var SekolahID = $('#sekolah_id').val();
 $(document).ready(function () {
    TableKelas(SekolahID);

$('#sekolah_id').change(function (e) { 
    e.preventDefault();
    SekolahID = $(this).val();
    TableKelas(SekolahID);

    
});
 });

    function TableKelas(sekolah_id) {
        $.ajax({
            url: "<?=base_url('admin/kelas/show')?>",
            data: {id : sekolah_id},
            dataType: "json",
            success: function (response) {
                $('#table-kelas').html(response.list_kelas)
            }
        });
      }
      
    function NewKelas() {
        $.ajax({
            url: "<?=base_url('admin/kelas/new')?>",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.form_kelas)
                $('#modal-kelas').modal('show')
            }
        });
      }
</script>
    <?= $this->endSection() ?>   