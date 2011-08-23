<?php

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

return array(
	
	/**
	 * Name of database table where flags are stored.
	 */
	'table'         => 'flags',
	
	/**
	 * If flag can not be found should we throw an exception.
	 */
	'fail_silently' => TRUE,
);