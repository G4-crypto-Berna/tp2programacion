<div class="container py-4">
  <a href="<?= base_url('examenes') ?>">&larr; Volver</a>
  <h3 class="my-3"><?= esc($examen['nombreExamen']) ?></h3>

  <form action="<?= base_url('preguntas/insertar/' . $examen['id']) ?>" method="post" class="mb-4">
    <?= csrf_field() ?>
    <textarea name="textoPregunta" class="form-control mb-2" rows="2" placeholder="Escribí la pregunta" required></textarea>
    <button class="btn btn-primary">Agregar pregunta</button>
  </form>

  <div class="card card-body mb-4">
    <h5>Sortear preguntas</h5>
    <form id="formSorteo" action="<?= base_url('preguntas/sortear/' . $examen['id']) ?>" method="post" class="d-flex gap-2">
      <?= csrf_field() ?>
      <input type="number" name="cantidad" id="cantidad" class="form-control w-auto" min="1" value="1" required>
        <button class="btn btn-success">Sortear</button>
        <button type="button" id="btnReiniciar" class="btn btn-outline-secondary"
        data-url="<?= base_url('preguntas/reiniciar/' . $examen['id']) ?>">Reiniciar sorteo</button>
    </form>
    <p id="msgSorteo" class="mt-2 mb-0"></p>
    <ol id="resultadoSorteo" class="mt-2"></ol>
  </div>

  <ol class="list-group list-group-numbered">
    <?php foreach ($preguntas as $p): ?>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?= esc($p['textoPregunta']) ?>
        <form action="<?= base_url('preguntas/borrar/' . $p['id']) ?>" method="post">
          <?= csrf_field() ?>
          <button class="btn btn-sm btn-danger">Borrar</button>
        </form>
      </li>
    <?php endforeach; ?>
    <?php if (empty($preguntas)): ?>
      <li class="list-group-item text-muted">Este examen todavía no tiene preguntas.</li>
    <?php endif; ?>
  </ol>
</div>