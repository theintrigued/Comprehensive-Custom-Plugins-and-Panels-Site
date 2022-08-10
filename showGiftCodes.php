<?php
    require_once('wp-load.php'); // add wordpress functionality



    add_filter( 'the_content', 'showGiftCodes', 20 );
   

    function showGiftCodes($content){
        $userId = get_current_user_id();
        
        if($userId != 0) {
            
            
        global $wpdb;
                $table_name = "paid_gift_codes";
                $retrieve_data = $wpdb->get_results( "SELECT *, user_id as userID, gift_code as giftCode FROM $table_name WHERE user_id = $userId"  );
                $giftCodeArray = array();
                                
                foreach($retrieve_data as $data) {
                    if($userId ==  $data->userID) {
                        $giftCodeArray[]  = $data->giftCode;
                    }
                        
                
                }
                
                
                
                
                global $wp_query;
                $post_id = $wp_query->post->ID;
                $currentPageId = $post_id;
                
                if ($currentPageId == 571 && (get_current_user_id() != 0 ) ) {
                    $homeurl = get_home_url();
                    
                
                    
                    return $content .<<<HTML
                    <div style='margin-top: 50px;'> <h2>Withdrawn Gift Codes</h2> </div>
                    <div class='giftCodes101' style="height: 250px; width: fit-content;  overflow: auto; padding:0px 30px 0px 30px" ></div>
                    
                    <script>
                    
                                    var urlWithVar = '$homeurl/showGiftCodesBackend.php/?show-code=true';
                                    
                                        $( document ).ready(function() {
                                        
                                                
                                                $.post(urlWithVar).done(function(res) {
                                                       
                                                          
                                                            
                                                        $('.giftCodes101').prepend(res);
                                                          
                                                        
                    
                                                        
                                                        }).fail(function() {
                                                alert('Some Error Has Occured');
                                            });
                                            
                                            
                                        });
                                    
        
                                
                                
                    </script>
                    
                    
                    
HTML;
                    
                    
                }   
            
            
            
            
            
            
        }
        
        return $content;
        
        
        
    }
    
    function printShit(&$giftCodeArray){

        foreach($giftCodeArray as $codes){
            echo "<p>" . $codes . "</p>";
        }
    }
    