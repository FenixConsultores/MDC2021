<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  

  <title>Login Admin</title>

  <!-- Icons -->
  <link href="<?= base_url();?>assets/css/fontawesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/style.min.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/bootstrap.min.css">
  <!-- Styles required by this views -->

</head>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-5">
        <input type="hidden" name="route" id="route" value="<?= base_url();?>">        
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <form id="formLoginAdmin">
                <!-- <h1>ACCESO</h1> -->
                <img width="100%" style="margin-bottom: 20px;" src="<?= base_url();?>assets/img/various/brand.png">      
                <p class="text-muted text-center">Ingresa a tu cuenta de mariasdechocolate</p>
                <div class="input-group mb-3">
                  <span class="input-group-addon"><i class="fas fa-user"></i></span>
                  <input type="email" name="mailAdmin" class="form-control" id="mailAdmin" placeholder="Correo">
                </div>
                <div class="input-group mb-3">
                  <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                  <input type="password" name="passwordAdmin" class="form-control" id="passwordAdmin" placeholder="Contraseña">
                </div>
                <div class="row">
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary" style="border-radius: 0;" id="btnSignIn">acceder <i class="fas fa-sign-in-alt"></i></button>
                  </div>
                  <div class="col-6 text-right">
                   <!--  <button type="button" class="btn btn-link px-0">Forgot password?</button> -->
                  </div>
                </div>
            </form>
            </div>
          </div>         
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="<?= base_url();?>assets/js/jquery.js"></script>
  <script src="<?= base_url();?>assets/js/popper.min.js"></script>
  <script src="<?= base_url();?>assets/js/bootstrap.js"></script>
  <script src="<?= base_url();?>assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?= base_url();?>assets/js/main/login.js"></script>
</body>
</html>