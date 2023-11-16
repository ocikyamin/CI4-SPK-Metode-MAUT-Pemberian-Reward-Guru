<div id="modal-kelas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           

            <div class="modal-header">
                <h4 class="modal-title">
                New Kelas
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-kelas" method="post">
                <?=csrf_field()?>
            <div class="modal-body">

            <div class="form-group mb-2">
                <label for="sekolah">Sekolah</label>
                <select id="sekolah" name="sekolah" class="form-control mb-3">
                        <option value="">Tingkat Sekolah</option>
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
                <div class="sekolah invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
                <label for="kelas">Nama Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Ex : VI">
                <div class="kelas invalid-feedback"></div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-rounded btn-sm shadow-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btn-save" class="btn btn-primary btn-rounded btn-sm shadow-sm">Save</button>
            </div>
            </form> <!-- Form //-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
 $('#form-kelas').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/kelas/save')?>",
        data: $(this).serialize(),
        dataType: "json",
                    beforeSend: function() {
                    $('#btn-save').prop('disabled', true);
                    $('#btn-save').html(
                    `<div class="text-center"><div class="spinner-border spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div></div>`
                    );
                    },
                    complete: function() {
                    $('#btn-save').prop('disabled', false);
                    $('#btn-save').html(`Save`);
                    },
        success: function (response) {
            if (response.error) {
            if (response.error.kelas) {
                $('#kelas').addClass('is-invalid')
                $('.kelas').html(response.error.kelas)
            }
            if (response.error.sekolah) {
                $('#sekolah').addClass('is-invalid')
                $('.sekolah').html(response.error.sekolah)
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
                $('#modal-kelas').modal('hide')
                TableKelas(response.sekolah_id);
            }
            })
            }
        }
    });
    
 });
</script>