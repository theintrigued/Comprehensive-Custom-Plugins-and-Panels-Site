<?php
/*
Plugin Name: Show User Data From Database
Description: To get userdata from database
Version: 1.0
Author: Ali
Author URI: https://google.com
*/    

add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );
function your_custom_menu_item ( $items, $args ) {


    
    
    

    $user_id = get_current_user_id();
        
        if($user_id != 0) {
            if(metadata_exists( 'user', $user_id, 'robloxAvatarURL' )) {
                $totalPoints = get_user_meta( $user_id, 'totalPoints' , true ); 
                $homeurl = get_home_url();
                $imageUrl = get_user_meta( $user_id, 'robloxAvatarURL' , true ); 
                $items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom"><img id="image101" style="display:flex; padding-top:23%;border-radius:100px;" src="'.$imageUrl.'" width="50" height="50"></li>'.<<<HTML
                    <style>
                    @media screen and (max-width: 500px) {
                         #image101 {
                            padding-top:5% !important;
                            margin-left: 28px;
                                }
                        #userPoints101{
                                margin-left: 35px;
                                font-size: 18px;
                        }
                            }
                    </style>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom">
                    <p id="userPoints101" style="margin-top:26px;">$totalPoints R$</p>
                        </li>
                    
                    <li class="menu-item menu-item-type-custom menu-item-object-custom">
                    <a id="logoutbutton101" style="text-align:center;background-color:#bc1414;height:auto;margin-top:24px;" onMouseOver="this.style.backgroundColor='#590a0a'" onMouseOut="this.style.backgroundColor='#bc1414'" class="logout-button-12 fusion-button button-flat button-small" target="_self" href="#"><span class="fusion-button-text">Logout</span></a>

                        </li>
                    
                    <script>
                    
                    $(document).on("click tap touchstart", "#logoutbutton101", function(){
                        console.log("CLICK");
                        $.post("$homeurl/logout.php/?logout=true").done(function() {
                            location.reload();
                        })
                        });
                   
                    
                        
                  </script>
                
HTML;
                
                }
        }

    
    return $items;
}

  