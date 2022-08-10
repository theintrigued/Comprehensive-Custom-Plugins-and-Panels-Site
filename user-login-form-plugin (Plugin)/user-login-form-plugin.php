<?php

/*
Plugin Name: User Login Plugin Form
Description: A plugin to get an overview of all employees of a company
Version: 1.0
Author: Ali
Author URI: https://google.com
*/



add_filter( 'the_content', 'loadLoginForm' , 20 );


function loadLoginForm($content) {

  ?>
  <style>
  <?php include './userlogin.css'; ?>
  </style>
  
  <?php

    global $wp_query;
    $post_id = $wp_query->post->ID;
    $currentPageId = $post_id;
        
  $currentUserid = get_current_user_id();
  if(get_the_ID() != false) {
    $current_page_id = get_the_ID();
  }
  else {
    $current_page_id = -1;
  }

  //If user is not logged in, make login
  if (( $currentUserid == 0) && !($currentPageId == 630)  ) {
    $homeurl = get_home_url();
    return $content . <<<HTML
    <script>
      </script>
 
    <!-- Button to open the modal login form -->
    <!-- <button onclick="document.getElementById('id01').style.display='flex'">Login</button> -->
    
    <!-- The Modal -->
    <div id="id01" class="modal" style="display: flex; flex-wrap: nowrap;align-items: center;justify-content: space-evenly; background-color:rgba(0, 0, 0, 0.5);">    
      <!-- Modal Content -->
      <form id="form101" class="modal-content animate" action="/login.php" style = "background-color:#1b1d1e;padding-top: 22px; height:334px; width:406px; ">
      <div style="margin: 10px;text-align: center;">
      <img style="height:80px;" src="$homeurl/fire.png'">
          <div>
        <div style="margin: 10px;text-align: center;">
          <label for="user_login"><b> Enter Roblox Username (Not Nickname!)</b></label>
          <div>
            <input style="margin-top: 10px;width:350px;text-align: center; " type="text" placeholder="Enter Username" class="username101" name="user_login" required>
          </div>
          <div style="margin-top: 10px;" >
          <p style="font-size:12px;margin-bottom: 0px;">No Need for Password!</p>
            </div>
            <div style="margin-top:5px;" >
          <button class="login-button-12" type="button" style=" width:100px;">Login</button>
            </div>
           
            <div style="margin-top: 5px;" class="cancelButton-div">
          <button type="button" style="align:left; width:100px;" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        </div> 
        </div>
    

      </form>
    </div>
    <script>
     
     $(".login-button-12").on("click", function(evt){

        var uName = $('.username101').val();
        var urlWithVar = '$homeurl/login.php/?user_login=' + uName;
        var simpleFileUrl = '$homeurl/addPromocodesToDatabase.php/';
        $.post(urlWithVar)
        $.post(urlWithVar).done(function(res) {
                if(res == "100"){
                    setTimeout(function() {
                    location.reload();
                    }, 1000);
                  
                }
                if(res == "101"){
                  $('.cancelButton-div').append('<div class="invalidusername" style="color:red;">Invalid Username</div>'); 
                    setTimeout(function() {
                    location.reload();
                    }, 1500);
                }
                
                }).fail(function() {
        alert('Some Error Has Occured');
    });

         setTimeout(
        function() 
        {
          $( ".invalidusername" ).remove();
        }, 3000);
        
        });
    </script>
HTML;
      } //Make Login End

  else if(( $currentUserid == 0) &&($current_page_id == 434)) {
    return $content . <<<HTML
    <script>
      jQuery(document).ready(function($) {
      $(".userPoints").text("0 R$");
})    </script>
HTML;
    }
  
  else {
    return $content;
  }
}










 