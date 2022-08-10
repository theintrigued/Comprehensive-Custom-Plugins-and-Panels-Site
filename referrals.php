<?php
    require_once('wp-load.php'); // add wordpress functionality

        

    add_filter( 'the_content', 'makeReferralsLink', 20 );
   
function makeReferralsLink($content){
    

        $userId = get_current_user_id();
        $referralCount = 0;
        
        global $wp_query;
        $post_id = $wp_query->post->ID;
        $currentPageId = $post_id;
        
        if ($currentPageId == 622 ) {
            $homeurl = get_home_url();
            
            
            if ($userId != 0) {
            global $wpdb;
            $table_name = "user_referrals";
            $retrieve_data = $wpdb->get_results( "SELECT COUNT(*) AS referralcount FROM $table_name WHERE user_id = $userId"  );// this will get the data from your table
            $referral_found = false;
            
            if(!$retrieve_data) {
                echo "array empty";
            }
            else {
                $referral_found = true;
                    foreach($retrieve_data as $data) {
                        $referralCount = $data->referralcount;
                    }
            
                }
            }
            
            
            
                        return $content .<<<HTML
                        
                        <div>
                        <p class="referralCount" style="margin-top:-7px; align-content: center;align-self: center;text-align: center; color:#73fb73;" > <p>
                        
                        </div>
                        
                        <div>
                        <p class="referralURLValue" style="margin-top:-18px; align-content: center;align-self: center;text-align: center; color:#73fb73;" > <p>
                        
                        </div>

                        
                        
                        
                         <script>
     
                         $( document ).ready(function(){
                      
                            var urlWithVar = '$homeurl/referralsBackend.php/?get_referral_link=true';
                            
                            
                            $.post(urlWithVar).done(function(res) {
                                    if (res == "<p style='display:none;'></p>"){
                                        $('.referralURLValue').text('Please Login');
                                    }
                                     else {
                                          $('.referralURLValue').text(res);
                                          var textToAdd = 'Referrals Count:  $referralCount';
                                          $('.referralCount').text(textToAdd);
                                     }
                                       
                                      
                                    }).fail(function() {
                            alert('Some Error Has Occured');
                        });
                                      
                            
                             
                    
                         });


                            
                            
                         
                     </script>
                       
                      
                      
                      
HTML;
            
            
            
        }
        
        else {
            return $content;
        }
        
    
}