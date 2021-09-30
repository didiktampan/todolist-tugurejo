<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body style="background-color:LightGray;">
  <div class="container">
    <!-- grid -->
    <div class="row">
      <div class="col-sm-5 mx-auto mt-5 pt-5">
        <div class="login-logo">
          <a href="<?php echo base_url() ?>">
            <!-- <img src="<?php echo base_url() ?>assets/images/pemprov.png" alt="" style="width: 20%;height: auto;"> -->
            <b>Todolist | RSUD Tugurejo </b>
            <img src="<?php echo base_url() ?>assets/images/logo.png" alt="" style="width: 20%;height: auto;">
          </a>
        </div>
        <div class="card">
          <div class="col-md-12 text-center"><?php echo $this->session->flashdata('errorMessage'); ?></div>
          <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?php echo form_open('AuthCovid/login_proses', ''); ?>
            <form id="formlogin">
              <div class="input-group mb-3">
                <input type="text" name="USLOGNM" placeholder="Username" class="form-control">
                <!-- <input type="username" class="form-control" placeholder="Username" name="username" id="username"> -->
                <!-- <input type="hidden" class="form-control" name="private_token" id="private_token" value="<?php echo $token; ?>"> -->
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="USPASS" class="form-control" placeholder="Password" id="exampleInputPassword1">
                <!-- <input type="password" class="form-control" placeholder="Password" name="password" id="password"> -->
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember" required>
                    <label for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
            </form>
            <!-- /.col -->
            <!-- <div class="col-4">
                            <button id="btnlogin" type="button" class="btn btn-primary">Sign In</button>
                        </div> -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
            <!-- /.col -->
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<!-- /.login-card-body -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>