<?php
    require_once('wp-load.php'); // add wordpress functionality


    if (isset($_GET['get_referral_link']) ){
        $getReferralLink = $_GET['get_referral_link'];
        
        if($getReferralLink == "true") {
            $current_user = wp_get_current_user();
            
            if ($current_user->id != 0) {
            echo "https://getbuxnow.com/refer/?refer=". $current_user->user_login;
            die();
            }
            
            echo "<p style='display:none;'></p>";
            
          
            
            
        }
        
    }
    
    
    
