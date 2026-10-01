<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="<?= base_url('vendor/css/logincss/draw2.webp') ?>" class="img-fluid" alt="Login">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="<?= base_url('login/validacion') ?>" method="post">
          <?= csrf_field() ?>
          <h3 class="mb-4">Iniciar sesión</h3>

          <div class="form-group mb-4">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" class="form-control form-control-lg" required autofocus>
          </div>

          <div class="form-group mb-3">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control form-control-lg" required>
          </div>

          <div class="text-center text-lg-left mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg px-5">Ingresar</button>
            <p class="small font-weight-bold mt-2 pt-1 mb-0">¿No tenés cuenta?
              <a href="<?= base_url('registro') ?>" class="text-danger">Registrate</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-between py-4 px-4 px-xl-5 bg-primary text-white">
    <div>Copyright © <?= date('Y') ?>. Todos los derechos reservados.</div>
  </div>
</section>