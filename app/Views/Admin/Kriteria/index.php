<?= $this->extend('Admin/Layouts') ?>
<?= $this->section('content') ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kriteria</li>
                    </ol>
                </div>
                <h4 class="page-title">Kriteria</h4>
            </div>
            <div class="float-end">
                <button onclick="NewKriteria()" class="btn btn-primary btn-rounded shadow-sm btn-sm">
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
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong><i class="mdi mdi-alert"></i> Info !</strong> Indikator penilaian dapat ditambahkan pada setiap Kriteria penilaian.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <div class="ribbon ribbon-info float-start shadow-sm"><i class="mdi mdi-table me-1"></i> Data Kriteria Penilaian</div>
                <!-- <h4 class="header-title">Data Kriteria Penilaian</h4> -->
                <div class="ribbon-content" id="table-kriteria"></div>
            </div>
        </div>
    </div>
</div> <!--Row-->
<div class="modalview"></div>
<script>
 $(document).ready(function () {
    TableKriteria();
 });

    function TableKriteria() {
        $.ajax({
            url: "<?=base_url('admin/kriteria/list')?>",
            data: "data",
            dataType: "json",
            beforeSend: function() {
                $('#table-kriteria').html(`<div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>`);
                },           
            success: function (response) {
                $('#table-kriteria').html(response.list_kriteria)
            }
        });
      }
      
    function NewKriteria() {
        $.ajax({
            url: "<?=base_url('admin/kriteria/new')?>",
            data: "data",
            dataType: "json",
            
            success: function (response) {
                $('.modalview').html(response.form_kriteria)
                $('#modal-kriteria').modal('show')
            }
        });
      }
</script>
    <?= $this->endSection() ?>   