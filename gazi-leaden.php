<?php
/**
 * Plugin Name: Gazi Leaden
 * Description: A lead generation plugin.
 * Plugin URI:  https://owndevs.com/plugin/gazi-leaden
 * Version:     1.0.0
 * Author:      Gazi Akter
 * Author URI:  https://gaziakter.com/
 * Text Domain: gazi-leaden
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */


 if (!defined('ABSPATH')) {
    exit;
}

class GaziLeaden {
    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function define_constants() {
        define('GAZI_LEADEN_VERSION', '1.0');
        define('GAZI_LEADEN_PLUGIN_DIR', plugin_dir_path(__FILE__));
        define('GAZI_LEADEN_PLUGIN_URL', plugin_dir_url(__FILE__));
    }

    private function includes() {
        include_once GAZI_LEADEN_PLUGIN_DIR . 'includes/class-gazi-leaden-db.php';
        include_once GAZI_LEADEN_PLUGIN_DIR . 'includes/class-gazi-leaden-form.php';
        include_once GAZI_LEADEN_PLUGIN_DIR . 'includes/class-gazi-leaden-admin.php';
    }

    private function init_hooks() {
        register_activation_hook(__FILE__, array('GaziLeaden_DB', 'create_table'));
        add_action('init', array('GaziLeaden_Form', 'register_shortcode'));
        add_action('admin_menu', array('GaziLeaden_Admin', 'register_menu'));
    }
}

new GaziLeaden();
?>