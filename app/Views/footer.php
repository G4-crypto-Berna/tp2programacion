<?php if (session()->get('id')): ?>
            </div>
        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Exámenes <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Salir del sistema?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Tu sesión se cerrará.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="<?= base_url('login/salir') ?>">Salir</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="<?= base_url('vendor/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('vendor/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('vendor/js/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('vendor/js/sb-admin-2.min.js') ?>"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

<!-- Sorteo de preguntas (XHR con jQuery) -->
<script src="<?= base_url('assets/js/script.js') ?>"></script>

<script>
    $(function () {
        $('#tablaExamenes').DataTable({
            language: { url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json' },
            columnDefs: [{ orderable: false, targets: -1 }]
        });


    });
</script>
</body>
</html>
</body>
</html>