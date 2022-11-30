<?php

class Tools {

    private $settings;

    public function __construct() {

		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'app/lib/Util.class.php';

        //$this->settings = get_option( 'tools' );
    }

    public function init() {

        $this->hide_generators();
        $this->disable_block_editor();
        $this->disable_emoji();
        $this->add_theme_support_fields();

        // Security
        $this->disable_login_errors();
        $this->disable_autocomplete_login();

    }

    public function plugins_loaded() {


    }

    public function wp_loaded() {

        

    }

    private function hide_generators() {

        remove_action( 'wp_head', 'wp_generator' );

    }

    private function disable_block_editor() {
        add_filter( 'use_block_editor_for_post', '__return_false', 10 );
    }

    private function disable_emoji() {

        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );	
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
        // Remove from TinyMCE
        add_filter( 'tiny_mce_plugins', function( $plugins ) {
            if ( is_array( $plugins ) ) {
                return array_diff( $plugins, array( 'wpemoji' ) );
            } else {
                return array();
            }
        } );

    }

    private function add_theme_support_fields() {
        add_post_type_support( 'page', 'excerpt' );
        add_theme_support( 'post-thumbnails' );
    }

    private function disable_login_errors() {
  
        add_filter( 'login_errors', function() {
            return 'Erro! Usuário ou senha inválidos!';
        });

    }

    private function disable_autocomplete_login() {
        add_action( 'login_form', function() {
            echo <<<html
                <script>
                    document.getElementById( "user_pass" ).autocomplete = "off";
                    document.getElementById( "user_login" ).autocomplete = "off";
                </script>
                html;
        } );
    }

}
