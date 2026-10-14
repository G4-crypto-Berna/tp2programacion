<h2><?= esc($examen['nombreExamen']) ?></h2>

<?php if (session()->getFlashdata('ok')): ?>
    <p style="color:green"><?= esc(session()->getFlashdata('ok')) ?></p>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red"><?= esc(session()->getFlashdata('error')) ?></p>
<?php endif; ?>

<h3>Agregar pregunta</h3>
<form id="formPregunta" action="<?= base_url('preguntas/insertar/' . $examen['id']) ?>" method="post">
    <?= csrf_field() ?>
    <textarea name="textoPregunta" id="textoPregunta" rows="3" cols="50" required></textarea><br>
    <button type="submit">Agregar</button>
</form>

<h3>Preguntas del examen</h3>
<ul id="listaPreguntas">
    <?php foreach ($preguntas as $p): ?>
        <li>
            <?= esc($p['textoPregunta']) ?>
            <a href="<?= base_url('preguntas/borrar/' . $p['id']) ?>"
               onclick="return confirm('¿Eliminar esta pregunta?')">Borrar</a>
        </li>
    <?php endforeach; ?>
</ul>