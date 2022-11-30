<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.helloagdigital.com
 * @since      1.0.0
 *
 * @package    Hello_Tools
 * @subpackage Hello_Tools/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hello_Tools
 * @subpackage Hello_Tools/admin
 * @author     hello. agência digital <hello@helloagdigital.com>
 */
class Hello_Tools_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

        $this->settings = get_option( 'tools' );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hello-tools-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hello-tools-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_menu() {

        add_menu_page(
			'TOOLS - Configurações',
			'TOOLS',
			'manage_options',
			'tools',
			[ $this, 'tools_settings' ],
			'dashicons-welcome-learn-more',
			80
        );
        
    }

	public function tools_settings() {

        $result = false;
        $tools  = $this->settings;

        if( isset( $_POST['action'] ) && $_POST['action'] == 'save' ) {
            $result = $this->save_settings( $_POST['tools'] );
            $tools = $_POST['tools'];
        }

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/dashboard.php';

    }

	public function save_settings( $data ) {

        // if( empty( $data['token'] ) ) {
        //     $result = new WP_Error( 'error', "" );
        //     return $result;
        // }

        update_option( 'tools', $data );
        return true;

    }

	 /**
     * Syncronization
     */
    public function sync_periods() {

		$data = array();

        $tools = new Tools();
        $years 	 = $tools->get_enroll_year();
		$courses = $tools->get_courses();

		if( !empty( $years ) ) {
			$data['years'] = $years;
		}

		if( !empty( $courses ) ) {
			$data['courses'] = $courses;
		}

		$current_settings = array_merge( $this->settings, $data );
		$this->save_settings( $current_settings );

        $result = array(
            'success'   => true,
            'data'      => array(
                            'message' => 'Períodos sincronizados!'
            )
        );
        wp_send_json( $result );
        wp_die();
    }

}
