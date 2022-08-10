<?php

/*
Plugin Name: Gift Code Admin Panel
Description: Gift Code Admin Panel
Version: 1.0
Author: Ali
Author URI: https://google.com
*/

add_action( 'admin_menu', 'sports_bench_team_admin_menu' );

function sports_bench_team_admin_menu() {
 global $team_page;
 add_menu_page( __( 'Gift Codes', 'sports-bench' ), __( 'Gift Codes', 'sports-bench' ), 'edit_posts', 'gift_codes', 'gift_codes_form_handler', 'dashicons-hammer', 6 ) ;
}


function gift_codes_form_handler() {
    
    $user = wp_get_current_user();
    
    $allowed_roles = array( 'editor','administrator' );
    if ( array_intersect( $allowed_roles, $user->roles ) ) {

            
            global $wpdb;
            $table_name = "gift_codes";
            $retrieve_data = $wpdb->get_results( "SELECT *,gift_code_record_id as record_id ,gift_code_id as giftCodes, gift_code_validity as validity FROM $table_name WHERE gift_code_validity = 'true'"  );// this will get the data from your table
            $referral_found = false;
            
            $table_name_withdrawalStatus = "pending_withdrawals";
            $retrieve_data_withdrawalStatus = $wpdb->get_results( "SELECT *,withdraw_id as withDrawID, user_id as userId , withdraw_amount	as withdrawAmount	, withdraw_status as withdrawStatus FROM $table_name_withdrawalStatus WHERE withdraw_status = 'unpaid' "  );// this will get the data from your table
           
            
            //Add new Gift Code

            

                $referral_found = true;
                        ?>
                        
                        <style>
                            table, th, td {
                              border:1px dashed black;
                              
                            }
                            td {
                              padding:5px 15px 5px 15px;
                              text-align: center;
                            }
                            table{
                                
                            }
                        </style>

                        <div style=" margin-top: 50px;  width: 90%; padding-right:50px">
                        <div style="height: 250px; width: fit-content;  overflow: auto; margin-right:30px; float:left">
                        <table>
                            <tr><td>Gift Code Record</td><td>Gift Code Value </td><td>Validity</td></tr>
                            
                        
                        <?php
                    foreach($retrieve_data as $data) {
                        ?>

                        <tr>
                        <td>
                        <?php
                        echo $data->record_id;
                        ?>
                        </td>
                        <td>
                        <?php
                        echo $data->giftCodes;
                        ?>
                        </td>
                        <td>
                        <?php
                        echo $data->validity;
                        ?>
                        </td>
                        </tr>
                        <?php

                    }
                        ?>
                       
                        </table>
                        </div>
                        
                        <div style="height: 250px; width: fit-content; overflow: auto;float:left">
                        <table>
                            <tr><td>WithDraw ID/Username</td><td>Withdrawal Amount </td><td>Withdrawal Status</td></tr>
                            
                        
                        <?php
                    foreach($retrieve_data_withdrawalStatus as $data) {
                        ?>

                        <tr>
                        <td>
                        <?php
                        $username = get_user_by( 'id', $data->userId ); 
                        $username = $username->user_login;
                        echo $data->withDrawID . "/" .$username ;
                        ?>
                        </td>
                        <td>
                        <?php
                        echo $data->withdrawAmount;
                        ?>
                        </td>
                        <td>
                        <?php
                        echo $data->withdrawStatus;
                        ?>
                        </td>
                        </tr>
                        <?php

                    }
                        ?>
                       
                        </table>
                        </div>
                        
                        
                        </div>
                        <?php
            
                
                
            $homeurl = get_home_url();

            echo <<<HTML
                        
                        <div style="float:left; border:1px dashed black; padding:  10px; margin-top:30px ">
                        <div style=' width: 90%; display:inline-block; '> Add A new Gift Code </div>
                        <form>
                        <div style="margin-top:20px;">
                        <input type="text" pattern="^[a-zA-Z0-9]+{16}$" id="giftcodeInput101" name="giftcode" style="width:300px">
                        </div>
                        <div style="margin-top:20px;">
                        <button class="addButton12" type="button">Add Gift Code</button>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="giftCodeAdded" style="display:none; color:#00ff23;">Success! Gift Code Added!</label>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="invalidCodeAlert" style="display:none; color:red;">There was an issue adding the Gift Code!</label>
                        </div>
                        </form>
                        </div>
                        
                        <div style=" float:left; margin-left:20px ; border:1px dashed black ; padding:  10px; margin-top:30px">
                        <div style=' width: 90%; display:inline-block'> Payout Pending Withdrawal </div>
                        <form>
                        
                        <div style="margin-top:20px;">
                        <label>Withdraw ID</label>
                        <input type="number" id="withdrawIdInput101" name="giftcode" style="width:100px">
                        </div>
                        <div style="margin-top:20px;">
                        <button class="payoutButton12" type="button">Payout</button>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="payoutSent" style="display:none; color:#00ff23;">Success! Gift Code Sent!</label>
                        </div>
                        <div style="margin-top:20px;">
                        <label class="invalidArgument" style="display:none; color:red;">There was an issue! Maybe no Gift Codes Available!</label>
                        </div>
                        </form>
                        </div>
            
            
            
            
            
                        <script>
     
                         jQuery(".addButton12").on("click", function(){
                            
                            var gift_code = jQuery('#giftcodeInput101').val();
                
                            var UrlWithVar = '$homeurl/addNewGiftCodeBackend.php/?gift-code=' + gift_code;
                            

                            jQuery.post(UrlWithVar).done(function(res) {
                                    
                                    if(res == "100"){
                                   
                                        jQuery('.giftCodeAdded').css('display', 'block');
                                        setTimeout(function() { 
                                                jQuery('.giftCodeAdded').css('display', 'none');
                                            }, 2000);
                                            
                                        setTimeout(function() { 
                                                document.location.reload(true);
                                            }, 1500);
                                        
                                      
                                    }
                                    else if(res == "101"){
                                     jQuery('.invalidCodeAlert').css('display', 'block');
                                setTimeout(function() { 
                                        jQuery('.invalidCodeAlert').css('display', 'none');
                                    }, 2000);
                                    }
                                    
                                    }).fail(function() {
                            alert('Some Error Has Occured');
                        });
                                      
                            
                             
                    
                         })
                         
                         
                         
                         jQuery(".payoutButton12").on("click", function(){
                            
                            var withdraw_id = jQuery('#withdrawIdInput101').val();
                
                            var UrlWithVar = '$homeurl/payoutGiftCodesBackend.php/?withdraw-id=' + withdraw_id;
                            

                            jQuery.post(UrlWithVar).done(function(res) {
                            
                                    if(res == "100"){
                                   
                                        jQuery('.payoutSent').css('display', 'block');
                                        setTimeout(function() { 
                                                jQuery('.payoutSent').css('display', 'none');
                                            }, 2000);
                                            
                                        setTimeout(function() { 
                                                document.location.reload(true);
                                            }, 1500);
                                        
                                      
                                    }
                                    else if(res == "101"){
                                     jQuery('.invalidArgument').css('display', 'block');
                                setTimeout(function() { 
                                        jQuery('.invalidArgument').css('display', 'none');
                                    }, 2000);
                                    }
                                    
                                    }).fail(function() {
                            alert('Some Error Has Occured');
                        });
                                      
                            
                             
                    
                         })


                            
                            
                         
                     </script>
HTML;
            
        

    }
    
    else {
        echo "<p style='margin:50px'> You do not have the permission to view this page! </p>";
    }
    
    
    
    
}

