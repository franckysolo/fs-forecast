<?php
/**
 * The file that defines the weather api service connexion
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
class Fs_Forecast_Weather_Api
{
    /**
     * Url of weather.com service
     * 
     * @var string 
     */
    protected $baseUrl = 'http://wxdata.weather.com/wxdata/weather/local/';
    
    /**
     * 
     * @var array
     */
    protected $options = array();
    
    /**
     * The forecast station 
     * 
     * Default set near my house :), to fr_FR - Bordeaux
     * 
     * @var string
     */
    protected $station = 'MOSM0341';
    
    /**
     * 
     * @param array $options
     * @param string $station
     */
    public function __construct($options, $station) {
        $this->options  = $options;
        $this->station  = (string) $station;
    }
    
    /**
     *
     * @return string
     */
    public function getStation() {
        return $this->station;
    }
      
    /**
     * Request to service via curl
     * 
     * @return Forecast_Weather_Report
     */
    public function query() {
        $query  = http_build_query($this->options);
        $url    = sprintf('%s%s?%s', $this->baseUrl, $this->station, $query);
        
        $ch     = curl_init($url);
        $options = array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
        );
        
        curl_setopt_array($ch, $options);
        $doc = curl_exec($ch);
        $sls = simplexml_load_string($doc);
        //convert xml to php array
        $array = json_decode(json_encode((array)$sls), true);
        
        return new Fs_Forecast_Weather_Report($array);
    }
}