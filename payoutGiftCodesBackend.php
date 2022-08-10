<?php
    require_once('wp-load.php'); // add wordpress functionality

        if (isset($_GET['withdraw-id']) ) {
            $withdrawID = $_GET['withdraw-id'];
            
                $table_name = "pending_withdrawals";
                $retrieve_data = $wpdb->get_results( "SELECT *, user_id as userID from $table_name WHERE withdraw_id = $withdrawID"  );
                        
                foreach($retrieve_data as $data) {
                    $userId = $data->userID;
                        
            }
            
            
            
            if ($userId > 0) {
            global $wpdb;
            $table_name = "gift_codes";
            $retrieve_data = $wpdb->get_results( "SELECT COUNT(*) AS giftCodeCount FROM $table_name WHERE gift_code_validity = 'true'"  );// this will get the data from your table
            $giftCodeCount = 0;
            
                    foreach($retrieve_data as $data) {
                        if((int)$data->giftCodeCount > 0) {
                            $giftCodeCount = (int)$data->giftCodeCount;
                        }
                        
                    }
            
            if($giftCodeCount == 0) {
                echo '101';
                exit();
            }
            else {
                    foreach($retrieve_data as $data) {
                        if((int)$data->giftCodeCount > 0) {
                            $giftCodeCount = (int)$data->giftCodeCount;
                        }
                        
                    }
                    
                    if ($giftCodeCount > 0) {
                        $retrieve_data = $wpdb->get_results( "SELECT Distinct gift_code_validity, gift_code_id as giftCodeId, gift_code_record_id as giftRecordId from $table_name WHERE gift_code_validity = 'true'"  );
                        
                        foreach($retrieve_data as $data) {
                            $giftCodeId = $data->giftCodeId;
                            $giftCodeRecordId =$data->giftRecordId;
                        
                    }
                    
                        $table_name = "paid_gift_codes";
                    
                        $wpdb->insert($table_name, array(
                            'user_id' => $userId,
                            'gift_code' => $giftCodeId
                        ),
                        array(
                            '%s',
                            '%s'
                        ) //replaced %d with %s - I guess that your description field will hold strings not decimals
                        );
                        
                        $table_name = "gift_codes";
                    
                        $wpdb->get_results( "UPDATE $table_name SET gift_code_validity = 'false' WHERE gift_code_record_id = $giftCodeRecordId"  );
                       
                        
                        $table_name = "pending_withdrawals";
                    
                        $wpdb->get_results( "UPDATE $table_name SET withdraw_status = 'paid' WHERE withdraw_id = $withdrawID"  );
                            
                        
                        echo '100';
                        
                        exit();
                        
                        
                        
                        
                        
                        
                    }
                    
                }
            
            
            }
            echo '101';
            exit();
            
            
            
        }
