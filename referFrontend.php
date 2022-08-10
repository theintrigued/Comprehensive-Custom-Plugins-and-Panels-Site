<?php
    require_once('wp-load.php'); // add wordpress functionality


    add_filter( 'the_content', 'makeReferralLoginPage', 20 );
   
   function makeReferralLoginPage($content){
       
        $userId = get_current_user_id();
        
        global $wp_query;
        $post_id = $wp_query->post->ID;
        $currentPageId = $post_id;
        

        
        if ($currentPageId == 630 && (get_current_user_id() == 0 ) ) {
            
        $refer_username = false;   
        if (isset($_GET['refer']) ) {
            $refer_username = $_GET['refer']; 
        }
        
            $homeurl = get_home_url();
            if($refer_username != false) {
                
            
            
            return $content .<<<HTML
                        
                        
                        <div>
                        
                        <form>
                        <div>
                        <label for="" >Enter Username:</label>
                        </div>
                        <div style="margin-top:20px;">
                        <input type="text" id="loginInput101" name="username" style="width:50%">
                        </div>
                        <div style="margin-top:20px;">
                        <button class="loginButton12" type="button">Login</button>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="messageSentAlert" style="display:none; color:#00ff23;">Thank you for registering! Adding you to their referral list!</label>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="referralAdded" style="display:none; color:#00ff23;">Success!</label>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="referralNotAddedButRegistered" style="display:none; color:#00ff23;">No user found with that referral link, but you have registered!</label>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="invalidCodeAlert" style="display:none; color:#00ff23;">Invalid Username!</label>
                        </div>
                        </form>
                        </div>
                        
                        
                        
                         <script>
     
                         $(".loginButton12").on("click", function(){
                      
                            var user_login = $('#loginInput101').val();
                
                            var loginUrlWithVar = '$homeurl/login.php/?user_login=' + user_login;
                            
                            var referralUrlWithVar = '$homeurl/refer.php/?refer=' + '$refer_username' + '&username=' + user_login;
                            
                            
                            $.post(loginUrlWithVar).done(function(res) {
                                    if(res == "100"){
                                    
                                    $.post(referralUrlWithVar).done(function(res2) {
                                    
                                    if(res2 == "100") {
                                        $('.referralAdded').css('display', 'block');
                                        setTimeout(function() { 
                                                $('.referralAdded').css('display', 'none');
                                                    setTimeout(function() { 
                                                        location.reload();
                                                    }, 1000);
                                            }, 1000);
                                    }
                                    else if(res2 == "101") {
                                    $('.referralNotAddedButRegistered').css('display', 'block');
                                        setTimeout(function() { 
                                                $('.referralNotAddedButRegistered').css('display', 'none');
                                                    setTimeout(function() { 
                                                        location.reload();
                                                    }, 1000);
                                            }, 1000);
                                    }
                                    
                                        
                                    });
                                    
                                      
                                        $('.messageSentAlert').css('display', 'block');
                                        setTimeout(function() { 
                                                $('.messageSentAlert').css('display', 'none');
                                            }, 1000);
                                      
                                    }
                                    else if(res == "101"){
                                     $('.invalidCodeAlert').css('display', 'block');
                                setTimeout(function() { 
                                        $('.invalidCodeAlert').css('display', 'none');
                                    }, 1000);
                                    }
                                    
                                    }).fail(function() {
                            alert('Some Error Has Occured');
                        });
                                      
                            
                             
                    
                         })


                            
                            
                         
                     </script>
                       
                      
                      
                      
HTML;
            }
            
            return $content . "Please use the referral URL to register using this page.";
            
        }
        
        if (($currentPageId == 630) && (get_current_user_id() != 0) ){
            return $content . "You are already logged in!";
        }
        
        return $content;
       
   }