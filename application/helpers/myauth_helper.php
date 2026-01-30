<?php 

function isLogin() {
    $ci = get_instance();
    if($ci->session->userdata(MY_SESSION_LOGGED) == false) { redirect(base_url('login')); }
}

function isLogut() {
    $ci = get_instance();
    if($ci->session->userdata(MY_SESSION_LOGGED)) { redirect(base_url()); }
}



?>