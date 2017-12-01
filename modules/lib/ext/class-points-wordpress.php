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

		if ( get_option('points-welcome', "0") !== "0" ) {
			add_action( 'user_register', array( __CLASS__,'user_register' ) );
		}
		/*继续构建*/
		if ( get_option('points-post', "0") !== "0" ) {
			add_action( 'asgarosforum_after_add_thread_submit', array( __CLASS__,'points_post' ) );
		}
		/*构建结束*/
	}

	public static function user_register ( $user_id ) {
		Points::set_points( get_option('points-welcome', 0), $user_id,
					array(
						'description' => 'register_'.$user_id.'' ,
						'status' => get_option( 'points-points_status', POINTS_STATUS_ACCEPTED )
					));
	}

	public static function points_post ( $user_id ) {/*论坛发帖子+积分*/
		Points::set_points( get_option('points-welcome', 0), $user_id );
	}

	public static function wp_set_comment_status( $comment_id, $status ) {
		$user = get_user_by( 'email', get_comment_author_email( $comment_id ) );
		if ( $user ) {
			if ( $status == "approve" ) {
				Points::set_points( get_option('points-comments', 1),
					$user->ID,
					array(
						'description' => sprintf( __( 'comment_approve_%d', 'points' ), $comment_id ),
						'status' => get_option( 'points-points_status', POINTS_STATUS_ACCEPTED )
					)
				);
			} else if ( $status == "hold" || $status == "spam" || $status == "delete" || $status == "trash" ) {
				// @todo cambiar el status de los comentarios está mal implementado. Hay que actualizar points, no añadir ni eliminar
				Points::set_points( Points::get_user_total_points( $user->ID ) - get_option('points-comments', 1), $user->ID );
			}
		}
	}

	public static function comment_post( $comment_id, $status ) {
		$user = get_user_by( 'email', get_comment_author_email( $comment_id ) );
		if ( $user ) {
			if ( $status == "1" ) {
				Points::set_points( get_option('points-comments', 1),
					$user->ID,
					array(
						'description' => sprintf( __( 'comment_post_%d', 'points' ), $comment_id ),
						'status' => get_option( 'points-points_status', POINTS_STATUS_ACCEPTED )
					)
				);
			}
		}
	}

}
Points_Wordpress::init();