<?php
/**
* class-points-wordpress.php
*/
class Points_Wordpress {

	/**
	 * Add shortcodes.
	 */
	public static function init() {

		if ( get_option('points-comments_enable', 1) ) {
			// comments
			add_action('wp_set_comment_status', array( __CLASS__, 'wp_set_comment_status' ), 10, 2);
			add_action('comment_post', array( __CLASS__, 'comment_post' ), 10, 2);
		}

		if ( get_option('points-welcome', '0') !== '0' ) {
			add_action( 'user_register', array( __CLASS__,'user_register' ) );
		}
	}

	public static function user_register ( $user_id ) {
		if ( !defined( 'POINTS_TYPE_USER_REGISTRATION' ) ) {
			require_once ( POINTS_CORE_LIB . '/constants.php' );
		}
		Points::set_points( get_option('points-welcome', 0), $user_id, array(
			'description' => 'register_'.$user_id.'' ,
			'status' 	  => get_option( 'points-points_status', POINTS_STATUS_ACCEPTED ),
			'type'        => POINTS_TYPE_USER_REGISTRATION
		) );
	}

	public static function wp_set_comment_status( $comment_id, $status ) {
		if ( !defined( 'POINTS_TYPE_NEW_COMMENT' ) ) {
			require_once ( POINTS_CORE_LIB . '/constants.php' );
		}
		$user = get_user_by( 'email', get_comment_author_email( $comment_id ) );
		if ( $user ) {
			if ( $status == "approve" ) {
				Points::set_points( get_option('points-comments', 1),
					$user->ID,
					array(
						'description' => 'comment_approved_'.$comment_id.'',
						'status'      => get_option( 'points-points_status', POINTS_STATUS_ACCEPTED ),
						'type'        => POINTS_TYPE_NEW_COMMENT
					)
				);
			}
		}
	}

	public static function comment_post( $comment_id, $status ) {
		if ( !defined( 'POINTS_TYPE_NEW_COMMENT' ) ) {
			require_once ( POINTS_CORE_LIB . '/constants.php' );
		}
		$user = get_user_by( 'email', get_comment_author_email( $comment_id ) );
		if ( $user ) {
			if ( $status == "1" ) {
				Points::set_points( get_option('points-comments', 0),
					$user->ID,
					array(
						'description' => 'comment_posted_'.$comment_id.'',
						'status'      => get_option( 'points-points_status', POINTS_STATUS_ACCEPTED ),
						'type'        => POINTS_TYPE_NEW_COMMENT
					)
				);
			}
		}
	}

}
Points_Wordpress::init();