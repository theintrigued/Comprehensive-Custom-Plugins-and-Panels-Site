<?php
    require_once('wp-load.php'); // add wordpress functionality
    
    
    //echo "IP Address" . $_SERVER['REMOTE_ADDR'];
    if (isset($_GET['logout'])) {
        $doLogOut = $_GET['logout'];
        if($doLogOut == true) {
            wp_logout();
            exit();
        }
   

    }