<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.franckysolo-productions.com/
 * @since      1.0.0
 *
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/admin
 * @author     MATHERAT Franck - franckysolo <franckysolo@gmail.com>
 */
class Fs_Forecast_Admin {

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
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		// set the locale for strftime
		setlocale(LC_ALL, get_locale(). '.UTF-8');
		
		// defined returns wc days for i18n
		__('Monday', $this->plugin_name);
		__('Tuesday', $this->plugin_name);
		__('Wednesday', $this->plugin_name);
		__('Thursday', $this->plugin_name);
		__('Friday', $this->plugin_name);
		__('Saturday', $this->plugin_name);
		__('Sunday', $this->plugin_name);	
	}

	/**
	 * Register the administration menu into the WP Dashboard menu.
	 * 
	 * @return void
	 */
	public function add_plugin_admin_menu() {
	    add_options_page (
	        __('Forecast Weather Plugin - Configuration', $this->plugin_name),
	        __('Forecast Weather 1.0', $this->plugin_name),
	        'manage_options',
	        $this->plugin_name,
	        array($this, 'display_plugin_setup_page')
        );
	}
	
	/**
	 * The html view for plugin settings
	 * 
	 * @return void
	 */
	public function display_plugin_setup_page() {
	    include_once 'partials/fs-forecast-admin-display.php'; 
	}
	
	/**
	 * 
	 * @param unknown $input
	 */
	public function sanitize_and_validate($input) {
	    
	    $valid = array();
	    
	    $valid['forecast_id'] = (isset($input['forecast_id']) && ! empty($input['forecast_id'])) ? sanitize_text_field( $input['forecast_id'] ) : '';
	    $valid['forecast_key'] = (isset($input['forecast_key']) && ! empty($input['forecast_key'])) ? sanitize_text_field( $input['forecast_key'] ) : '';
	    $valid['forecast_station'] = (isset($input['forecast_station']) && ! empty($input['forecast_station'])) ? sanitize_text_field( $input['forecast_station'] ) : '';
	    
	    // Mandatory station
	    if ( empty($valid['forecast_station']) || ! preg_match( '/^[A-Z0-9]{8}$/i', $valid['forecast_station']  ) ) {
	        add_settings_error(
	            'forecast_station',    
	            'forecast_station_texterror',           
	            __('Please enter a valid station code', $this->plugin_name),     
	            'error'                       
	        );
	    }
	    
	    // Optional ID
	    if (! empty($valid['forecast_id']) && ! preg_match( '/^[0-9]{10}$/i', $valid['forecast_key'] ) ) {
	        add_settings_error(
	            'forecast_id',
	            'forecast_id_texterror',
	            __('Please enter a valid ID', $this->plugin_name),
	            'error'
	        );
	    }
	    
	    // Optional ID
	    if (! empty($valid['forecast_key']) && ! preg_match( '/^[a-z0-9]{8}$/i', $valid['forecast_key'] ) ) {
	        add_settings_error(
	            'forecast_key',
	            'forecast_key_texterror',
	            __('Please enter a valid Key', $this->plugin_name),
	            'error'
	        );
	    }
	    
	    return $valid;
	}
	
	public function update_options() {
	    register_setting($this->plugin_name, $this->plugin_name, array($this, 'sanitize_and_validate'));
	}
}
