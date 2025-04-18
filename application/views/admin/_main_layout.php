<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="<?php echo site_url() ?>/assets/img/favicon.ico"/>
    <meta name="author" content="">

    <title>LendPay</title>

    <!-- Custom fonts for this template--> 
    <link href="<?php echo site_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="<?php echo site_url() ?>https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom styles for this template-->
    <link href="<?php echo site_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo site_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?php echo site_url() ?>assets/css/style.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('admin/components/sidebar'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php $this->load->view('admin/components/navbar'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                  <?php $this->load->view($subview); ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;  2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo site_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo site_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo site_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo site_url() ?>assets/js/sb-admin-2.min.js"></script>

    <script src="<?php echo site_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo site_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo site_url() ?>assets/js/demo/chart-bar-demo.js"></script>
    <script src="<?php echo site_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable({
          "order": [],
        });
      });
    </script>

    <script type="text/javascript">base_url = '<?= base_url();?>'</script>
    <script src="<?php echo site_url(); ?>assets/js/script.js"></script>

</body>

</html>