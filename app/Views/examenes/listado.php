<div class="container-fluid">
  <div class="d-flex justify-content-between mb-3">
    <h3><?= esc($titulo) ?></h3>
    <a href="<?= base_url('examenes/nuevo') ?>" class="btn btn-primary">Nuevo examen</a>
  </div>

  <ul class="list-group">
    <?php foreach ($examenes as $ex): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?= esc($ex['nombreExamen']) ?>
        <span class="d-flex">
          <a href="<?= base_url('examenes/ver/' . $ex['id']) ?>" class="btn btn-sm btn-info mr-1">Ver</a>
          <a href="<?= base_url('examenes/editar/' . $ex['id']) ?>" class="btn btn-sm btn-warning mr-1">Editar</a>
          <form action="<?= base_url('examenes/borrar/' . $ex['id']) ?>" method="post"
                onsubmit="return confirm('¿Borrar este examen y sus preguntas?');">
            <?= csrf_field() ?>
            <button class="btn btn-sm btn-danger">Borrar</button>
          </form>
        </span>
      </li>
    <?php endforeach; ?>
    <?php if (empty($examenes)): ?>
      <li class="list-group-item text-muted">Todavía no tenés exámenes.</li>
    <?php endif; ?>
  </ul>
</div>