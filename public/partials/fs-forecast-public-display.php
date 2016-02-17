<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.franckysolo-productions.com/
 * @since      1.0.0
 *
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/public/partials
 */
$pn         = $this->plugin_name;
$report     = $this->report;
$ccLabels   = $report::$ccTranslations;
$loc        = $report->getLoc();
$lang       = get_locale();
$baseUrl    = plugin_dir_url(__DIR__) . 'images/meteo';
$days       = $report->getDayf();
$day        = current($days['day']);
$title      = $day['@attributes']['t'];
?>
<section id="fs-forecast" class="widget widget_forecast">
 	<div class="forecast">
 		<h3>
    		<?php echo __($ccLabels['obst'], 'fs-forecast');?> 
    		<small><?php echo $loc['dnam'];?></small>
    	</h3>
 		<div class="panel-forecast">
 			<h4>
 				<?php echo __($title, $pn);?> <?php  echo strftime(__('%d %B %Y', $pn));?>
 				<a class="wc-icon" href="http://www.weather.com/"><span>The weather channel</span></a>
 			</h4>
 		</div>
 		<table class="table-forecast">
 			<tr>
 				<th>
 					<?php echo __("Sunrise", $pn);?> 
 					<?php echo $lang == 'fr_FR' ? $report::to24H($day['sunr']) : $day['sunr']; ?>
 				</th>
 				<th>
 					<?php echo __("Sunset", $pn);?>
					<?php echo $lang == 'fr_FR' ? $report::to24H($day['suns']) : $day['suns']; ?>
 				</th>
 			</tr>
 			<tr>
 				<td class="text-center">
 					<figure>
 					<?php if (! empty($day['part'][0]['icon'])):?>
 					<img src="<?php echo $baseUrl . '/' . $day['part'][0]['icon'];?>.png" class="img-responsive"
         				alt="<?php echo __($title, $pn);?>" title="<?php echo __($title, $pn);?>">
 					<?php else:?>
 					<?php echo $this->display_widget_empty_icon($title, $baseUrl);?>
 					<?php endif;?>
 					<?php echo $this->display_widget_informations($day['hi']);?>
 					</figure>
 				</td>
 				<td class="text-center">
 					<figure>
 					<?php if (! empty($day['part'][1]['icon'])):?>
 					<img src="<?php echo $baseUrl . '/' . $day['part'][1]['icon'];?>.png" class="img-responsive"
         				alt="<?php echo __($title, $pn);?>" title="<?php echo __($title, $pn);?>">
 					<?php else:?>
 					<?php echo $this->display_widget_empty_icon($title, $baseUrl);?>
 					<?php endif;?>
 					<?php echo $this->display_widget_informations($day['low']);?>
 					</figure>
 				</td>
 			</tr>
 		</table>
 	</div>
</section>
