<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url()?>/dist/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/css/register.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url()?>/dist/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url()?>/dist/adminlte/plugins/daterangepicker/daterangepicker.css">

    <title>Register - Faculty and Employees Association</title>
  </head>
  <body>
    <?= form_open_multipart('register/verify');?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                <div class="card reg">
                    <div class="card-header">
                        <h3>Registration</h3>
                    </div>
                    <div class="card-body">
                        <?= view('register/personal_info')?>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row-reverse">
                            <input class="btn btn-primary" type="submit" value="Register">
                        </div>
                    </div>
                </div> <!--card-->
            </div> <!--d-flex-->
        </div> <!--col-md-12-->
      </div> <!--row-->
    </div> <!--container-->
    <?= form_close();?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url()?>/dist/adminlte/plugins/jquery/jquery.js"></script>
    <script src="<?= base_url()?>/dist/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url()?>/dist/bootstrap/js/bootstrap.min.js"></script>    
    <!-- InputMask -->
    <script src="<?= base_url()?>/dist/adminlte/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url()?>/dist/adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="<?= base_url()?>/dist/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Page scripts -->
    <script>
        $(function() {
            $('input[name="birthdate"]').daterangepicker({
                "locale": {
                    "format": "MMM DD,YYYY",
                    cancelLabel: 'Clear'
                },
                startDate: '01/01/2010',
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1960,
                // autoUpdateInput: false,
                maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
            });
        });
    </script>
  </body>
</html>