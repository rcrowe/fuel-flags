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
* @package	Feature
* @version	1.0
* @author	Rob Crowe
* @link		http://vivalacrowe.com
*/
class Feature {
	
	/**
	 * @var  Array  Stores an instance of Feature_Flags for each flag
	 */
	protected static $instances = array();
	
	/**
	 * Called by Fuel when package is loaded. Loads config file.
	 */
	public static function _init()
	{
		// Load feature config file
		\Config::load('feature', true);
	}
	
	/**
	 * Return an instance of a Flag to check against
	 *
	 * @return Feature\Feature_Flag
	 */
	public static function flag($flag)
	{
		// Have we already looked for flag before?
		if(!array_key_exists($flag, static::$instances))
		{
			static::$instances[$flag] = new Feature_Flag($flag);
		}
		
		return static::$instances[$flag];
	}
}

/* end of file feature/classes/feature.php */