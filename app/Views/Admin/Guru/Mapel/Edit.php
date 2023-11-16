<div id="modal-guru-mapel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header shadow-sm">
                <h4 class="modal-title"><i class="mdi mdi-cog"></i> Pengaturan Guru Bidang Studi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-guru-mapel" method="post">
                <?=csrf_field()?>
                <input type="hidden" name="id" value="<?=$data['id']?>">
                <input type="hidden" name="old_kode" value="<?=$data['kode_guru']?>">
            <div class="modal-body">
                <div class="form-group row mb-2 mt-2">
                <label class="col-lg-3" for="sekolah">Sekolah</label>
                <div class="col-lg-9">
                <input type="hidden" name="sekolah_id" id="sekolah_id" value="<?=$sekolah['id']?>">
                <input type="text" class="form-control form-control-sm" value="<?=$sekolah['nama_sekolah']?>" disabled>
            </div>
        </div>
        
            <div class="form-group row mb-2 mt-2">
            <label class="col-lg-3" for="periode_id">Periode</label>
            <div class="col-lg-9">
            <input type="hidden" name="periode_id" value="<?=$periode['id']?>">
            <input type="text" class="form-control form-control-sm" value="<?=$periode['tahun_akademik']?>" disabled>
            </div>
            </div>
            <hr>

            <div class="form-group row mb-2 mt-2">
            <label class="col-lg-3" for="kode_guru">Kode</label>
            <div class="col-lg-9">
            <input type="text" class="form-control form-control-sm" name="kode_guru" id="kode_guru" value="<?=$data['kode_guru']?>" placeholder="Contoh : A1">
            <div class="kode_guru invalid-feedback"></div>
            </div>
            </div>

            <div class="form-group row mb-2 mt-2">
            <label class="col-lg-3" for="guru">Guru</label>
            <div class="col-lg-9">
            <select class="form-control select2" name="guru" id="guru" data-toggle="select2">
            <option>Pilih Guru</option>
            <?php
            foreach ($guru as $g) {?>
            <option value="<?=$g['id']?>" <?=$data['guru_id']==$g['id'] ? 'selected':null ?>><?=$g['nama']?></option>
            <?php } ?>
            </select>
            <div class="guru invalid-feedback"></div>
            </div>
        </div>
        
            <div class="form-group row mb-2">
                <label class="col-lg-3" for="mapel">Bidang Studi</label>
                <div class="col-lg-9">
                <select name="mapel" id="mapel" class="form-select form-select-sm">
                    <option value="">Pilih Bidang Studi</option>
                    <?php
                    foreach ($mapel as $d) {?>
                    <option value="<?=$d['id']?>" <?=$data['mapel_id']==$d['id'] ? 'selected':null ?>><?=$d['mapel']?></option>
                    <?php } ?>
                    </select> 
                <div class="mapel invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label class="col-lg-3" for="kelas">Kelas</label>
                <div class="col-lg-9">
                <select name="kelas" id="kelas" class="form-select form-select-sm">
                    <option value="">Pilih Kelas</option>
                    <?php
                    foreach ($kelas as $k) {?>
                    <option value="<?=$k['id']?>" <?=$data['kelas_id']==$k['id'] ? 'selected':null ?>><?=$k['kelas']?></option>
                    <?php } ?>
                    </select> 
                <div class="kelas invalid-feedback"></div>
                </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-rounded shadow-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btn-update" class="btn btn-success btn-rounded shadow-sm"><i class="mdi mdi-send-check"></i> Simpan Perubahan</button>
            </div>
            </form> <!-- Form //-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>





 $('#form-guru-mapel').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/guru/mapel/update')?>",
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
                    $('#btn-update').html(`<i class="mdi mdi-send-check"></i> Simpan Perubahan`);
                    },
        success: function (response) {
            if (response.error) {
            if (response.error.kode_guru) {
                $('#kode_guru').addClass('is-invalid')
                $('.kode_guru').html(response.error.kode_guru)
            }
            if (response.error.guru) {
                $('#guru').addClass('is-invalid')
                $('.guru').html(response.error.guru)
            }
           
            if (response.error.mapel) {
                $('#mapel').addClass('is-invalid')
                $('.mapel').html(response.error.mapel)
            }
            if (response.error.kelas) {
                $('#kelas').addClass('is-invalid')
                $('.kelas').html(response.error.kelas)
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
                $('#modal-guru-mapel').modal('hide')
                TableGuruMapel();
            }
            })
            }
        }
    });
    
 });
</script>