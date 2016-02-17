<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.franckysolo-productions.com/
 * @since      1.0.0
 *
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/admin/partials
 */
$pn         = $this->plugin_name;
$fs_options = get_option($pn);
?>
<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>	
	<p class="">
		<?php _e('The plugin use the', $pn);?> 
		<a target="_blank" href="http://www.weather.com">The Weather Channel</a> 
		<?php _e('service', $pn);?>, 
		<?php _e('please take a look for retrieve the codes of your favorites stations', $pn);?>.
	</p>
	<form method="post" name="forecast_options" action="options.php">  
		<?php settings_fields($this->plugin_name); ?>
		<?php do_settings_sections($this->plugin_name); ?>
		<fieldset>
        <legend class="screen-reader-text">
        	<span><?php _e('Using the service', $pn); ?> 
        	<a target="_blank" href="http://www.weather.com">The Weather Channel</a></span>
        </legend>
        <h3><?php _e("ID of weather station", $pn);?></h3>
		<p>			
	  		<input class="regular-text" id="<?php echo $pn;?>-forecast_station" name="<?php echo $pn;?>[forecast_station]" type="text" value="<?php echo empty ($fs_options['forecast_station']) ? '' : $fs_options['forecast_station'];?>">
			<label class="description" for="<?php echo $pn;?>-forecast_station">
				<?php esc_attr_e('Enter the weather station you want to display', $pn)?>
	  		</label>
		</p>
       	<h3><?php _e('Your weaher.com ID (Optional)', $pn);?></h3>
		<p>
			<input class="regular-text" id="<?php echo $pn;?>-forecast_id" name="<?php echo $pn;?>[forecast_id]" type="text" value="<?php echo empty ($fs_options['forecast_id']) ? '':  $fs_options['forecast_id'];?>">		
			<label class="description" for="<?php echo $pn;?>-forecast_id">
				<?php esc_attr_e('Enter your weaher.com ID', $pn)?>
	  		</label>
		</p>
        <h3><?php _e('Your weaher.com private Key (Optional)', $pn);?></h3>
		<p>			
	  		<input class="regular-text" id="<?php echo $pn;?>-forecast_key" name="<?php echo $pn;?>[forecast_key]" type="text" value="<?php echo empty ($fs_options['forecast_key']) ? '': $fs_options['forecast_key'];?>">
			<label class="description" for="<?php echo $pn;?>-forecast_key">
				<?php esc_attr_e('Enter your weaher.com private Key', $pn)?>
	  		</label>
		</p>		
        <?php submit_button('Save changes', 'primary', 'submit', true); ?>
        </fieldset>      
	</form>
</div>
