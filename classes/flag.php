<?php

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Feature;


/**
* Adds the ability to limit access to parts of your application with feature flags.
* You can define what ever flag you like in the database and the code will use them.
*
* Feature::flag('google_analytics')->ip_address('192.168.1.10');
*
* @package  Feature
* @version  1.0
* @author   Rob Crowe
* @link     http://vivalacrowe.com
*/
class Feature_Flag {
    
    /**
     * @var  String  Name of the flag matching on
     */
    protected $flag;
    
    /**
     * @var  String  Name of the database table where flags are stored
     */
    protected $table;
    
    /**
     * @var  Object  Database row
     */
    protected $row;
    
    /**
     * Passes in flag user is looking for and get the database row for it.
     */
    public function __construct($flag)
    {
        $this->flag = $flag;
        
        // Get feature row from table
        $this->row = \DB::select('*')->from(\Config::get('feature.table', 'flags'))
                                     ->where('name', $flag)->execute();
        
        // Feature flag not found, throw an exception?
        if(count($this->row) === 0 AND !\Config::get('feature.fail_silently', FALSE))
        {
            throw new FeatureException('Unknown feature flag `'.$flag.'`');
        }
    }
    
    /**
     * Check method against the flag.
     *
     * To check user id against feature `google_analytics`
     *
     * DB
     * --
     *   user_ids : 2,40,3
     *
     * Controller
     * ----------
     *   Feature::flag('google_analytics')->ip_address(40) -> TRUE
     *
     * @param  $flag       Name of method to check user can access feature flag. Signalised version of column name.
     * @param  $arguments  String or Array to match against.
     * @return Bool        Whether user can access feature
     */
    public function __call($flag, $arguments)
    {
        // If feature flag is enabled, all users can access it
        if($this->row->get('enabled') === 'Y') return TRUE;
        
        // User didnt pass in anything to check against
        // Dont give user access to feature by default
        if(count($arguments) < 1) return FALSE;
        
        // Change name to plural version
        // Table can store multiple values per match item on flag
        $flag  = \Inflector::pluralize($flag);
        $value = $arguments[0];
        
        $match = $this->row->get($flag);
        $match = explode(',', $match);
        
        if(is_array($value))
        {
            foreach($value as $item)
            {
                if(in_array($item, $match)) return TRUE;
            }
        }
        
        return (in_array($value, $match)) ? TRUE : FALSE;
    }
}

/* end of file feature/classes/flag.php */