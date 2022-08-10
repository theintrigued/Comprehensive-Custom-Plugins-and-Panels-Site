<?php
    require_once('wp-load.php'); // add wordpress functionality


    if (isset($_GET['refer']) && isset($_GET['username'])  ){
    
    $referral_username = $_GET['refer'];
    $user = get_user_by('login', $referral_username);
    $current_user_username = $_GET['username'];
    $current_user = get_user_by('login', $current_user_username );

    
    if(($user != false) && ($current_user != false) ) {
            $current_user_id = $current_user->id;
            $user_id = $user->id;
            global $wpdb; 
            $table_name = "user_referrals";
        
            $wpdb->insert($table_name, array(
                'user_id' => $user_id,
                'referral_user_id' => $current_user_id
            ),
            array(
                '%s',
                '%s'
            ) //replaced %d with %s - I guess that your description field will hold strings not decimals
            );
            
            echo "100";
    
    }
    else if(($user == false)) {
        echo "101";
        
    }
    

}