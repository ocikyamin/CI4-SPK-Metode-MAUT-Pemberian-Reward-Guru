<div id="modal-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">


            <div class="modal-header">
                <h4 class="modal-title">
                    Ganti Password
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="form-password" method="post">
                <?=csrf_field()?>
                <div class="modal-body">


                    <div class="form-group mb-2">
                        <label for="oldpass">Password Lama</label>
                        <input type="text" class="form-control" id="oldpass" name="oldpass"
                            placeholder="Masukkan Password Lama">
                        <div class="oldpass invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="newpass">Password Baru</label>
                        <input type="text" class="form-control" id="newpass" name="newpass"
                            placeholder="Masukkan Password Baru">
                        <div class="newpass invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="confpass">Konfirmasi Password</label>
                        <input type="text" class="form-control" id="confpass" name="confpass"
                            placeholder="Konfirmasi Password">
                        <div class="confpass invalid-feedback"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-rounded btn-sm shadow-sm"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btn-change" class="btn btn-primary btn-rounded btn-sm shadow-sm">Change
                        Password</button>
                </div>
            </form> <!-- Form //-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$('#form-password').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/account/change')?>",
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {
            $('#btn-change').prop('disabled', true);
            $('#btn-change').html(
                `<div class="text-center"><div class="spinner-border spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div></div>`
            );
        },
        complete: function() {
            $('#btn-change').prop('disabled', false);
            $('#btn-change').html(`Change Password`);
        },
        success: function(response) {
            if (response.error) {
                if (response.error.oldpass) {
                    $('#oldpass').addClass('is-invalid')
                    $('.oldpass').html(response.error.oldpass)
                }
                if (response.error.newpass) {
                    $('#newpass').addClass('is-invalid')
                    $('.newpass').html(response.error.newpass)
                }
                if (response.error.confpass) {
                    $('#confpass').addClass('is-invalid')
                    $('.confpass').html(response.error.confpass)
                }

            } // end Error

            if (response.status) {
                $.toast({
                    position: 'top-right',
                    heading: 'Berhasil',
                    text: response.msg,
                    showHideTransition: 'slide',
                    hideAfter: 1000,
                    icon: 'success',
                    afterHidden: function() {
                        $('#modal-password').modal('hide')
                        window.location.reload()
                    }
                })
            }
        }
    });

});
</script>