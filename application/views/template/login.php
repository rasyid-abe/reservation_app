<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Grha PETCARE</title>
        <link href="<?= base_url() ?>/themes/css/styles.css" rel="stylesheet" />
        <script src="<?= base_url() ?>themes/js/all.min.js" crossorigin="anonymous"></script>
        <style media="screen">
        /* body {
            background-image: url(themes/assets/img/cat1.jpg);
            background-repeat: no-repeat;
        } */
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <?php echo template_echo('content');?>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Reservation & Homecare Grha Petcare <?php echo date('Y') ?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?= base_url() ?>themes/js/jquery-3.4.1.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>themes/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>/themes/js/scripts.js"></script>
    </body>
</html>
