<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <div class="row section">
      <div class="card w-75">
        <div class="card-body">
          <h5 class="card-title">Login</h5>
          <?php if (!empty($errors)) :; ?>
            <div class="card bg-danger p-4 m-3">
              <?php
              foreach ($errors as $key => $error) {
                echo '<li class="text-white" >' . $error . '</li>';
              }; ?>
            </div>
          <?php endif; ?>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" name="login">
            <div class="mb-3 row">
              <label for="user" class="col-sm-2 col-form-label">Usuario</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="user" placeholder="Usuario" name="user" value="<?php echo htmlspecialchars(!$successfully && isset($user) ? $user : ''); ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
              </div>
            </div>
            <div class="col-auto text-center mt-4">
              <input id="submit" class="btn btn-md btn-success" type="submit" name="submit" value="Enviar">
              <p class="my-2"><a href="sigin.php" class="">Join now</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>