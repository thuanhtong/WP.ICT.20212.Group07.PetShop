<?php 
    require_once('../config.php'); 
?>

<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">

    <?php require_once('include/header.php') ?>

    <body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs" style="height: auto;">
        <div class="wrapper">
            <?php require_once('include/topBarNav.php') ?>
            <?php require_once('include/leftBarNav.php') ?> 
            <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>

            <div class="content-wrapper pt-3">
                <section class="content text-dark">
                    <div class="container-fluid">
                        <?php 
                            if(!file_exists($page.".php") && !is_dir($page)){
                                include '404.html';
                            } else {
                                if(is_dir($page)) {
                                    include $page.'/index.php';
                                } else {
                                    include $page.'.php';
                                }
                            }
                        ?>
                    </div>
                </section>

                <div class="modal fade" id="confirm_modal" role='dialog'>
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmation</h5>
                            </div>
                            <div class="modal-body">
                                <div id="delete_content"></div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="uni_modal" role='dialog'>
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"></h5>
                            </div>
                            <div class="modal-body"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="uni_modal_right" role='dialog'>
                    <div class="modal-dialog modal-full-height  modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="fa fa-arrow-right"></span>
                                    </button>
                            </div>
                            <div class="modal-body"></div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="viewer_modal" role='dialog'>
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                            <img src="" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once('include/footer.php') ?>
    </body>
</html>
