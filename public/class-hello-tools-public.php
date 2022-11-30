<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.helloagdigital.com
 * @since      1.0.0
 *
 * @package    Hello_Tools
 * @subpackage Hello_Tools/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Hello_Tools
 * @subpackage Hello_Tools/public
 * @author     hello. agência digital <hello@helloagdigital.com>
 */
class Hello_Tools_Public {

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

	private $app;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;
		$this->app 			= new Tools();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hello-tools-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		//wp_enqueue_script( $this->plugin_name.'-sweetalert2', plugin_dir_url( __FILE__ ) . '../app/assets/js/sweetalert2.all.min.js', array( 'jquery' ), $this->version, false );
		//wp_enqueue_script( 'jquery-mask', plugin_dir_url( __FILE__ ) . '../app/assets/js/jquery.mask.min.js', array( 'jquery'), '1.14.16', true );
		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../app/assets/js/default.js', array( 'jquery' ), filemtime( dirname( __FILE__ ) . '/../app/assets/js/default.js' ), false );
		
		//wp_localize_script( $this->plugin_name, 'tools', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}

	public function init_shortcodes() {
		
		//add_shortcode( 'tools-matricula', array( $this->app, 'show_enroll_form' ) );
		//add_shortcode( 'tools-contato', array( $this->app, 'show_contact_form' ) );

	}

}
