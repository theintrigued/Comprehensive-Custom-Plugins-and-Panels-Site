<?php

/*
Plugin Name: Make The OfferWall
Description: Make The OfferWall
Version: 1.0
Author: Ali
Author URI: https://google.com
*/




    add_filter( 'the_content', 'makeWall', 20 );
   

    function makeWall($content){
        $userId = get_current_user_id();
        
        global $wp_query;
        $post_id = $wp_query->post->ID;
        $currentPageId = $post_id;
        
     
        if ($currentPageId == 541 && (get_current_user_id() == 0 ) ) {
            return $content .<<<HTML
                        <p>Please Log In To Start Earning </p>
                      <button type="button" style="height:34px;width:100px;margin-right:5px;" onclick="document.getElementById('id01').style.display='flex'"> Login </button>
HTML;
        }
        else if ($currentPageId != 541) {
            return $content ;
        }

        
       
        if($currentPageId == 541) {
            //echo "<script> alert('$currentPageId'); </script>";
            $user_id = get_current_user_id();

            $user_points = get_user_meta( $user_id, 'totalPoints', true );

            
           return $content  .<<<HTML
            <script>
                $('#page-wrapper').load(function() {
                    $('#page-wrapper').css('backgroundColor', '#131516');
                    });
            </script> 
           
           <p> Available points: $user_points </p>
           <div id='theiframe'> <iframe onclick=doSomething()   width ='100%' height = '1500px' src='https://wall.adgaterewards.com/oKuZqA/$user_id'></iframe>
            </div>
HTML; 
        }
        }
        



