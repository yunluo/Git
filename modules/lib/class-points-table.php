<?php

// WP_List_Table is not loaded automatically so we need to load it in our application
if ( !class_exists( 'WP_List_Table' ) ) {
	require_once (ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class Points_List_Table extends WP_List_Table {
	/**
	 * Prepare the items for the table to process
	 *
	 * @return Void
	 */
	public function prepare_items() {
		$columns = $this->get_columns();
		$hidden = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();
		
		$data = $this->table_data();
		usort( $data, array(
				&$this,
				'sort_data' 
		) );

		$perPage = 20;
		$currentPage = $this->get_pagenum();
		$totalItems = count( $data );
		
		$this->set_pagination_args( array(
				'total_items' => $totalItems,
				'per_page' => $perPage 
		) );

		$data = array_slice( $data, (($currentPage - 1) * $perPage), $perPage );

		$this->_column_headers = array(
				$columns,
				$hidden,
				$sortable
		);
		$this->items = $data;
	}

	/**
	 * Override the parent columns method.
	 * Defines the columns to use in your listing table
	 *
	 * @return Array
	 */
	public function get_columns() {
		$columns = array(
				'point_id' => 'ID',
				'user_id' => '用户ID',
				
				'points' => '积分',
				'description' => '描述',
				'datetime' => '日期&时间',
				'status' => '状态',
				'actions' => '操作'
		);

		return $columns;
	}

	/**
	 * Define which columns are hidden
	 *
	 * @return Array
	 */
	public function get_hidden_columns() {
		return array();
	}

	/**
	 * Define the sortable columns
	 *
	 * @return Array
	 */
	public function get_sortable_columns() {
		return array(
				'point_id' => array(
						'point_id',
						false 
				),
				'user_id' => array(
						'user_id',
						false
				),
				'points' => array(
						'points',
						false
				),
				'description' => array(
						'description',
						false
				),
				'datetime' => array(
						'datetime',
						false
				),
				'status' => array(
						'status',
						false
				)
		);
	}

	/**
	 * Get the table data
	 *
	 * @return Array
	 */
	private function table_data() {
		$data = array();

		$data = Points::get_points( null, null, null, ARRAY_A );

		return $data;
	}

	/**
	 * Define what data to show on each column of the table
	 *
	 * @param Array $item
	 *        	Data
	 * @param String $column_name
	 *        	- Current column name
	 *        	
	 * @return Mixed
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'point_id' :
			case 'user_id' :
			case 'description' :
			case 'points' :
			case 'datetime' :
			case 'status' :
				return $item[$column_name];
				break;
			case 'actions':
				$actions = array(
						'edit'      => sprintf('<a href="?page=%s&action=%s&point_id=%s">编辑</a>',$_REQUEST['page'],'edit',$item['point_id']),
						'delete'    => sprintf('<a href="?page=%s&action=%s&point_id=%s">删除</a>',$_REQUEST['page'],'delete',$item['point_id']),
				);

				//Return the title contents
				return sprintf('%1$s%2$s',
						isset( $item[$column_name] ) ? $item[$column_name]:"",
						$this->row_actions($actions, true)
				);
				break;
			default :
				return print_r( $item, true );
		}
	}

	/**
	 * Allows you to sort the data by the variables set in the $_GET
	 *
	 * @return Mixed
	 */
	private function sort_data( $a, $b ) {
		// Set defaults
		$orderby = 'point_id';
		$order = 'desc';

		// If orderby is set, use this as the sort column
		if ( !empty( $_GET['orderby'] ) ) {
			$orderby = $_GET['orderby'];
		}

		// If order is set use this as the order
		if ( !empty( $_GET['order'] ) ) {
			$order = $_GET['order'];
		}

		$result = strnatcmp( $a[$orderby], $b[$orderby] );

		if ( $order === 'asc' ) {
			return $result;
		}

		return -$result;
	}
}
