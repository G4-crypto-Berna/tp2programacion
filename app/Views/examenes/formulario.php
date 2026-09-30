<?php $editando = isset($examen); ?>

<div class="container py-4" style="max-width: 500px;">
  <h3><?= esc($titulo) ?></h3>
  <form action="<?= base_url($editando ? 'examenes/actualizar/' . $examen['id'] : 'examenes/insertar') ?>" method="post">
    <?= csrf_field() ?>
    <input type="text" name="nombreExamen" class="form-control mb-3" maxlength="50"
           placeholder="Nombre del examen" value="<?= esc($examen['nombreExamen'] ?? '') ?>" required>
    <button class="btn btn-primary">Guardar</button>
    <a href="<?= base_url('examenes') ?>" class="btn btn-secondary">Cancelar</a>
  </form>
</div>