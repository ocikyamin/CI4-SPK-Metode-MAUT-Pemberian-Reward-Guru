<?= $this->extend('Admin/Layouts') ?>
<?= $this->section('content') ?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">My Account</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Account Setting</h5>
                <hr>
                <form method="post" id="user-form">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= UserLogin()->id ?>">
                    <input type="hidden" name="old_email" value="<?= UserLogin()->email ?>">
                    <?php
                    // var_dump(UserLogin());
                    ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="email" id="email" placeholder="name@example.com"
                            value="<?= UserLogin()->email ?>" />
                        <label for="email">Email address</label>
                        <div class="email invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="fullname" id="fullname"
                            placeholder="name@example.com" value="<?= UserLogin()->full_name ?>" />
                        <label for="fullname">Full Name</label>
                        <div class="fullname invalid-feedback"></div>
                    </div>
                    <button type="submit" id="btn-user-update" class="btn btn-success">Update</button>
                    <button type="button" id="btn-change-pwd" class="btn btn-warning">Change Password</button>

                </form>

            </div>
        </div> <!-- end card -->
    </div>

</div>
<!-- end row -->
<div class="modalview"></div>
<script>
$('#user-form').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "<?= base_url('admin/account/update') ?>",
        data: $(this).serialize(),
        dataType: "json",
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
            }
            if (response.sukses) {
                $.toast({
                    position: 'top-right',
                    heading: 'Berhasil',
                    text: response.msg,
                    showHideTransition: 'slide',
                    hideAfter: 1000,
                    icon: 'success',
                    afterHidden: function() {
                        window.location.reload();
                    }
                })
            }

        }
    });

});

$('#btn-change-pwd').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: "<?=base_url('admin/account/form-pwd')?>",
        data: "data",
        dataType: "json",
        success: function(response) {
            $('.modalview').html(response.form_pwd).show()
            $('#modal-password').modal('show')
        }
    });

});
</script>


<?= $this->endSection() ?>