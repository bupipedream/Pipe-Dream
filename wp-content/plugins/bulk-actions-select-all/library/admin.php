<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if access directly

/**
 * @since 1.0
 */
class BASA_Admin {

	/**
	 * Plugin class instance
	 *
	 * @var BASA
	 * @since 1.0
	 */
	public $basa;

	/**
	 * @since 1.0
	 */
	public function __construct( BASA $basa ) {
		$this->basa = $basa;

		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
		add_action( 'check_admin_referer', array( $this, 'handle_bulkactions' ), 10, 2 );
	}

	/**
	 * @since 1.0
	 */
	public function scripts( $hook ) {
		global $wp_list_table;

		wp_register_script( 'basa-admin', BASA_PLUGIN_URL . 'assets/js/admin.js', array( 'jquery' ) );
		wp_register_style( 'basa-admin', BASA_PLUGIN_URL . 'assets/css/admin.css' );

		if ( $hook == 'edit.php' && ! empty( $wp_list_table ) ) {
			$total_items = $wp_list_table->get_pagination_arg( 'total_items' );
			$per_page = $wp_list_table->get_pagination_arg( 'per_page' );

			if ( $total_items && $per_page && $total_items > $per_page ) {
				wp_enqueue_script( 'basa-admin' );
				wp_enqueue_style( 'basa-admin' );

				$all_entries_selected = __( 'All <strong>%d</strong> entries are now selected.', 'basa' );
				$all_entries_on_page_selected = __( 'All <strong>%d</strong> entries on this page have been selected.', 'basa' );
				$select_all = __( 'Select all <strong>%d</strong> entries.', 'basa' );
				$deselect_all = __( 'Deselect all.', 'basa' );

				wp_localize_script( 'basa-admin', 'BASA_Admin', array(
					'total_items' => $total_items,
					'items_per_page' => $per_page,
					'i18n' => array(
						'all_x_entries_selected' => $all_entries_selected,
						'all_x_entries_on_page_selected' => $all_entries_on_page_selected,
						'select_all_x_entries' => $select_all,
						'deselect_all' => $deselect_all
					)
				) );
			}
		}
	}

	/**
	 * @since 1.0
	 */
	public function handle_bulkactions( $action, $result ) {
		global $wp_list_table, $wp_query;

		if ( ! $result || $action != 'bulk-posts' ) {
			return;
		}

		if ( empty( $wp_list_table ) ) {
			return;
		}

		if ( ! in_array( $wp_list_table->current_action(), array( 'trash', 'untrash', 'delete' ) ) || empty( $_REQUEST['post'] ) ) {
			return;
		}

		if ( empty( $_REQUEST['basa-selectall'] ) || empty( $_REQUEST['basa-num-items'] ) ) {
			return;
		}

		$num_items = intval( $_REQUEST['basa-num-items'] );

		if ( ! $num_items ) {
			return;
		}

		add_filter( 'request', array( $this, 'request_all_ids' ) );
		wp_edit_posts_query();
		remove_filter( 'request', array( $this, 'request_all_ids' ) );

		$num_posts = count( $wp_query->posts );

		if ( $num_items != $num_posts ) {
			return;
		}

		$_REQUEST['post'] = $wp_query->posts;
	}

	public function request_all_ids( $query_vars ) {
		$query_vars['posts_per_page'] = -1;
		$query_vars['fields'] = 'ids';

		return $query_vars;
	}

}
