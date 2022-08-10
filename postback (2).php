<?php
    require_once('wp-load.php'); // add wordpress functionality
    

        if (isset($_GET['conversion_id']) && isset($_GET['user_id']) && isset($_GET['points'])   ) {
            

            $conversionId = $_GET['conversion_id'];
            $user_id = $_GET['user_id'];
            $point_value = $_GET['points'];

            
            $totalPoints = get_user_meta( $user_id, 'totalPoints' , true ); 
            
            $newTotalPoints = (double)$totalPoints + (double)$point_value;
            $newTotalPoints = number_format((double)$newTotalPoints, 2, '.', '');

            if(metadata_exists( 'user', $user_id, 'totalPoints' )) {

                update_user_meta( $user_id, 'totalPoints', $newTotalPoints);
             
            }
            
            //Referral Stuff
            global $wpdb;
            $table_name = "user_referrals";
            $retrieve_data = $wpdb->get_results( "SELECT user_id FROM $table_name WHERE referral_user_id = $user_id"  );// this will get the data from your table
            $referral_found = false;
            
            if(!$retrieve_data) {
                echo "array empty";
            }
            else {
                $referral_found = true;
                foreach($retrieve_data as $data) {
                     $referral_user_id = $data->user_id;
                     
                    $referalTotalPoints = get_user_meta( $referral_user_id, 'totalPoints' , true ); 
                    
                    $referalNewTotalPoints = (double)$referalTotalPoints + ((double)$point_value * 0.3);
                    $referalNewTotalPoints = number_format((double)$referalNewTotalPoints, 2, '.', '');
                    
                    update_user_meta( $referral_user_id, 'totalPoints', $referalNewTotalPoints);
                    echo "Referal Updated";
                }
            
            }
            
            
            
            

            
        }
        
        

            

        
     
 
    

    
   