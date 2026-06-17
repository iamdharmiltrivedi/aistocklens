<?php
/**
 * Plugin Name:       AI Stock Lens Tools
 * Plugin URI:        https://aistocklens.com
 * Description:       Financial calculators (SIP, EMI, FD, CAGR, PPF, NPS) + Custom Post Types for AI Stock Lens.
 * Version:           1.0.0
 * Author:            AI Stock Lens
 * Author URI:        https://aistocklens.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       aistocklens-tools
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Requires PHP:      8.0
 *
 * @package aistocklens-tools
 */

defined( 'ABSPATH' ) || exit;

define( 'ASLT_VERSION', '1.0.0' );
define( 'ASLT_DIR',     plugin_dir_path( __FILE__ ) );
define( 'ASLT_URI',     plugin_dir_url( __FILE__ ) );
define( 'ASLT_FILE',    __FILE__ );

// Load sub-modules
require_once ASLT_DIR . 'includes/class-cpt.php';
require_once ASLT_DIR . 'includes/class-enqueue.php';
require_once ASLT_DIR . 'includes/class-shortcodes.php';

// Bootstrap
add_action( 'plugins_loaded', 'aslt_boot' );
function aslt_boot() {
    ASLT_CPT::init();
    ASLT_Enqueue::init();
    ASLT_Shortcodes::init();
}

// Activation hook — flush rewrite rules
register_activation_hook( ASLT_FILE, 'aslt_activate' );
function aslt_activate() {
    ASLT_CPT::register_all();
    flush_rewrite_rules();
}

// Deactivation hook
register_deactivation_hook( ASLT_FILE, function () {
    flush_rewrite_rules();
} );
