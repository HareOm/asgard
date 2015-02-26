<?php

function createMadMimiUser( $user_id ){
  $user = get_user_by('id',$user_id);
  $user_email = urlencode(stripslashes($user->user_email));
  $madmimi_username = "mcoppola@valhallamovement.com";
  $madmimi_apikey = "702898adbc6da47a7f7e26b5e355be1b";
  $madmimi_listID = "1298887";
  $url = "http://api.madmimi.com/audience_lists/$madmimi_listID/add?email=$user_email&username=$madmimi_username&api_key=$madmimi_apikey";
  $result = wp_remote_post( $url );
}

add_action('user_register', 'createMadMimiUser');
