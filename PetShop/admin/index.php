<?php 
    require_once('../config.php'); 
?>

<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">

    <?php require_once('include/header.php') ?>

    <body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs" style="height: auto;">
        <div class="wrapper">
            <?php require_once('include/topBarNav.php') ?>
              
            <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>

            <div class="content-wrapper pt-3">
                <section class="content  text-dark">
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
            </div>
        </div>
        <?php require_once('include/footer.php') ?>
    </body>
</html>
