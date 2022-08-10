<?php
    require_once('wp-load.php'); // add wordpress functionality

   if (isset($_GET['gift-code'])  ){
        

                
                $num = $_GET['gift-code'];
                $numlength = strlen((string)$num);
                
                if(($numlength != 0) && !($numlength < 16) && !($numlength > 16) ) {
                    
                    $gift_code_value =  $_GET['gift-code'];
                    global $wpdb; 
                    $table_name = "gift_codes";
                
                    $result = $wpdb->insert($table_name, array(
                        'gift_code_id' => $gift_code_value,
                        'gift_code_validity' => "true"
                    ),
                    array(
                        '%s',
                        '%s'
                    ) //replaced %d with %s - I guess that your description field will hold strings not decimals
                    );
                    
                    if($result){
                    echo "100";
                    exit();
                    }
                    
                echo '101';
                exit();
                }
                
           
           
            echo '101';
            exit();
       

   }