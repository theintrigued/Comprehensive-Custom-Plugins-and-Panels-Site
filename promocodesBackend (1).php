<?php
    require_once('wp-load.php'); // add wordpress functionality

    if (isset($_GET['promocode_value']) ){
        

        $user_id = get_current_user_id();
        
        
        if($user_id != 0 ) {
        $promocode = $_GET['promocode_value'];
          
          $currentPromocodeSet = 'YOUTUBE2022';
          $totalPoints = get_user_meta( $user_id, 'totalPoints' , true );
          $currentPromocodeValueInDatabase = get_user_meta( $user_id, $currentPromocodeSet , true ); //get promocode validity for current user for current code from database
          
          if(($promocode == $currentPromocodeSet) && ($currentPromocodeValueInDatabase == "false")  ){
            
            $newTotalPoints = (int)$totalPoints + 10.0;
            update_user_meta( $user_id, 'totalPoints', $newTotalPoints );
            
            
            update_user_meta( $user_id, $currentPromocodeSet , "true" );
              
              echo "100" ; //Promode code valid
          }
          else {
              echo "101" ; //invalid withdraw amount

          }

        
    }
      
      }