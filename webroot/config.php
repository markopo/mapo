<?php
/**
 * Config-file for mapo. Change settings here to affect installation.
 *
 */

/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly


/**
 * Define mapo paths.
 *
 */
define('MAPO_INSTALL_PATH', __DIR__ . '/..');
define('MAPO_THEME_PATH', MAPO_INSTALL_PATH . '/theme/render.php');


/**
 * Include bootstrapping functions.
 *
 */
include(MAPO_INSTALL_PATH. '/src/bootstrap.php');


/**
 * Start the session.
 *
 */
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();


/**
 * Create the mapo variable.
 *
 */
$mapo = array();


/**
 * Site wide settings.
 *
 */
$mapo['lang']         = 'sv';
$mapo['title_append'] = ' | mapo en webbtemplate';


/**
 * Theme related settings.
 *
 */
$mapo['stylesheets'] = array('css/style.css', 'css/babes.css');
$mapo['favicon']    = 'mapo.png';


/**
 * Navigation menu settings
 *
 */

$mapo['navmenu'] = array(
    'callback' => 'selectedPage',
    'items' => array(
    'me' => array('text' => 'Me', 'url' => 'me.php', 'class'=>null),
    'source' => array('text' => 'Source', 'url' => 'source.php', 'class'=>null),
    'calendar' => array('text' => 'Calendar', 'url' => 'calendar.php', 'class'=>null)
    )
);

/**
 * Settings for JavaScript.
 *
 */
$mapo['modernizr'] = 'js/modernizr.js';
$mapo['jquery'] = 'js/jquery.min.js';
$mapo['javascript_include'] = array('js/main.js', 'js/unslider.min.js');


/**
 * Google analytics.
 *
 */
$mapo['google_analytics'] = null;
