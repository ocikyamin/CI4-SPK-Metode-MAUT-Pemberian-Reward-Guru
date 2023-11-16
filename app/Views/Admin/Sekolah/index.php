<?= $this->extend('Admin/Layouts') ?>
<?= $this->section('content') ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sekolah</li>
                    </ol>
                </div>
                <h4 class="page-title">Pengaturan Sekolah</h4>
            </div>
            <div class="float-end">
                <button onclick="NewSekolah()" class="btn btn-primary btn-rounded shadow-sm btn-sm">
                <i class="mdi mdi-plus"></i> New
                </button>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
<div class="row">
    <div class="col-lg-12">    
        <div class="card ribbon-box shadow-sm mt-2">
            <div class="card-body">
            <div class="ribbon ribbon-secondary float-start shadow-sm"><i class="mdi mdi-table me-1"></i> Data Sekolah / Madrasah</div>
                <!-- <h4 class="header-title">Data Kriteria Penilaian</h4> -->
                <div class="ribbon-content" id="table-sekolah"></div>
            </div>
        </div>
    </div>
</div> <!--Row-->
<div class="modalview"></div>
<script>
 $(document).ready(function () {
    TableSekolah();
 });

    function TableSekolah() {
        $.ajax({
            url: "<?=base_url('admin/sekolah/show')?>",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#table-sekolah').html(response.list_sekolah)
            }
        });
      }
      
    function NewSekolah() {
        $.ajax({
            url: "<?=base_url('admin/sekolah/new')?>",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.form_sekolah)
                $('#modal-sekolah').modal('show')
            }
        });
      }
</script>
    <?= $this->endSection() ?>   