<?php
    require_once('wp-load.php'); // add wordpress functionality
 
 
  if (isset($_GET['show-code'])){
 
        $userId = get_current_user_id();
        
        if($userId != 0) {
            
        global $wpdb;
        $table_name = "paid_gift_codes";
        $retrieve_data = $wpdb->get_results( "SELECT *, user_id as userID, gift_code as giftCode FROM $table_name WHERE user_id = $userId"  );
        $giftCodeArray = array();
        $counter = 0;
        
        foreach($retrieve_data as $data) {
            
            if($counter % 2 == 0) {
                if($userId ==  $data->userID) {
                    echo "<p style='background-color: #a10d0d; padding: 12px; margin: 0px;'>" . $data->giftCode . "</p>";
                }
            
            }
            
            else {
                if($userId ==  $data->userID) {
                    echo "<p style='background-color: #b23f3f; padding: 12px; margin: 0px;'>" . $data->giftCode . "</p>";
                }
            }
            
            

                
        $counter = $counter + 1 ;
        }
            
            
            
        }
        
  }
        
