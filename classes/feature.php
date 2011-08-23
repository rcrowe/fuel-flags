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
 * Feature
 *
 * @package     Fuel
 * @subpackage  Auth
 */
class Feature {
	
	// protected static $tables = array();
	// 
	// /**
	//  * @var  Array  contains references if multiple were loaded
	//  */
	// protected static $properties = array();


	// Table where feature flags are stored
	protected static $table;
	
	// Flag instances
	protected static $instances = array();
	
	
	public static function _init()
	{
		// Load feature config file
		\Config::load('feature', true);
		
		// Set table where flags are stored
		static::$table = \Config::get('feature.table', 'flags');
	}
	
	public static function flag($flag)
	{
		if(!array_key_exists($flag, static::$instances))
		{
			static::$instances[$flag] = new Feature_Flag(
				$flag,
				static::$table
			);
		}
		
		return static::$instances[$flag];
	}
}

/* end of file feature.php */
