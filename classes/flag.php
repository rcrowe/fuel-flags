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
class Feature_Flag {
	
	protected $flag;
	protected $table;
	
	protected $row;
	
	public function __construct($flag, $table)
	{
		$this->flag       = $flag;
		$this->table      = $table;
		
		// Get feature row from table
		$this->row = \DB::select('*')->from($table)->where('name', $flag)->execute();
		
		if(count($this->row) === 0)
		{
			throw new FeatureException('Unknown feature flag `'.$flag.'`');
		}
	}
	
	public function __call($flag, $arguments)
	{
		if($this->row->get('enabled') === 'Y') return TRUE;
		
		if(count($arguments) < 1) return FALSE;
		
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

/* end of file feature.php */
