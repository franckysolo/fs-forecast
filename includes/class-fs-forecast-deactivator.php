<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.franckysolo-productions.com/
 * @since      1.0.0
 *
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/includes
 * @author     MATHERAT Franck - franckysolo <franckysolo@gmail.com>
 */
class Fs_Forecast_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
	    
        $option_name = 'fs-forecast';           
        delete_option( $option_name );	    
	}

}
