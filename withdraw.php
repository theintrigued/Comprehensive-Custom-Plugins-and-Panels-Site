<?php
    require_once('wp-load.php'); // add wordpress functionality



    add_filter( 'the_content', 'makeWithdrawForm', 20 );
   

    function makeWithdrawForm($content){
        $userId = get_current_user_id();
        
        global $wp_query;
        $post_id = $wp_query->post->ID;
        $currentPageId = $post_id;
        
        if ($currentPageId == 571 && (get_current_user_id() != 0 ) ) {
            $homeurl = get_home_url();
            return $content .<<<HTML
                        
                        
                        <div>
                        <p> Minimum Withdraw Amount: 400R$ </p>
                        <form>
                        <div>
                        <label for="fname" >Amount:</label>
                        </div>
                        <div style="margin-top:20px;">
                        <input type="number" id="withdrawInput101" name="withdrawAmount" style="width:50%">
                        </div>
                        <div style="margin-top:20px;">
                        <button class="withDrawButton12" type="button">Submit</button>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="messageSentAlert" style="display:none; color:#00ff23;">Request Has Been Recieved! Your Robux Will Be Delivered Shortly</label>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="lessAmountAlert" style="display:none; color:#00ff23;">The Minimum Withdraw Amount Should Be A Multiple of 400 R$</label>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="invalidAmountAlert" style="display:none; color:#00ff23;">Invalid Amount</label>
                        </div>
                        </form>
                        </div>
                        
                        
                        
                         <script>
     
                         $(".withDrawButton12").on("click", function(){
                      
                            var amount = $('#withdrawInput101').val();
                            
                            if((amount % 400) != 0) {
                                
                                $('.lessAmountAlert').css('display', 'block');
                                setTimeout(function() { 
                                        $('.lessAmountAlert').css('display', 'none');
                                    }, 3000);
                            }

                            if((amount % 400) == 0) {
                
                            
                            var urlWithVar = '$homeurl/withdrawBackend.php/?withdraw_amount=' + amount;
                            
                            
                            $.post(urlWithVar).done(function(res) {
                                    if(res == "100"){
                                      
                                        $('.messageSentAlert').css('display', 'block');
                                        setTimeout(function() { 
                                                $('.messageSentAlert').css('display', 'none');
                                            }, 3000);
                                      
                                    }
                                    else if(res == "101"){
                                     $('.invalidAmountAlert').css('display', 'block');
                                setTimeout(function() { 
                                        $('.invalidAmountAlert').css('display', 'none');
                                    }, 3000);
                                    }
                                    
                                    }).fail(function() {
                            alert('Some Error Has Occured');
                        });
                                      
                            };
                             
                    
                         })


                            
                            
                         
                     </script>
                       
                      
                      
                      
HTML;
        }
        
        return $content;
        
        
        
    }