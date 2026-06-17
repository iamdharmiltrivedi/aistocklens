<?php
/**
 * Shortcode Registration
 *
 * @package aistocklens-tools
 */

defined( 'ABSPATH' ) || exit;

class ASLT_Shortcodes {

    public static function init() {
        $shortcodes = [
            'sip_calculator'        => 'sip',
            'emi_calculator'        => 'emi',
            'fd_calculator'         => 'fd',
            'cagr_calculator'       => 'cagr',
            'ppf_calculator'        => 'ppf',
            'nps_calculator'        => 'nps',
            'retirement_calculator' => 'retirement',
        ];

        foreach ( $shortcodes as $tag => $key ) {
            add_shortcode( $tag, [ __CLASS__, 'render_' . $key ] );
        }
    }

    // -----------------------------------------------------------------------
    // Shared: output calculator HTML + enqueue its script
    // -----------------------------------------------------------------------
    private static function render( $key, $html_file ) {
        $file = ASLT_DIR . 'templates/calculators/' . $html_file;
        if ( ! file_exists( $file ) ) {
            return '<p class="aslt-error">' . esc_html__( 'Calculator not found.', 'aistocklens-tools' ) . '</p>';
        }
        wp_enqueue_script( 'aslt-' . $key );
        ob_start();
        include $file;
        return ob_get_clean();
    }

    public static function render_sip()        { return self::render( 'sip',        'sip-calculator.php' ); }
    public static function render_emi()        { return self::render( 'emi',        'emi-calculator.php' ); }
    public static function render_fd()         { return self::render( 'fd',         'fd-calculator.php' ); }
    public static function render_cagr()       { return self::render( 'cagr',       'cagr-calculator.php' ); }
    public static function render_ppf()        { return self::render( 'ppf',        'ppf-calculator.php' ); }
    public static function render_nps()        { return self::render( 'nps',        'nps-calculator.php' ); }
    public static function render_retirement() { return self::render( 'retirement', 'retirement-calculator.php' ); }
}
