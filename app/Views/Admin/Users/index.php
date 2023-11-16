<?= $this->extend('Admin/Layouts') ?>
<?= $this->section('content') ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
            <h4 class="page-title">Pengaturan User</h4>
        </div>
        <div class="float-end">
            <button onclick="NewUser()" class="btn btn-primary btn-rounded shadow-sm btn-sm">
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
                <div class="ribbon ribbon-secondary float-start shadow-sm"><i class="mdi mdi-table me-1"></i> Data Users
                </div>
                <!-- <h4 class="header-title">Data Kriteria Penilaian</h4> -->
                <div class="ribbon-content" id="table-users"></div>
            </div>
        </div>
    </div>
</div>
<!--Row-->
<div class="modalview"></div>
<script>
$(document).ready(function() {
    TableUsers();
});

function TableUsers() {
    $.ajax({
        url: "<?=base_url('admin/user/show')?>",
        data: "data",
        dataType: "json",
        success: function(response) {
            $('#table-users').html(response.list_user)
        }
    });
}

function NewUser() {
    $.ajax({
        url: "<?=base_url('admin/user/new')?>",
        data: "data",
        dataType: "json",
        success: function(response) {
            $('.modalview').html(response.form_user)
            $('#modal-user').modal('show')
        }
    });
}
</script>
<?= $this->endSection() ?>