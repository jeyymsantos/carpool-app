<?php
if (!empty($_SESSION['message'])) :
?>
    <!-- Success Header Modal -->
    <div id="header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-<?= $bg ?>">
                    <h4 class="modal-title" id="<?= $bg ?>-header-modalLabel"><?= $title ?>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <p><?= $message ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-<?= $bg ?>" data-bs-dismiss="modal">Okay</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--Modal JS Script -->
    <script type="text/javascript">
        window.onload = () => {
            $('#header-modal').modal('show');
        }
    </script>
<?php
    unset($_SESSION['message']);
    unset($_SESSION['bg']);
    unset($_SESSION['title']);
endif ?>