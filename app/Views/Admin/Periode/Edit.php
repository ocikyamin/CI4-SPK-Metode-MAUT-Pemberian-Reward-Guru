<div id="modal-periode" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           

            <div class="modal-header">
                <h4 class="modal-title">
                Edit Periode
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-periode" method="post">
                <?=csrf_field()?>
                <input type="hidden" name="id" value="<?=$periode['id']?>">
                <input type="hidden" name="periode_old" value="<?=$periode['periode']?>">
            <div class="modal-body">

            <div class="form-group mb-2">
                <label for="periode">Periode Penilaian</label>
                <input type="text" class="form-control" id="periode" name="periode" value="<?=$periode['periode']?>" placeholder="Ex : Januari 2023">
                <div class="periode invalid-feedback"></div>
            </div>
            <div class="form-group mb-2">
                <label for="tahun">Tahun Akademik</label>
                <input type="text" class="form-control" id="tahun" name="tahun" value="<?=$periode['tahun_akademik']?>" placeholder="Ex : 2023/2024 - Semester 1">
                <div class="tahun invalid-feedback"></div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-rounded btn-sm shadow-sm" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btn-update" class="btn btn-primary btn-rounded btn-sm shadow-sm">Save Changes</button>
            </div>
            </form> <!-- Form //-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
 $('#form-periode').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/periode/update')?>",
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
                    $('#btn-update').html(`Save Changes`);
                    },
        success: function (response) {
            if (response.error) {
            if (response.error.periode) {
                $('#periode').addClass('is-invalid')
                $('.periode').html(response.error.periode)
            }
            if (response.error.tahun) {
                $('#tahun').addClass('is-invalid')
                $('.tahun').html(response.error.tahun)
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
                $('#modal-periode').modal('hide')
                TablePeriode();
            }
            })
            }
        }
    });
    
 });
</script>