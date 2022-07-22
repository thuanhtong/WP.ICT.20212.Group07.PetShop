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
    </body>
</html>