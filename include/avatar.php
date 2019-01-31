<?php


//评论头像缓存
function deel_avatar($avatar) {
    $tmp = strpos($avatar, 'http');
    $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
    $tmp = strpos($g, 'avatar/') + 7;
    $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
    $w = site_url();
    $e = ABSPATH . 'avatar/' . $f . '.png';
    $t = 30 * 24 * 60 * 60;
    if (!is_file($e) || (time() - filemtime($e)) > $t) copy(htmlspecialchars_decode($g) , $e);
    else $avatar = strtr($avatar, array(
        $g => $w . '/avatar/' . $f . '.png'
    ));
    if (filesize($e) < 500) copy(GIT_URL . '/assets/img/default.png', $e);
    return $avatar;
}
if (git_get_option('git_avater') == 'git_avatar_b') {
    add_filter('get_avatar', 'deel_avatar');
}
//头像镜像
function git_avatar_cache($avatar) {
    $avatar = str_replace(array(
        "www.gravatar.com",
        "0.gravatar.com",
        "1.gravatar.com",
        "2.gravatar.com"
    ) , git_get_option('git_avatar_qnurl') , $avatar);
    return $avatar;
}
if (git_get_option('git_avater') == 'git_avatar_qn') {
    add_filter('get_avatar', 'git_avatar_cache', 10, 3);
}

//随机头像
function local_random_avatar($avatar) {
    //weibo图片数组
    $random_avatar_arr = array('1mknpj301s01sq2p','1muzjj301s01sa9u','1nu4uj301s01s742','1vr2tj301s01s3ya','1ynnvj301s01s742','21h0xj301s01st8h','25715j301s01swe9','1ztzkj301s01s3ya','28gq6j301s01sdfm','2bnlaj301s01swe9','2gfu8j301s01s0si','2ji9yj301s01sjr6','2nm3ej301s01s3ya','2pxloj301s01sa9u','2t4ooj301s01s3ya','2wx4gj301s01sjr5','2eb8ij301s01sq2q','358evj301s01s742','37tkaj301s01st8h','3c0jsj301s01st8h','3egr8j301s01sdfm','3hnkaj301s01sjr5','3jtrmj301s01sgle','3oqcij301s01swe9','3rbkaj301s01sq2p','37si0j301s01smwx','3wryvj301s01sq2q','3wxndj301s01sdfm','46z1aj301s01sjr6','474jwj301s01sgld','4933uj301s01sa9t','4elr0j301s01s0si','4hemtj301s01s3ya','4hp1jj301s01swe9','4l437j301s01st8h','4p7guj301s01st8i','4ssbvj301s01sdfm','4xt1nj301s01s742','4zt3ij301s01sdfm','54yemj301s01s743','5aue3j301s01s742','5fqmsj301s01s0si','5irw7j301s01s0si','5pwg6j301s01sjr6','4orlpj301s01sq2p','60tpnj301s01smwy','63xd5j301s01st8h','67mwfj301s01sgle','5mpmhj301s01swe9','6brl7j301s01sa9u','6enj2j301s01sjr6','6fcy3j301s01st8h','6ighbj301s01sq2q','6l0ckj301s01sq2p','6o857j301s01st8i','6r1gej301s01st8h','6vf84j301s01sgld','6xv53j301s01sa9u','712o4j301s01s3ya','73fh4j301s01s3ya','6nd20j301s01sdfm','77f9vj301s01sq2p','7dffqj301s01sgld','7e6ytj301s01s3ya','7mmy6j301s01sa9u','7tffsj301s01s0si','78mwgj301s01swea','80qg1j301s01smwy','83d77j301s01sjr6','86p3wj301s01s0si','8ctn7j301s01sgle','8iwdlj301s01smwx','8prg4j301s01sa9u','7kvtcj301s01sgle','8velij301s01sgle','89dobj301s01swea','909gfj301s01sq2p','92fmmj301s01sq2p','933ykj301s01sjr6','9654fj301s01swe9','98z1rj301s01s3ya','9ce7ej301s01sgle','9d5frj301s01st8i','9fogej301s01swea','9j6f3j301s01sgle','9ji1qj301s01s742','9m619j301s01sa9u','9qtxnj301s01sgle','9tn7mj301s01sgle','9w2o6j301s01swe9');
        $random_avatar = array_rand($random_avatar_arr,1);
        $sinasrc = $random_avatar_arr[$random_avatar] ;
    if(git_get_option('git_avatar_qnurl')){
        $avatarsrc = '//' . git_get_option('git_avatar_qnurl') . '/myavatar/' . mt_rand(1, git_get_option('git_avatar_randnum')) . '.jpg';
    }else{
        $avatarsrc = '//wx2.sinaimg.cn/large/005zWjpngy1frvlt' . $sinasrc . '.jpg';
    }
    $avatar = "<img src=$avatarsrc class='avatar rand_avatar photo' />";
    return $avatar;
}
if (git_get_option('git_avater') == 'git_avatar_rand') {
    add_filter('get_avatar', 'local_random_avatar', 1, 5);
}

