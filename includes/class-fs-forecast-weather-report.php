<?php
/**
 * The file that defines the weather api report
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
class Fs_Forecast_Weather_Report 
{
    /**
     * Main labels
     * 
     * @var array
     */
    public static $keyTranslations = array (
        'loc'   => 'Localisation',
        'cc'    => 'Conditions actuelles',
        'dayf'  => 'Prévisions journalières',
        'dname' => 'Ville',
        'tm'    => 'Dernière mise à jour',
        'lat'   => 'latitude',
        'lon'   => 'longitude',
        'sunr'  => 'Lever du soleil',
        'suns'  => 'Coucher du soleil',
    );
    
    /**
     * Current forecast labels
     * 
     * @var array
     */
    public static $ccTranslations = array (   
        'lsup' => 'Dernière mise à jour',
        'flik' => 'Température ressentie',
        't' => 'Description',
        'bar' => 'Pression atmosphérique',
        'obst' => 'Station météo',
        'tmp' => 'Température',
        'icon' => 'Image',
        'vis' => 'Visibilité',
        'dewp' => 'Température de rosée',
        'wind' => 'Vent',
        'hmid' => 'Humidité',
        'uv' => 'Indice Uv',
        'moon' => 'Phase de lune',
    );
    
    /**
     * Pressure forecast labels
     * 
     * @var array
     */
    public static $pressureTranslations = array(
        'bar' => 'Baromètre',
        'd'	=> 'Pression atmosphérique',
        't' => 'Tendance de la pression',
    );
    
    /**
     * Daily forecast labels
     *
     * @var array
     */
    public static $dayfTranslations = array(
        'lsup' =>  'Dernière mise à jour',
        'hi' =>  'Température maximale',
        'low' =>  'Température minimale',
        'part' =>  'Jour de prévision',
        'd'	=>  'Index du jour',
        't' =>  'Jour description',
        'dt' => 'Mois et numéro du jour',
    );
    /**
     * Daily informations forecast labels
     *
     * @var array
     */
    public static $partTranslations = array(
        'part' =>  'Mi-journée',
        'n'	=>  'Nuit',
        'd'	=>  'Jour',
        'p' =>  'période',
        't'	=>  'Temps description',
        'bt' =>  'Temps description courte',
        'hmid' =>  'Humidité',
        'pcpp' =>  'Précipitations',
    );
    
    /**
     * Wind forecast labels
     *
     * @var array
     */
    public static $windTranslations = array(
        'wind' 	=>  'Vents',
        's' =>  'Vitesse en noeuds',
        'gust' =>  'Rafale',
        'd' =>  'Direction',
        't' => 'Vent description',
    );
    
    /**
     * Moon forecast labels
     *
     * @var array
     */
    public static $moonTranslations = array(
        'moon' 	=> 'Lune',
        'icon'	=> 'Image',
        't' => 'Lune description',
    );
    
    /**
     * More infos forecast labels
     *
     * @var array
     */
    public static $uvTranslations = array(
        'uv' => 'Lune',
        'i'	=> 'Indice',
        't' => 'UV description',
    );

    protected $datas = array ();
    

    /**
     * Convert temperature en_US format to fr_FR format
     *
     * @return string
     */
    public static function toCelsius($t) {
        if (! is_numeric($t)) 
            return $t;
        return round(($t - 32) * 5 / 9);
    }
    
    /**
     * Convert time en_US format to sql format 
     * 
     * @return string 
     */
    public static function to24H($time) {
        preg_match('`(\d+)\:(\d+)\s+(AM|PM)?`', $time, $matches);        
        if ($matches[3] == 'PM') {
            $matches[1] += 12;
        }
        
        return $matches[1] . ':' . $matches[2];
    }

    /**
     * Set the data report
     */
    public function __construct(array $datas = array()) {
        $this->datas = $datas;
    }

    /**
     * Returns forecast data by his key
     *
     * @return array
     */
    public function getData($key) {
        if (isset($this->datas[$key]))
            return $this->datas[$key];
    }

    /**
     * Returns all forecast datas
     *
     * @return array
     */
    public function getDatas() {
        return $this->datas;
    }

    /**
     * Returns array forecast for current day
     *
     * @return array
     */
    public function getLoc() {
        if (isset($this->datas['loc']))
            return $this->datas['loc'];
        return '';
    }

    /**
     * Returns array forecast for current day
     *
     * @return array
     */
    public function getCc() {
        if (isset($this->datas['cc']))
            return $this->datas['cc'];
        return '';
    }

    /**
     * Returns array forecast for future days
     * 
     * @return array
     */
    public function getDayf() {
        if (isset($this->datas['dayf']))
            return $this->datas['dayf'];
        return '';
    }   
}