<?php
/*
Plugin Name: Simple Maintenance2
Version: 1.0.3
Plugin URI: https://github.com/furkun/simple-maintenance2
Author: Furkun
Author URI: https://github.com/furkun
Description: Modified and simplified version of <a href="https://wordpress.org/plugins/simple-maintenance/">Simple Maintenance</a> plugin.
Text Domain: simple-maintenance2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

if(!defined('ABSPATH')) exit;
if(!class_exists('SIMPLE_MAINTENANCE'))
{
class SIMPLE_MAINTENANCE
{
var $plugin_version = '1.0.3';
var $plugin_url;
var $plugin_path;
function __construct()
{
define('SIMPLE_MAINTENANCE_VERSION', $this->plugin_version);
define('SIMPLE_MAINTENANCE_SITE_URL',site_url());
define('SIMPLE_MAINTENANCE_URL', $this->plugin_url());
define('SIMPLE_MAINTENANCE_PATH', $this->plugin_path());
$this->plugin_includes();
}
function plugin_includes()
{
add_action('template_redirect', array($this, 'sm_template_redirect'));
}
function plugin_url()
{
if($this->plugin_url) return $this->plugin_url;
return $this->plugin_url = plugins_url( basename( plugin_dir_path(__FILE__) ), basename( __FILE__ ) );
}
function plugin_path(){ 	
if ( $this->plugin_path ) return $this->plugin_path;		
return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
}
function is_valid_page() {
return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}
function sm_template_redirect()
{
if(is_user_logged_in()){}
else
{
if( !is_admin() && !$this->is_valid_page()){
$this->load_sm_page();
}
}
}
function load_sm_page()
{
header('HTTP/1.0 503 Service Unavailable');
include_once("sm-template.php");
exit();
}
}
$GLOBALS['simple_maintenance'] = new SIMPLE_MAINTENANCE();
}
