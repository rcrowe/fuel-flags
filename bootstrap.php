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


Autoloader::add_core_namespace('Feature');

Autoloader::add_classes(array(
    'Feature\\Feature'          => __DIR__.'/classes/feature.php',
    'Feature\\FeatureException' => __DIR__.'/classes/exception.php',
    'Feature\\Feature_Flag'     => __DIR__.'/classes/flag.php',
));


/* End of file bootstrap.php */