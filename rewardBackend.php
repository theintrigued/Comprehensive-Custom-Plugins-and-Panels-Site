<?php
    require_once('wp-load.php'); // add wordpress functionality
    //$entityBody = json_decode(file_get_contents('php://input'), true);
    
    if (isset($_GET['youtube']) ){
        

        $user_id = get_current_user_id();
        
        
        if($user_id != 0) {
        $youtubereward = get_user_meta( $user_id, 'youtubereward' , true );
        if($youtubereward == "false") {
          
          $totalPoints = get_user_meta( $user_id, 'totalPoints' , true ); 
          $newTotalPoints = (double)$totalPoints + 1.0;
          $newTotalPoints = number_format((double)$newTotalPoints, 2, '.', '');
          update_user_meta( $user_id, 'totalPoints', $newTotalPoints );
          update_user_meta( $user_id, 'youtubereward', "true" );
        }
    }
      
      }

      else if (isset($_GET['discord']) ){
       
        $user_id = get_current_user_id();
        
        
        if($user_id != 0) {
        $youtubereward = get_user_meta( $user_id, 'discordreward' , true );
        if($youtubereward == "false") {
          
          $totalPoints = get_user_meta( $user_id, 'totalPoints' , true ); 
          $newTotalPoints = (double)$totalPoints + 1.0;
          $newTotalPoints = number_format((double)$newTotalPoints, 2, '.', '');
          update_user_meta( $user_id, 'totalPoints', $newTotalPoints );
          update_user_meta( $user_id, 'discordreward', "true" );
        }
    }
      
      }
      
      
        else if (isset($_GET['twitter']) ){
       
        $user_id = get_current_user_id();
        
        
        if($user_id != 0) {
        $youtubereward = get_user_meta( $user_id, 'twitterreward' , true );
        if($youtubereward == "false") {
          
          $totalPoints = get_user_meta( $user_id, 'totalPoints' , true ); 
          $newTotalPoints = (double)$totalPoints + 1.0;
          $newTotalPoints = number_format((double)$newTotalPoints, 2, '.', '');
          update_user_meta( $user_id, 'totalPoints', $newTotalPoints );
          update_user_meta( $user_id, 'twitterreward', "true" );
        }
    }
      
      }
      
        else if (isset($_GET['instagram']) ){
       
        $user_id = get_current_user_id();
        
        
        if($user_id != 0) {
        $youtubereward = get_user_meta( $user_id, 'instagramreward' , true );
        if($youtubereward == "false") {
          
          $totalPoints = get_user_meta( $user_id, 'totalPoints' , true ); 
          $newTotalPoints = (double)$totalPoints + 1.0;
          $newTotalPoints = number_format((double)$newTotalPoints, 2, '.', '');
          update_user_meta( $user_id, 'totalPoints', $newTotalPoints );
          update_user_meta( $user_id, 'instagramreward', "true" );
        }
    }
      
      }
      
     else if (isset($_GET['tiktok']) ){
       
        $user_id = get_current_user_id();
        
        
        if($user_id != 0) {
        $youtubereward = get_user_meta( $user_id, 'tiktokreward' , true );
        if($youtubereward == "false") {
          
          $totalPoints = get_user_meta( $user_id, 'totalPoints' , true ); 
          $newTotalPoints = (double)$totalPoints + 1.0;
          $newTotalPoints = number_format((double)$newTotalPoints, 2, '.', '');
          update_user_meta( $user_id, 'totalPoints', $newTotalPoints );
          update_user_meta( $user_id, 'tiktokreward', "true" );
        }
    }
      
      }