<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-8 col-lg-4">
          <h2>Bienvenido a Cashigano</h2>
          <p><?php $this->showMessages() ?></p>

          <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST">
            <div class="mb-3">
              <label for="i_username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="i_password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" autocomplete="off">
            </div>
            <input type="submit" value="Iniciar sesion" class="btn btn-primary"/>
            <p>¿No tienes una cuenta? <a href="<?php echo URL ?>signup">Registrar cuenta.</a></p>
          </form>    
        </div>
      </div>
    </div>

    <?php include_once 'views/includes/footer.php'?>