<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
	// Since WP 3.1.
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * Lingotek Custom Fields Table class.
 */
class Lingotek_Custom_Fields_Table extends WP_List_Table {
	/**
	 * List of custom fields to display, excluding hidden-copy fields.
	 *
	 * @var array
	 */
	private $custom_fields;
	/**
	 * List of custom fields.
	 *
	 * @var array
	 */
	private $custom_field_choices;

	/**
	 * Constructor
	 *
	 * @since 0.2
	 *
	 * @param array $custom_fields custom fields to display.
	 * @param array $custom_field_choices raw custom fields.
	 */
	public function __construct( $custom_fields, $custom_field_choices ) {
		$this->custom_fields        = $custom_fields;
		$this->custom_field_choices = $custom_field_choices;
		parent::__construct(
			array(
				// Do not translate (used for css class).
				'plural' => 'lingotek-custom-fields',
				'ajax'   => false,
			)
		);
	}

	/**
	 * Gets the custom fields to display
	 *
	 * @since 1.5.5
	 *
	 * @param string $search Search term to filter out the list.
	 * @return array
	 */
	public function get_custom_fields( $search = '' ) {
		if ( ! isset( $this->custom_fields ) || ! empty( $search ) ) {
			$this->custom_fields = Lingotek_Group_Post::get_cached_meta_values( $search );
		}
		return $this->custom_fields;
	}
	/**
	 * Displays the item's meta_key
	 *
	 * @since 0.2
	 *
	 * @param array $item item.
	 * @return string
	 */
	protected function column_meta_key( $item ) {
		return isset( $item['meta_key'] ) ? esc_html( $item['meta_key'] ) : '';
	}

	/**
	 * Displays the item setting
	 *
	 * @since 0.2
	 *
	 * @param array $item item.
	 */
	protected function column_setting( $item ) {
		$settings = array( 'translate', 'copy', 'ignore' );
		printf( '<select class="custom-field-setting" name="%1$s" id="%1$s" onchange="this.form.submit()">', 'settings[' . esc_html( $item['meta_key'] ) . ']' );

		// select the option from the lingotek_custom_fields option.
		foreach ( $settings as $setting ) {
			if ( $setting === $this->custom_field_choices[ $item['meta_key'] ] ) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
			echo "\n\t<option value='" . esc_attr( $setting ) . "' " . esc_html( $selected ) . '>' . esc_attr( ucwords( $setting ) ) . '</option>';
		}
		echo '</select>';
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_columns() {
		return array(
			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'cb'       => '<input type="checkbox" />',
			'meta_key' => __( 'Custom Field Key', 'lingotek-translation' ),
			'setting'  => __( 'Action', 'lingotek-translation' ),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_sortable_columns() {
		return array(
			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_key' => array( 'meta_key', false ),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function prepare_items() {
		if ( isset( $_POST['page'] ) && isset( $_POST['s'] ) ) {
			$this->custom_fields = $this->get_custom_fields( $_POST['s'] );
		} else {
				$this->custom_fields = $this->get_custom_fields();
		}
		$this->_column_headers = array( $this->get_columns(), array(), $this->get_sortable_columns() );

		// No sort by default.
		if ( ! empty( $orderby ) ) {
			usort( $this->custom_fields, 'usort_reorder' );
		}

		/* pagination */
		$per_page            = 25;
		$total_items         = count( $this->custom_fields );
		$current_page        = $this->get_pagenum();
		$this->custom_fields = array_slice( $this->custom_fields, ( ( $current_page - 1 ) * $per_page ), $per_page );
		$this->set_pagination_args(
			array(
				'total_items' => $total_items,
				'per_page'    => $per_page,
			)
		);

		$this->items = $this->custom_fields;
	}

	/**
	 * Custom sorting comparator.
	 *
	 * @param  array $a array of strings.
	 * @param  array $b array of strings.
	 * @return int sort direction.
	 */
	public function usort_reorder( $a, $b ) {
		$order   = filter_input( INPUT_GET, 'order' );
		$orderby = filter_input( INPUT_GET, 'orderby' );
		// Determine sort order.
		$result = strcmp( $a[ $orderby ], $b[ $orderby ] );
		// Send final sort direction to usort.
		return ( empty( $order ) || 'asc' === $order ) ? $result : -$result;
	}

	/**
	 * {@inheritdoc}
	 */
	public function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" class="boxes" name="%s" value="%s" > ',
			esc_html( $item['meta_key'] ),
			esc_html( $item['setting'] )
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_bulk_actions() {
		$actions = array(
			'ignore'    => 'Ignore',
			'translate' => 'Translate',
			'copy'      => 'Copy',
		);
		return $actions;
	}
}
