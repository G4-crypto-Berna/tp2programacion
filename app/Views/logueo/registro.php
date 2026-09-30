<div class="container" style="max-width: 420px;">
  <h3 class="my-4">Crear cuenta</h3>
  <form action="<?= base_url('registro/guardar') ?>" method="post">
    <?= csrf_field() ?>
    <input type="text" name="usuario" class="form-control mb-3" placeholder="Usuario" maxlength="50" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña (mínimo 8)" required>
    <input type="password" name="password_confirm" class="form-control mb-3" placeholder="Repetir contraseña" required>
    <button type="submit" class="btn btn-primary">Registrarme</button>
    <a href="<?= base_url('login') ?>" class="btn btn-link">Volver</a>
  </form>
</div>