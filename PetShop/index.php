<?php 
    require_once('config.php'); 
    require_once('include/header.php');
    require_once('include/topBarNav.php');
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <?php $page = isset($_GET['p']) ? $_GET['p'] : 'home';  ?>
        <?php 
            if(!file_exists($page.".php") && !is_dir($page)){
                include '404.html';
            } else {
            if(is_dir($page))
                include $page.'/index.php';
            else
                include $page.'.php';
            }
        ?>

        <?php require_once('include/footer.php') ?>
        <div class="modal fade" id="uni_modal" role='dialog'>
            <div class="modal-dialog   rounded-0 modal-md modal-dialog-centered" role="document">
                <div class="modal-content  rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                    </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>