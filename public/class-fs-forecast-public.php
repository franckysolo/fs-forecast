<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.franckysolo-productions.com/
 * @since      1.0.0
 *
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/public
 * @author     MATHERAT Franck - franckysolo <franckysolo@gmail.com>
 */
class Fs_Forecast_Public {

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
	 * Plugins options
	 * 
	 * @var array
	 */
	private $fs_options = array();

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->fs_option = get_option($this->plugin_name);
	}
	
	/**
	 * Register forecast widget
	 * 
	 * @return void
	 */
	public function add_plugin_widget() {
	    register_widget('Fs_Forecast_Widget');
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fs_Forecast_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fs_Forecast_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fs-forecast-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Fs_Forecast_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Fs_Forecast_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fs-forecast-public.js', array( 'jquery' ), $this->version, false );

	}

}
