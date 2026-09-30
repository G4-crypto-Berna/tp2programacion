<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($titulo ?? 'Exámenes') ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>
<body>

<?php if (session()->get('id')): ?>
    <nav class="navbar navbar-dark bg-primary px-3">
        <a class="navbar-brand" href="<?= base_url('examenes') ?>">Exámenes</a>
        <span class="text-white">
            Hola, <?= esc(session()->get('usuario')) ?>
            <a class="btn btn-light btn-sm ms-2" href="<?= base_url('login/salir') ?>">Salir</a>
        </span>
    </nav>
<?php endif; ?>

<div class="container mt-3">
    <?php if (session()->getFlashdata('ok')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('ok')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>
</div>