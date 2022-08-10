<?php
    require_once('wp-load.php'); // add wordpress functionality

    add_filter( 'the_content', 'loadRewards' , 20 );

    function loadRewards($content) {
        $user_id = get_current_user_id();
        
        
        if($user_id != 0) {
          $homeurl = get_home_url();
            return $content . <<<HTML
            <script>
            $("[data-classes = discord-button]").on("click", function(){
              $.post("$homeurl/rewardBackend.php/?discord=true"
                  ).done(function() {
                           
                        })});

                $("[data-classes = youtube-button]").on("click", function(){
                  $.post("$homeurl/rewardBackend.php/?youtube=true"
                      ).done(function() {
                            
                        })});
                      
                $(".tiktok-button").on("click", function(){
                  $.post("$homeurl/rewardBackend.php/?tiktok=true"
                      ).done(function() {
                           
                        })});
                      
                $(".instagram-button").on("click", function(){
                  $.post("$homeurl/rewardBackend.php/?instagram=true"
                      ).done(function() {
                           
                        })});
                      
                $(".twitter-button").on("click", function(){
                  $.post("$homeurl/rewardBackend.php/?twitter=true"
                      ).done(function() {
                            
                        })});
                      
                    $(".youtube-button").on("click", function(){
                  $.post("$homeurl/rewardBackend.php/?youtube=true"
                      ).done(function() {
                            
                        })});
                      
                      
                $(".discord-button").on("click", function(){
                  $.post("$homeurl/rewardBackend.php/?discord=true"
                      ).done(function() {
                            
                        })});

            </script>
HTML;
    }
    return $content ;

    }



    function discordReward($user_id){
      $discordreward = get_user_meta( $user_id, 'discordreward' , true );
      if($discordreward == "false") {

        $totalPoints = get_user_meta( $user_id, 'totalPoints' , true ); 
        $newTotalPoints = (int)$totalPoints + 1;
        update_user_meta( $user_id, 'totalPoints', $newTotalPoints );
        update_user_meta( $user_id, 'discordreward', "true" );

      }

      return "Not Added to Discord";
    }
    