
<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
        <meta charset="utf-8" />
        <title>Log In | PKG</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>/public/images/favicon.ico">
        
        <!-- App css -->
        <link href="<?=base_url()?>/public/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/public/css/app-creative.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="<?=base_url()?>/public/css/app-creative-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    </head>

    <body class="authentication-bg" data-layout-config='{"darkMode":false}'>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="card">

                            <!-- Logo -->
                            <div class="text-center mt-2">
                                <a href="<?=base_url()?>">
                                    <span><img src="<?=base_url()?>/public/logo.png" alt="" height="80"></span>
                                </a>
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center mt-0 fw-bold">Penilaian Kinerja Guru</h4>
                                    <div class="text-muted">Madrasah Tarbiyah Islamiyah (MTI) Canduang</div>
                                </div>
                            </div>
                            <div class="card-body p-4">

                                <form id="login-form" method="post">

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="text" name="email" id="email" placeholder="Email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-0 text-center">
                                    <div class="d-grid">
                                        <button class="btn btn-primary" id="btn-login" type="submit"> Login</button>
                                    </div>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            2023 © PKG - Abdul Yamin
        </footer>

        <!-- bundle -->
        <script src="<?=base_url()?>/public/js/vendor.min.js"></script>
        <script src="<?=base_url()?>/public/js/app.min.js"></script>
        <script>
         $(document).ready(function () {


    // alert('okkk')
    $('#login-form').submit(function (e) { 
    e.preventDefault();
    $.ajax({
    type: "post",
    url: "./auth/check",
    data: $(this).serialize(),
    dataType: "json",
    beforeSend: function() {
    $('#btn-login').prop('disabled', true);
    $('#btn-login').html(
    `<div class="text-center"><div class="spinner-border spinner-border spinner-border-sm" role="status">
    <span class="visually-hidden">Loading...</span>
    </div></div>`
    );
    },
    complete: function() {
    $('#btn-login').prop('disabled', false);
    $('#btn-login').html(`Login`);
    },

    success: function (response) {
    if (response.error) {
        if (response.error.email) {
        $.toast({
        position :'top-right',
        heading: 'Warning',
        text : response.error.email,
        showHideTransition: 'fade',
        icon: 'error'
        });
        }

        if (response.error.password) {
        $.toast({
        position :'top-right',
        heading: 'Warning',
        text : response.error.password,
        showHideTransition: 'fade',
        icon: 'error'
        }); 
        }

    } // end Error

    if (response.sukses) {
        $.toast({
            position :'top-right',
        heading: 'Success',
        text: 'Login Berhasil. Anda akan diarahkan ke halaman Dashboard',
        showHideTransition: 'slide',
        icon: 'success',
        hideAfter: 1000,
        afterHidden: function () {
        window.location=response.link;
        }
        })

       
    }



    // Swal.fire({
    // icon: 'success',
    // title: 'Success',
    // text : 'Login Berhasil, Klik tombol dibawah ini untuk di arahkan ke halaman dashboard',
    // showConfirmButton: true,
    // confirmButtonText: 'Open Dashboard',
    // }).then((result) => {
    // window.location=response.link;
    // })

    

    }
    });

    });



    });
        </script>
        
    </body>
</html>
