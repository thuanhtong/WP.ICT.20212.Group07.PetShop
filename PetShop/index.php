<?php 
  require_once('config.php'); 
  require_once('include/header.php');
  require_once('include/topBarNav.php');
?>

<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<body>
    <?php $page = isset($_GET['p']) ? $_GET['p'] : 'home';  ?>
    <?php 
        if(!file_exists($page.".php") && !is_dir($page)){
            include '404.html';
        }else{
        if(is_dir($page))
            include $page.'/index.php';
        else
            include $page.'.php';

        }
    ?>
    
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
    <div class="modal fade" id="message_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
    <div class="modal fade" id="uni_modal_right" role='dialog'>
        <div class="modal-dialog  rounded-0 modal-full-height  modal-md" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="fa fa-arrow-right"></span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewer_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-dismiss="modal">
                    <span class="fa fa-times"></span>
                </button>
                <img src="" alt="">
            </div>
        </div>
    </div>
    <?php require_once('include/footer.php') ?>
</body>
</html>