<?php
/**
 * The file that defines the widget plugin class
 *
 *
 * @link       http://www.franckysolo-productions.com/
 * @since      1.0.0
 *
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/includes
 */

/**
 * The widget plugin class.
 *
 *
 * @since      1.0.0
 * @package    Fs_Forecast
 * @subpackage Fs_Forecast/includes
 * @author     MATHERAT Franck - franckysolo <franckysolo@gmail.com>
 */
class Fs_Forecast_Widget extends WP_Widget
{
    /**
     * The weather api service
     * 
     * @var Fs_Forecast_Weather_Api
     */
    protected $api;
    
    /**
     * The api reporter
     * 
     * @var Fs_Forecast_Weather_Report
     */
    protected $report;
    
    /**
     * The plugin name
     * 
     * @var string
     */
    protected $plugin_name = 'fs-forecast';

    /**
     * The url options
     * 
     * @var array
     */
    protected $options = array (
        'link' => 'xoap', // could be ignored
        'prod' => 'xoap', // could be ignored
        'cc' => '*',
        'dayf' => 5       // 5 days forecast
    );

    /**
     * Built a weather forecast widget
     */
    public function __construct() {
        
        parent::__construct($this->plugin_name, _('Forecats Weather Plugin'), array('description' => 'Display the daily weather forecast'));
        
        $option = get_option($this->plugin_name);
                        
        if (isset($options['forecast_id'])) {
            $this->options['par'] = $options['forecast_id'];
        }
        
        if (isset($options['forecast_key'])) {
            $this->options['key'] = $options['forecast_key'];
        }
        
        $station = isset($options['forecast_station']) ? $options['forecast_station'] : 'FRXX0016';

        $this->api = new Fs_Forecast_Weather_Api($this->options, $station);
    }

    /**
     * Diplay widget section area in sidebar
     * 
     * @param array $args
     * @param array $instance
     * @return void
     */
    public function widget($args, $instance) {
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Plugin météo' ) : $instance['title'], $instance, 'fs-forecast');

        $this->report = $this->api->query();
        
        $data = $this->report->getDatas();
        if (isset($data['err'])) {
            exit($data['err']);
        }

        $this->display_widget_section($title);
    }
    
    /**
     * Diplay widget plugin area
     * 
     * @param string $title
     * @param Fs_Forecast_Weather_Report $report
     */
    public function display_widget_section($title) {
        require_once plugin_dir_path( __DIR__ ) . 'public/partials/fs-forecast-public-display.php';
    }
    

    /**
     * Display an empty icon in view plugin 
     * 
     * @param string $title
     * @param string $baseUrl
     * @return string
     */
    public function display_widget_empty_icon ($title, $baseUrl) {
        $title = __($title, $this->plugin_name);
        $html = <<<HTML
<img src="$baseUrl/25.png" class="img-responsive" alt="$title" title="$title">
HTML;
        return $html;
    }
    
   /**
    * Display temperature in plugin view
    * 
    * @param string $day
    * @return string
    */
    public function display_widget_informations($day) {
        $label = 'T';
        $unit = 'F';
        $temp = $day   == 'N/A' ? '&mdash;' : $day;       
        if (get_locale() == 'fr_FR') {
            $unit = '&deg;';
            $temp = $day == 'N/A' ? '&mdash;' : Fs_Forecast_Weather_Report::toCelsius($day);
        }
                        
        $html = <<<HTML
<figcaption>
    $label : $temp $unit				
</figcaption>
HTML;
        return $html;        
    }

    /**
     * Display form in widget option area
     * 
     * @param mixed $instance
     * 
     * @return void
     */
    public function form($instance) {
        ?>
        <p><?php _e('Options à paramétrer dans la back-office', 'fs-forecast');?></p>
        <?php
    }
}