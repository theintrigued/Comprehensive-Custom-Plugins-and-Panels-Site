<?php
    require_once('wp-load.php'); // add wordpress functionality



    add_filter( 'the_content', 'makePromocodesForm', 20 );
   

    function makePromocodesForm($content){
        $userId = get_current_user_id();
        
        global $wp_query;
        $post_id = $wp_query->post->ID;
        $currentPageId = $post_id;
        
        if ($currentPageId == 611 && (get_current_user_id() != 0 ) ) {
            $homeurl = get_home_url();
            return $content .<<<HTML
                        
                        
                        <div>
                        
                        <form>
                        <div>
                        <label for="" >Enter Promocode:</label>
                        </div>
                        <div style="margin-top:20px;">
                        <input type="text" id="promocodeInput101" name="promocodeValue" style="width:50%">
                        </div>
                        <div style="margin-top:20px;">
                        <button class="promocodeButton12" type="button">Submit</button>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="messageSentAlert" style="display:none; color:#00ff23;">Thank you for staying alert for promocodes! Here is your reward!</label>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="invalidCodeAlert" style="display:none; color:#00ff23;">Invalid Promocode!</label>
                        </div>
                        </form>
                        </div>
                        
                        
                        
                         <script>
     
                         $(".promocodeButton12").on("click", function(){
                      
                            var promocode = $('#promocodeInput101').val();
                
                            
                            var urlWithVar = '$homeurl/promocodesBackend.php/?promocode_value=' + promocode;
                            
                            
                            $.post(urlWithVar).done(function(res) {
                                    if(res == "100"){
                                      
                                        $('.messageSentAlert').css('display', 'block');
                                        setTimeout(function() { 
                                                $('.messageSentAlert').css('display', 'none');
                                            }, 3000);
                                      
                                    }
                                    else if(res == "101"){
                                     $('.invalidCodeAlert').css('display', 'block');
                                setTimeout(function() { 
                                        $('.invalidCodeAlert').css('display', 'none');
                                    }, 3000);
                                    }
                                    
                                    }).fail(function() {
                            alert('Some Error Has Occured');
                        });
                                      
                            
                             
                    
                         })


                            
                            
                         
                     </script>
                       
                      
                      
                      
HTML;
        }
        
        return $content;
        
        
        
    }