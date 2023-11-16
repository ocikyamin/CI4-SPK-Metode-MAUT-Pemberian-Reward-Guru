<div id="modal-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">


            <div class="modal-header">
                <h4 class="modal-title">
                    New User
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form id="forms-user" method="post">
                <?=csrf_field()?>
                <div class="modal-body">

                    <div class="form-group mb-2">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            placeholder="Ex : Abdul Yamin">
                        <div class="fullname invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Ex : ocikyamin@gmail.com">
                        <div class="email invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="newpass">Password Baru</label>
                        <input type="password" class="form-control" id="newpass" name="newpass"
                            placeholder="Masukkan Password Baru">
                        <div class="newpass invalid-feedback"></div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="confpass">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confpass" name="confpass"
                            placeholder="Masukkan Konfirmasi Password">
                        <div class="confpass invalid-feedback"></div>
                    </div>
                    <h6 class="font-15 mt-2">Hak Akses</h6>
                    <?php
                    foreach (Tabel('user_role') as $d) {?>

                    <div class="role-akses form-check form-radio-success mb-2">
                        <input type="radio" id="role-<?=$d['id']?>" name="role" value="<?=$d['id']?>"
                            class="role form-check-input">
                        <label class="form-check-label" for="role-<?=$d['id']?>"><?=$d['role_name']?></label>
                    </div>
                    <?php } ?>
                    <div class="txtrole invalid-feedback"></div>
                    <div id="supervisor" class="form-group mb-2 d-none">
                        <label for="sekolah">Supervisor Untuk Sekolah ?</label>
                        <select name="sekolah" id="sekolah" class="form-control">
                            <option value="">Pilih Sekolah</option>
                            <?php
                    foreach (Tabel('sekolah') as $d) {?>
                            <option value="<?=$d['id']?>"><?=$d['nama_sekolah']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="sekolah invalid-feedback"></div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-rounded btn-sm shadow-sm"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btn-save"
                        class="btn btn-primary btn-rounded btn-sm shadow-sm">Save</button>
                </div>
            </form> <!-- Form //-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$('.role').change(function(e) {
    e.preventDefault();
    if ($(this).val() !== "1") {
        $('#supervisor').removeClass('d-none')
        $('#sekolah').val('')
        $('#sekolah').attr("required", "required");

    } else {
        $('#supervisor').addClass('d-none')
        $('#sekolah').val('')
        $('#sekolah').removeAttr("required");
    }

});


$('#forms-user').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?=base_url('admin/user/save')?>",
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
        success: function(response) {
            if (response.error) {
                if (response.error.email) {
                    $('#email').addClass('is-invalid')
                    $('.email').html(response.error.email)
                }
                if (response.error.fullname) {
                    $('#fullname').addClass('is-invalid')
                    $('.fullname').html(response.error.fullname)
                }
                if (response.error.newpass) {
                    $('#newpass').addClass('is-invalid')
                    $('.newpass').html(response.error.newpass)
                }
                if (response.error.confpass) {
                    $('#confpass').addClass('is-invalid')
                    $('.confpass').html(response.error.confpass)
                }
                if (response.error.role) {
                    $('.role-akses').addClass('is-invalid')
                    $('.txtrole').html(response.error.role)
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
                        $('#modal-user').modal('hide')
                        TableUsers();
                    }
                })
            }
        }
    });

});
</script>