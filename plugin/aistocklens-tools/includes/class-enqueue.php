<?php
/**
 * Asset Enqueue Handler
 *
 * @package aistocklens-tools
 */

defined( 'ABSPATH' ) || exit;

class ASLT_Enqueue {

    public static function init() {
        add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_frontend' ] );
    }

    public static function enqueue_frontend() {
        wp_enqueue_style(
            'aslt-calculators',
            ASLT_URI . 'assets/css/calculators.css',
            [],
            ASLT_VERSION
        );

        // Calculator scripts — enqueue once, they are self-contained
        $scripts = [
            'aslt-sip'        => 'sip-calculator.js',
            'aslt-emi'        => 'emi-calculator.js',
            'aslt-fd'         => 'fd-calculator.js',
            'aslt-cagr'       => 'cagr-calculator.js',
            'aslt-ppf'        => 'ppf-calculator.js',
            'aslt-nps'        => 'nps-calculator.js',
            'aslt-retirement' => 'retirement-calculator.js',
        ];

        foreach ( $scripts as $handle => $file ) {
            wp_register_script(
                $handle,
                ASLT_URI . 'assets/js/' . $file,
                [],
                ASLT_VERSION,
                true
            );
            wp_script_add_data( $handle, 'defer', true );
        }
    }
}
