<?= $this->extend('Admin/Layouts') ?>
<?= $this->section('content') ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Guru</li>
                    </ol>
                </div>
                <h4 class="page-title">Guru</h4>
            </div>
           
        </div>
    </div>     
    <!-- end page title --> 
<div class="row">
    <div class="col-lg-12">  
    <div class="card ribbon-box shadow-sm mt-2">
            <div class="card-body">
            <div class="ribbon ribbon-info float-start shadow-sm"><i class="mdi mdi-table me-1"></i> Data Guru</div>
            <div class="ribbon-content">

                
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#home-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                            <span class="d-none d-md-block"><i class="mdi mdi-teach"></i> Guru Bidang Studi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                            <span class="d-none d-md-block"><i class="mdi mdi-account-key-outline"></i> Data Master Guru</span>
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane show active" id="home-b1">
                        
                        <p>Guru Bidang Studi</p>
                            <div class="row">
                            <div class="col-lg-4">
                            <select id="periode_id" class="form-select form-select-sm mb-3">
                            <option value="">Periode</option>
                            <?php
                            foreach ($periode as $s) {?>
                                <option value="<?=$s['id']?>"><?=$s['tahun_akademik']?> - <?=$s['periode']?></option>
                            <?php } ?>
                            </select> 
                            </div>
                            <div class="col-lg-4">
                            <select id="sekolah_id" class="form-select form-select-sm mb-3">
                            <option value="">Pilih Sekolah</option>
                            <?php
                            foreach ($sekolah as $s) {?>
                                <option value="<?=$s['id']?>"><?=$s['nama_sekolah']?></option>
                            <?php } ?>
                            </select> 
                            </div>
                            <div class="col-lg-4">
                            <button onclick="PengaturanBidangStudi()" class="btn btn-primary btn-rounded shadow-sm btn-sm">
                            <i class="mdi mdi-plus"></i> Pengaturan Bidang Studi
                            </button>
                            </div>
                            </div>
                        <div id="area-guru-mapel"></div>
                    </div>
                    <div class="tab-pane" id="profile-b1">
                        <p>Master Guru</p>
                        <div id="area-akun-guru"></div>
                    </div>
                </div>

            </div>

</div>
</div> <!-- Card -->


    </div>
</div> <!--Row-->
<div class="modalview"></div>
<script>
 $(document).ready(function () {
    // var periode = ;
    TableAkunGuru();
    TableGuruMapel();
 });
    function TableAkunGuru() {
        $.ajax({
            url: "<?=base_url('admin/guru/akun/list')?>",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#area-akun-guru').html(response.list_guru)
            }
        });
      }
    

$('#sekolah_id').change(function (e) { 
    e.preventDefault();
    if ($(this).val()=="") {
        TableGuruMapel();
    }else{
        if ($('#periode_id').val()=="") {
            // alert('periode kosong')
            $.toast({
            position :'top-right',
            heading: 'Warning',
            text : 'Harap pilih Tahun Periode terlebih dahulu.',
            showHideTransition: 'fade',
            icon: 'warning'
            }); 
            $('#periode_id').addClass('is-invalid')

        }else{
            $('#periode_id').removeClass('is-invalid')
            $.ajax({
            url: "<?=base_url('admin/guru/mapel/sekolah')?>",
            data: {
                periode_id : $('#periode_id').val(),
                sekolah_id : $(this).val()
            },
            dataType: "json",
            success: function (response) {
                $('#area-guru-mapel').html(response.list_guru_mapel)
            }
        });
        }
    
        
    }
    
});

function TableGuruMapel() {
        $.ajax({
            url: "<?=base_url('admin/guru/mapel/list')?>",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#area-guru-mapel').html(response.list_guru_mapel)
            }
        });
      }


    //   PengaturanBidangStudi 

    function PengaturanBidangStudi() { 
        if ($('#periode_id').val()==""|| $('#sekolah_id').val()=="") {
            // alert('kosong bos')
            $.toast({
            position :'top-right',
            heading: 'Warning',
            text : 'Harap pilih Tahun Periode dan Sekolah terlebih dahulu.',
            showHideTransition: 'fade',
            icon: 'warning'
            }); 
            $('#periode_id').addClass('is-invalid')
            $('#sekolah_id').addClass('is-invalid')

        }else{
            $('#periode_id').removeClass('is-invalid')
            $('#sekolah_id').removeClass('is-invalid') 
            $.ajax({
                url: "<?=base_url('admin/guru/mapel/new')?>",
                data: {
                    periode_id : $('#periode_id').val(),
                    sekolah_id : $('#sekolah_id').val()
                },
                dataType: "json",
                success: function (response) {
                $('.modalview').html(response.form_guru_mapel)
                $('#modal-guru-mapel').modal('show')

                }
                });

        }
     }
  
</script>
    <?= $this->endSection() ?>   