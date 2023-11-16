<div id="modal-guru" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success">
                <h4 class="modal-title">
               <i class="mdi mdi-square-edit-outline"></i> Edit Guru
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-guru" method="post">
                <?=csrf_field()?>
                <input type="hidden" name="id" value="<?=$guru['id']?>">
                <input type="hidden" name="old_nuptk" value="<?=$guru['nuptk']?>">
            <div class="modal-body">
            <div class="form-group row mb-2">
                <label class="col-lg-3" for="nuptk">NUPTK</label>
                <div class="col-lg-9">
                <input type="text" class="form-control" id="nuptk" name="nuptk" value="<?=$guru['nuptk']?>" placeholder="(9999999999)">
                <div class="nuptk invalid-feedback"></div>
                </div>
            </div>
            
            <div class="form-group row mb-2">
                <label class="col-lg-3" for="nama">Nama Lengkap & Gelar</label>
                <div class="col-lg-9">
                <input class="form-control" id="nama" name="nama" value="<?=$guru['nama']?>" placeholder="ex : Abdul Yamin, S.Pd">
                <div class="nama invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row mb-2">
                <label class="col-lg-3" for="jk">Gender</label>
                <div class="col-lg-9">
                    <div class="form-check form-check-inline">
                    <input type="radio" id="lk" name="jk" value="L" class="form-check-input" <?=$guru['jk']=='L'? 'checked':null ?>>
                    <label class="form-check-label" for="lk">Laki-laki</label>
                    </div>

                    <div class="form-check form-check-inline">
                    <input type="radio" id="pr" name="jk" value="P" class="form-check-input" <?=$guru['jk']=='P'? 'checked':null ?>>
                    <label class="form-check-label" for="pr">Perempuan</label>
                    </div>
                <div class="jk invalid-feedback"></div>
                </div>
            </div>
            
            <div class="form-group row mb-2">
                <label class="col-lg-3" for="tmp_lahir">Tempat, Tgl Lahir</label>
                <div class="col-lg-5">
                <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" value="<?=$guru['tmp_lahir']?>" placeholder="ex : Jakarta">
                <div class="tmp_lahir invalid-feedback"></div>
            </div>
            <div class="col-lg-4">
                <input type="date" class="form-control" id="tgl_lahir" value="<?=$guru['tgl_lahir']?>" name="tgl_lahir">
                <div class="tgl_lahir invalid-feedback"></div>
            </div>
            </div>
            <div class="form-group row mb-2">
                <label class="col-lg-3" for="pddk_akhir">Pendidikan Terakhir</label>
                <div class="col-lg-9">
                <input type="text" class="form-control" id="pddk_akhir" name="pddk_akhir" value="<?=$guru['pddk_akhir']?>" placeholder="ex : S1">
                <div class="pddk_akhir invalid-feedback"></div>
            </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-rounded shadow-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btn-update" class="btn btn-success btn-rounded shadow-sm"><i class="mdi mdi-send-check-outline"></i> Save Changes</button>
            </div>
            </form> <!-- Form //-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
 $('#form-guru').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/guru/akun/update')?>",
        data: $(this).serialize(),
        dataType: "json",
                    beforeSend: function() {
                    $('#btn-update').prop('disabled', true);
                    $('#btn-update').html(
                    `<div class="text-center"><div class="spinner-border spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div></div>`
                    );
                    },
                    complete: function() {
                    $('#btn-update').prop('disabled', false);
                    $('#btn-update').html(`<i class="mdi mdi-send-check-outline"></i> Save Changes`);
                    },
        success: function (response) {
            if (response.error) {
            if (response.error.nuptk) {
                $('#nuptk').addClass('is-invalid')
                $('.nuptk').html(response.error.nuptk)
            }
            if (response.error.nama) {
                $('#nama').addClass('is-invalid')
                $('.nama').html(response.error.nama)
            }
            if (response.error.jk) {
                $('#jk').addClass('is-invalid')
                $('.jk').html(response.error.jk)
            }
            if (response.error.tmp_lahir) {
                $('#tmp_lahir').addClass('is-invalid')
                $('.tmp_lahir').html(response.error.tmp_lahir)
            }
            if (response.error.tgl_lahir) {
                $('#tgl_lahir').addClass('is-invalid')
                $('.tgl_lahir').html(response.error.tgl_lahir)
            }
            if (response.error.pddk_akhir) {
                $('#pddk_akhir').addClass('is-invalid')
                $('.pddk_akhir').html(response.error.pddk_akhir)
            }

            } // end Error

            if (response.status) {
            $.toast({
            position :'top-right',
            heading: 'Berhasil',
            text: response.msg,
            showHideTransition: 'slide',
            hideAfter: 1000,
            icon: 'success',
            afterHidden: function () {
                $('#modal-guru').modal('hide')
                TableAkunGuru();
            }
            })
            }
        }
    });
    
 });
</script>