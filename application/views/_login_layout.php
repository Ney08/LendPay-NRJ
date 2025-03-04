<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LendPay NRJ - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo site_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo site_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo site_url() ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="bg-gradient-light">

    <div class="container  ">
        
        <!-- Outer Row -->
        <div class="row justify-content-center ">

            <div class="col-xl-6 col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 justify-content-centerr border-left-danger ">
                    <div class="card-body card-bodyp p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
            
                            <div class="col-lg-12 ">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido de nuevo!</h1>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="grey" class="bi bi-person-circle " viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
</svg>
                                    </div>
                                    <?php if ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                            <?= $this->session->flashdata('error') ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif ?>
                                    <?php if(validation_errors()): ?>
                                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                            <?= validation_errors() ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif ?>
                                    <form class="user" acction="<?php echo site_url('user/login') ?>" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control form-control-user"
                                                    name="email"
                                                    placeholder="Email...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-lock"></i>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control form-control-user"
                                                    name="password"
                                                    placeholder="Contraseña">
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-danger btn-user btn-login btn-block">
                                            Iniciar sesión
                                        </button>   
        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo site_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo site_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        .justify-content-centerr{
            margin-top: 35% !important;
        }
    </styl>

</body>

</html>