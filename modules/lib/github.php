<?php

/*github登录文件*/
function github_oauth_redirect(){
    wp_redirect( home_url() );
    exit;
}
function github_oauth(){
    $code = $_GET['code'];
    $url = 'https://github.com/login/oauth/access_token';
    $data = array(
        'client_id' => git_get_option('git_github_oauth_appid'),
        'client_secret' => git_get_option('git_github_oauth_appkey'),
        'grant_type' => 'authorization_code',
        'redirect_uri' => home_url(),
        'code' => $code,
        'state' => $_GET['state']
    );
    $response = wp_remote_post( $url, array(
            'method' => 'POST',
            'headers' => array('Accept' => 'application/json'),
            'body' => $data,
        )
    );
    if(is_wp_error($response)) wp_die('网络错误，请重试！');
    $output = json_decode($response['body'],true);
    $token = $output['access_token'];
    if(!$token) wp_die('授权失败，请重试！');
    $get_user_info = 'https://api.github.com/user?access_token='.$token;
    $datas = wp_remote_get( $get_user_info );
    if(is_wp_error($datas)) wp_die('网络错误，请重试！');
    $str = json_decode($datas['body'] , true);
    $github_id = $str['id'];
    $email = $str['email'];
    $name = $str['name'];
    if(!$github_id) wp_die('无法获取用户信息');
    if( is_user_logged_in() ){
        update_user_meta( get_current_user_id() ,'github_id',$github_id);
        github_oauth_redirect();
    } else {
        $user_github = get_users(array(
                'meta_key '=>'github_id',
                'meta_value'=>$github_id
			)
        );
        if( is_wp_error($user_github) || !count($user_github) ){
            $username = $str['title'];
            $login_name = wp_create_nonce($github_id);
            $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
            $userdata = array(
                'user_login' => $login_name,
                'display_name' => $name,
                'user_email' => $email,
                'user_pass' => $random_password,
                'nickname' => $name
            );
            $user_id = wp_insert_user( $userdata );
            wp_signon(array(
                'user_login'=>$login_name,
                'user_password'=>$random_password
            ),false);
            update_user_meta($user_id ,'github_id',$github_id);
            github_oauth_redirect();
        }else{
            wp_set_auth_cookie($user_github[0]->ID);
            github_oauth_redirect();
        }
    }
}
function social_oauth_github(){
    if (isset($_GET['code']) && isset($_GET['type']) && $_GET['type'] == 'github'){
        github_oauth();
    }
}
add_action('init','social_oauth_github');
function github_oauth_url(){
    $url = 'https://github.com/login/oauth/authorize?client_id=' . git_get_option('git_github_oauth_appid') . '&scope=user&state=123&response_type=code&redirect_uri=' . urlencode (home_url('/?type=github') );
    return $url;
}
?>