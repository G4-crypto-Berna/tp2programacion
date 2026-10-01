<?php if (session()->get('id')): ?>
            </div><!-- /container-fluid -->
        </div><!-- /content -->

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Exámenes <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
    </div><!-- /content-wrapper -->
</div><!-- /wrapper -->

<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<!-- Modal cerrar sesión -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Salir del sistema?</h5>
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
</body>
</html>