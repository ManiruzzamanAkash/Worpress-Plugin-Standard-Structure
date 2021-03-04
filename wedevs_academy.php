<?php
/*
Plugin Name: WeDevs_Academy
Plugin URI: http://wordpress.org/plugins/wedevs-academy
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Ak
Version: 1.0.0
Author URI: http://ma.tt/
*/

use WeDevs\Academy\Installer;

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Wedevs Academy Main class
 */
final class WeDevs_Academy
{

    /**
     * Plugin Version
     * 
     * @var 
     */
    const version = '1.0';

    /**
     * Class Constructor
     */
    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Plugin Initialization
     *
     * @return void
     */
    public function init_plugin()
    {
        if (is_admin()) {
            new WeDevs\Academy\Admin();
        }else{
            new WeDevs\Academy\Frontend();
        }
    }

    /**
     * Activate plugin
     *
     * @return void
     */
    public function activate()
    {
        $installer = new Installer();
        $installer->run();
    }

    /**
     * Initializes a singleton instance
     *
     * @return \WeDevs_Academy
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    public function define_constants()
    {
        define('WD_ACADEMY_VERSION', self::version);
        define('WD_ACADEMY_FILE', __FILE__);
        define('WD_ACADEMY_PATH', __DIR__);
        define('WD_ACADEMY_URL', plugins_url('', WD_ACADEMY_FILE));
        define('WD_ACADEMY_ASSETS', WD_ACADEMY_URL . '/assets');
    }
}

/**
 * Initializes the main plugin
 *
 * @return \WeDevs_Academy
 */
function weDevs_academy()
{
    return WeDevs_Academy::init();
}

// start the plugin
weDevs_academy();
