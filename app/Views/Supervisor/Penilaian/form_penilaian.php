<?= $this->extend('Supervisor/Layouts') ?>
<?= $this->section('content') ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Form Penilaian</li>
                    </ol>
                </div>
                <h4 class="page-title">Form Penilaian</h4>
            </div>
           
        </div>
    </div>     
    <!-- end page title --> 
<div class="row">
    <div class="col-lg-4">
        <div class="card">
        <div class="card-body">
        <div class="text-center">
            <img src="<?=base_url('public')?>/images/users/avatar.jpg" alt="" class="rounded-circle avatar-lg img-thumbnail">
            <h4 class="mt-1 mb-1"><?=$guru->nama?></h4>
            <p class="font-13 text-muted"> <?=$guru->nuptk?></p>
            <a href="<?=base_url('report/nilai/'.$guru->id)?>" target="_blank" class="btn btn-success shadow-sm btn-rounded">
            <i class="mdi mdi-printer me-1"></i> Cetak Nilai
            </a>
        </div>
        <div class="alert alert-info mt-3">
        Mulai penilaian dengan memilih Salah Satu Kriteria yang akan anda nilai pada list dibawah ini :
        </div>
        <input type="hidden" id="guru_mapel_id" value="<?=$guru->id?>">
        <input type="hidden" id="periode_id" value="<?=$guru->periode_id?>">
        <div class="mb-3">
        <!-- <label for="kompetensi" class="form-label"> Kompetensi Penilaian</label> -->
        <select class="form-select" id="kompetensi">
        <option value="">Pilih Kriteria Penilaian</option>
        <?php
        $i = 1;
        foreach ($kriteria as $k) {?>
        <option value="<?=$k['id']?>"><?=$i++?>. <?=$k['kriteria']?></option>
        <?php } ?>
        </select>
        </div>
        </div>


        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body" id="status-nilai"></div>
        </div>
    </div>
</div>
<div class="viewsubkriteria"></div>


<script>
    $(document).ready(function () {
        const periode_id =$('#periode_id').val() 
        const guru_mapel_id =$('#guru_mapel_id').val() 
        TableStatusNilai(periode_id,guru_mapel_id)


        $('#kompetensi').change(function (e) { 
            e.preventDefault();
            if ($(this).val() !=="") {
                // const form = $('#form-guru').serialize();
                // alert('ok')
                $.ajax({
                    type: "post",
                    url: "<?=base_url('superv/penilaian/sub')?>",
                    data: {
                        
                        kriteria_id : $(this).val(),
                        guru_mapel_id:guru_mapel_id
                    },
                    dataType: "json",
                    success: function (response) {
                        $('.viewsubkriteria').html(response.form_sub_kriteria).show();
                        $('#modal-sub-kriteria').modal('show')
                    }
                });
            }
            
        });
    });

function TableStatusNilai(periode_id,guru_mapel_id) {
$.ajax({
url: "<?=base_url('superv/penilaian/status')?>",
data: {
periode_id : periode_id,
guru_mapel_id : guru_mapel_id
},
dataType: "json",
success: function (response) {
$('#status-nilai').html(response.table_status_nilai)
}
});

}


</script>
    <?= $this->endSection() ?>   