//本地头像
class simple_local_avatars {
    private $user_id_being_edited;
    public function __construct() {
        add_action('admin_init', array(
            $this,
            'admin_init'
        ));
        add_action('show_user_profile', array(
            $this,
            'edit_user_profile'
        ));
        add_action('edit_user_profile', array(
            $this,
            'edit_user_profile'
        ));
        add_action('personal_options_update', array(
            $this,
            'edit_user_profile_update'
        ));
        add_action('edit_user_profile_update', array(
            $this,
            'edit_user_profile_update'
        ));
        add_filter('get_avatar', array(
            $this,
            'get_avatar'
        ) , 10, 5);
        add_filter('avatar_defaults', array(
            $this,
            'avatar_defaults'
        ));
    }
    public function admin_init() {
        register_setting('discussion', 'simple_local_avatars_caps', array(
            $this,
            'sanitize_options'
        ));
        add_settings_field('basic-user-avatars-caps', '本地上传头像权限管理', array(
            $this,
            'avatar_settings_field'
        ) , 'discussion', 'avatars');
    }
    public function avatar_settings_field($args) {
        $options = get_option('simple_local_avatars_caps');
?>
		<label for="simple_local_avatars_caps">
			<input type="checkbox" name="simple_local_avatars_caps" id="simple_local_avatars_caps" value="1" <?php
        checked($options['simple_local_avatars_caps'], 1); ?>/>仅具有头像上传权限的用户具有设置本地头像权限（作者及更高等级角色）</label>
		<?php
    }
    public function sanitize_options($input) {
        $new_input['simple_local_avatars_caps'] = empty($input['simple_local_avatars_caps']) ? 0 : 1;
        return $new_input;
    }
    public function get_avatar($avatar, $id_or_email, $size = 96, $default, $alt) {
        if (is_numeric($id_or_email)) $user_id = (int)$id_or_email;
        elseif (is_string($id_or_email) && ($user = get_user_by('email', $id_or_email))) $user_id = $user->ID;
        elseif (is_object($id_or_email) && !empty($id_or_email->user_id)) $user_id = (int)$id_or_email->user_id;
        if (empty($user_id)) return $avatar;
        $local_avatars = get_user_meta($user_id, 'simple_local_avatar', true);
        if (empty($local_avatars) || empty($local_avatars['full'])) return $avatar;
        $size = (int)$size;
        if (empty($alt)) $alt = get_the_author_meta('display_name', $user_id);
        if (empty($local_avatars[$size])) {
            $upload_path = wp_upload_dir();
            $avatar_full_path = str_replace($upload_path['baseurl'], $upload_path['basedir'], $local_avatars['full']);
            $image = wp_get_image_editor($avatar_full_path);
            if (!is_wp_error($image)) {
                $image->resize($size, $size, true);
                $image_sized = $image->save();
            }
            $local_avatars[$size] = is_wp_error($image_sized) ? $local_avatars[$size] = $local_avatars['full'] : str_replace($upload_path['basedir'], $upload_path['baseurl'], $image_sized['path']);
            update_user_meta($user_id, 'simple_local_avatar', $local_avatars);
        } elseif (substr($local_avatars[$size], 0, 4) != 'http') {
            $local_avatars[$size] = home_url($local_avatars[$size]);
        }
        $author_class = is_author($user_id) ? ' current-author' : '';
        $avatar = "<img alt='" . esc_attr($alt) . "' src='" . $local_avatars[$size] . "' class='avatar avatar-{$size}{$author_class} photo' height='{$size}' width='{$size}' />";
        return apply_filters('simple_local_avatar', $avatar);
    }
    public function edit_user_profile($profileuser) {
?>
		<h3>头像</h3>
		<table class="form-table">
			<tr>
				<th><label for="basic-user-avatar">上传头像</label></th>
				<td style="width: 50px;" valign="top">
					<?php
        echo get_avatar($profileuser->ID); ?>
				</td>
				<td>
				<?php
        $options = get_option('simple_local_avatars_caps');
        if (empty($options['simple_local_avatars_caps']) || current_user_can('upload_files')) {
            // Nonce security ftw
            wp_nonce_field('simple_local_avatar_nonce', '_simple_local_avatar_nonce', false);
            echo '<input type="file" name="basic-user-avatar" id="basic-local-avatar" /><br />';
            if (empty($profileuser->simple_local_avatar)) {
                echo '<span class="description">尚未设置本地头像，请点击“浏览”按钮上传本地头像</span>';
            } else {
                echo '<input type="checkbox" name="basic-user-avatar-erase" value="1" />移除本地头像<br />';
                echo '<span class="description">如需要修改本地头像，请重新上传新头像。如需要移除本地头像，请选中上方的“移除本地头像”复选框并更新个人资料即可。<br/>移除本地头像后，将恢复使用 Gravatar 头像</span>';
            }
        } else {
            if (empty($profileuser->simple_local_avatar)) {
                echo '<span class="description">尚未设置本地头像，请在 Gravatar.com 网站设置头像</span>';
            } else {
                echo '<span class="description">你没有头像上传权限，如需要修改本地头像，请联系站点管理员</span>';
            }
        }
?>
				</td>
			</tr>
		</table>
		<script type="text/javascript">var form = document.getElementById('your-profile');form.encoding = 'multipart/form-data';form.setAttribute('enctype', 'multipart/form-data');</script>
		<?php
    }
    public function edit_user_profile_update($user_id) {
        if (!isset($_POST['_simple_local_avatar_nonce']) || !wp_verify_nonce($_POST['_simple_local_avatar_nonce'], 'simple_local_avatar_nonce')) return;
        if (!empty($_FILES['basic-user-avatar']['name'])) {
            $mimes = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'gif' => 'image/gif',
                'png' => 'image/png',
            );
            if (!function_exists('wp_handle_upload')) require_once ABSPATH . 'wp-admin/includes/file.php';
            $this->avatar_delete($user_id);
            if (strstr($_FILES['basic-user-avatar']['name'], '.php')) wp_die('基于安全考虑 ".php" 格式文件禁止上传');
            $this->user_id_being_edited = $user_id;
            $avatar = wp_handle_upload($_FILES['basic-user-avatar'], array(
                'mimes' => $mimes,
                'test_form' => false,
                'unique_filename_callback' => array(
                    $this,
                    'unique_filename_callback'
                )
            ));
            update_user_meta($user_id, 'simple_local_avatar', array(
                'full' => $avatar['url']
            ));
        } elseif (!empty($_POST['basic-user-avatar-erase'])) {
            $this->avatar_delete($user_id);
        }
    }
    public function avatar_defaults($avatar_defaults) {
        remove_action('get_avatar', array(
            $this,
            'get_avatar'
        ));
        return $avatar_defaults;
    }
    public function avatar_delete($user_id) {
        $old_avatars = get_user_meta($user_id, 'simple_local_avatar', true);
        $upload_path = wp_upload_dir();
        if (is_array($old_avatars)) {
            foreach ($old_avatars as $old_avatar) {
                $old_avatar_path = str_replace($upload_path['baseurl'], $upload_path['basedir'], $old_avatar);
                @unlink($old_avatar_path);
            }
        }
        delete_user_meta($user_id, 'simple_local_avatar');
    }
    public function unique_filename_callback($dir, $name, $ext) {
        $user = get_user_by('id', (int)$this->user_id_being_edited);
        $name = $base_name = sanitize_file_name($user->ID . '_avatar');
        $number = 1;
        while (file_exists($dir . "/$name$ext")) {
            $name = $base_name . '_' . $number;
            $number++;
        }
        return $name . $ext;
    }
}
$simple_local_avatars = new simple_local_avatars;
