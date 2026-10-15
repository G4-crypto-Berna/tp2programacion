<div class="container-fluid">
  <h3 class="text-center mb-3"><?= esc($titulo) ?></h3>

  <div class="text-center mb-4">
    <a href="<?= base_url('examenes/nuevo') ?>" class="btn btn-success">Nuevo examen</a>
  </div>

  <table class="table table-striped w-100" id="tablaExamenes">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($examenes as $ex): ?>
        <tr>
          <td class="text-center"><?= $ex['id'] ?></td>
          <td class="text-center"><?= esc($ex['nombreExamen']) ?></td>
          <td class="text-center">
            <a class="btn btn-sm btn-info" href="<?= base_url('examenes/ver/' . $ex['id']) ?>">Ver</a>
            <a class="btn btn-sm btn-primary" href="<?= base_url('examenes/editar/' . $ex['id']) ?>">Editar</a>
            <a class="btn btn-sm btn-danger" href="<?= base_url('examenes/borrar/' . $ex['id']) ?>"
               onclick="return confirm('Borrar este examen y sus preguntas?');">Borrar</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>