<div id="modal-mapel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           

            <div class="modal-header">
                <h4 class="modal-title">
                New Mata Pelajaran
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-mapel" method="post">
                <?=csrf_field()?>
            <div class="modal-body">

            <div class="form-group mb-2">
                <label for="mapel">Nama Mata Pelajaran</label>
                <input type="text" class="form-control" id="mapel" name="mapel" placeholder="Ex : Informatika">
                <div class="mapel invalid-feedback"></div>
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
 $('#form-mapel').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/mapel/save')?>",
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
            if (response.error.mapel) {
                $('#mapel').addClass('is-invalid')
                $('.mapel').html(response.error.mapel)
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
                $('#modal-mapel').modal('hide')
                TableMapel();
            }
            })
            }
        }
    });
    
 });
</script>