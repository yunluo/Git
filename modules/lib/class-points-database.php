<?php

class Points_Database {
	public static $prefix = "points_";
	public static function points_get_table( $table ) {
		global $wpdb;
		$result = "";
		switch ( $table ) {
			case "users":
				$result = $wpdb->prefix . self::$prefix . "users";
				break;
		}
		return $result;
	}
}