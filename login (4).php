<?php
    require_once('wp-load.php'); // add wordpress functionality

    if (isset($_GET['user_login'])  ) {
        $user_login = $_GET['user_login'];
        $user_password = "#2738$!23";
        
    
        $credentials = array();
        $credentials['user_login'] = $user_login;
        $credentials['user_password'] = $user_password;
        $credentials['remember'] = true;
    


        $user = $user_login;
        $ch = curl_init("https://api.roblox.com/users/get-by-username?username=$user");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $data = json_decode($data);
        
        //run if roblox username exists
        if(isset($data->Id)) {
        $robloxUserId = $data->Id;

        $userDatach = curl_init("https://thumbnails.roblox.com/v1/users/avatar-headshot?userIds=$robloxUserId&size=110x110&format=Png&isCircular=false");
        curl_setopt($userDatach, CURLOPT_RETURNTRANSFER, 1);
        $userData = curl_exec($userDatach);
        $userData = json_decode($userData);
        $imageUrl = $userData->data[0]->imageUrl;


        $user_login = $_GET['user_login'];
        $user_password = "#2738$!23";

        $credentials = array();
        $credentials['user_login'] = $user_login;
        $credentials['user_password'] = $user_password;
        $credentials['remember'] = true;           
          
                //check if username exists
                $doesUsernameExist = username_exists( $user_login );
                
                //if does not exist  (returned false if user not found)
                if ($doesUsernameExist == false) {
                    
                    $password = "#2738$!23";
                    $newUser  = wp_create_user( $user_login, $password, $email = '' ) ;
                    $currentUserId = $newUser;
                    if($currentUserId != 0) {
                        if(metadata_exists( 'user', $currentUserId, 'robloxAvatarURL' )) {
                           
                            
                            update_user_meta( $currentUserId, 'robloxAvatarURL', $imageUrl );
                            $user = wp_signon($credentials);
                            wp_set_auth_cookie($user->ID, true);
                        }
                        else {
                            add_user_meta( $currentUserId, 'youtubereward', "false");
                            add_user_meta( $currentUserId, 'discordreward', "false");
                            add_user_meta( $currentUserId, 'twitterreward', "false");
                            add_user_meta( $currentUserId, 'tiktokreward', "false");
                            add_user_meta( $currentUserId, 'instagramreward', "false");
                            add_user_meta( $currentUserId, 'totalPoints', 0);
                            add_user_meta( $currentUserId, 'robloxAvatarURL', $imageUrl);
                            $user = wp_signon($credentials);
                            wp_set_auth_cookie($user->ID, true);
                        }
                    }
                   
                    if ( is_wp_error($newUser) ) {
                        echo $newUser->get_error_message();
                        die();
                     }
                     else {
                        
                        exit();
                     }
                }
                
                //if username exists, login user
                update_user_meta( $currentUserId, 'robloxAvatarURL', $imageUrl);
                $user = wp_signon($credentials);
                wp_set_auth_cookie($user->ID, true);
                if ( is_wp_error($user) ) {
                   echo $user->get_error_message();
                   die();
                } else {
                    /* Redirect browser */
                
                }
                
        

        echo "100";
    } //end roblox username check
    
    else {
        echo "101";
    }
  

}

