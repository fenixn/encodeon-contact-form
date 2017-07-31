<?php
/*
Plugin Name: Encodeon Contact Forms
Description: This plugin handles forms for website.
Version:     1.731
Author:      Phuong Nguyen
*/

// Security Check: Kill script if user is attempting to access this file directly
defined( 'ABSPATH' ) or die( 'Access Restricted' );

// Autoload classes
function encodeon_forms_autoloader( $class_name ) 
{
    if ( false !== strpos( $class_name, 'EncodeonContact' ) ) 
    {
        $classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
        $class_file = str_replace( '\\', DIRECTORY_SEPARATOR, $class_name ) . '.php';
        require_once $classes_dir . $class_file;
    }
}
spl_autoload_register( 'encodeon_forms_autoloader' );

$encodeon_contact_forms = new \EncodeonContact\Plugin;
