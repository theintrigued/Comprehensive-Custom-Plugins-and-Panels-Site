<?php
    require_once('wp-load.php'); // add wordpress functionality

    if (isset($_GET['withdraw_amount']) ){
        

        $user_id = get_current_user_id();
        
        
        if($user_id != 0 ) {
        $withdraw_amount = $_GET['withdraw_amount'];
          
          $totalPoints = get_user_meta( $user_id, 'totalPoints' , true );
          
          if(((double)$withdraw_amount > (double)$totalPoints) ){
              echo "101" ; //invalid withdraw amount
          }
          else if((int)$withdraw_amount < 0){
              echo "101" ; //invalid withdraw amount

          }
          
          else if(((double)$totalPoints != 0.0) && ((double)$withdraw_amount <= (double)$totalPoints) && ((double)$withdraw_amount > 0.0)) {
              
            
          $newTotalPoints = (double)$totalPoints - (double)$withdraw_amount;
          $newTotalPoints = number_format((double)$newTotalPoints, 2, '.', '');
          update_user_meta( $user_id, 'totalPoints', $newTotalPoints );
          $current_user = get_user_by( 'id', $user_id );
          $username = $current_user->user_login;
          
            global $wpdb; 
            $table_name = "pending_withdrawals";
        
            $wpdb->insert($table_name, array(
                'user_id' => $user_id,
                'withdraw_amount' => number_format((double)$withdraw_amount, 2, '.', ''),
                'withdraw_status' => "unpaid"
            ),
            array(
                '%s',
                '%s',
                '%s'
            ) //replaced %d with %s - I guess that your description field will hold strings not decimals
            );
          
          /*
                $to      = 'aidenck2006@gmail.com';
                $subject = 'Withdraw Request From GetBuxNow.com';
                $message =  'Amount: ' . $withdraw_amount . ' Username: ' . $username ;
                $headers = 'From: donotreply@getbuxnow.com'       . "\r\n" .
                             'X-Mailer: PHP/' . phpversion();
            
                mail($to, $subject, $message, $headers);
            */
          
          
          
          
          
          echo "100"; //amount withdrawn successfully
          
          }

        
    }
      
      }