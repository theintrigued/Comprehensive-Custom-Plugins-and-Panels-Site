<?php
    require_once('wp-load.php'); //

//Add Promocode
function addPromocode() {
    
    $users = get_users( array( 'fields' => array( 'ID' ) ) );
    foreach($users as $user){
        
        $promocodeVal = "YOUTUBE2022";
        
        if ( !(metadata_exists( 'user', $user->id, $promocodeVal )) ) {
            add_user_meta( $user->id, $promocodeVal, 'false');

        }
    }

}

    
//Remove Promocodes
function removePromocode() {
    
    $users = get_users( array( 'fields' => array( 'ID' ) ) );
    foreach($users as $user){
        
        $promocodeVal2 = "YOUTUBE2022";
        
        if ( metadata_exists( 'user', $user->id, $promocodeVal2 ) ) {
                
                delete_metadata(
                'user',        // the meta type
                0,             // this doesn't actually matter in this call
                $promocodeVal2,     // the meta key to be removed everywhere
                '',            // this also doesn't actually matter in this call
                true           // tells the function "yes, please remove them all"
            );
           
        
        }

    
    }
}

//removePromocode();
addPromocode();
