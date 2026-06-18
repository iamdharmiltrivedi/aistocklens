<?php
/**
 * AdSense Ad System
 *
 * Single source of truth for all ad units.
 * Toggle ASLT_ENABLE_ADS to false anywhere before this file loads
 * to disable every ad on the site without touching templates.
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'ASLT_ENABLE_ADS' ) ) {
    define( 'ASLT_ENABLE_ADS', true );
}

/** AdSense publisher ID */
define( 'ASLT_ADSENSE_PUBLISHER', 'ca-pub-2666618368950032' );

// ---------------------------------------------------------------------------
// AD UNIT REGISTRY
// ---------------------------------------------------------------------------

/**
 * Returns the slot-ID map keyed by position slug.
 *
 * @return array<string,string>
 */
function aslt_ad_units() {
    return [
        'page_top_1'      => '4167201404',
        'page_top_2'      => '1541038069',
        'middle'          => '4073199612',
        'page_bottom'     => '5427208536',
        'page_bottom_2'   => '7914874720',
        'left_sidebar'    => '6426263734',
        'right_sidebar'   => '8395588007',
        'left_sidebar_2'  => '6189093032',
        'right_sidebar_2' => '9498299573',
        'footer'          => '9517097981',
        'marketplace'     => '1945993057',
    ];
}

/**
 * Returns the BEM modifier CSS class for a given position.
 *
 * @param  string $position
 * @return string
 */
function aslt_ad_class( $position ) {
    $map = [
        'page_top_1'      => 'aslt-ad-top',
        'page_top_2'      => 'aslt-ad-top',
        'middle'          => 'aslt-ad-middle',
        'page_bottom'     => 'aslt-ad-bottom',
        'page_bottom_2'   => 'aslt-ad-bottom',
        'left_sidebar'    => 'aslt-ad-sidebar',
        'right_sidebar'   => 'aslt-ad-sidebar',
        'left_sidebar_2'  => 'aslt-ad-sidebar',
        'right_sidebar_2' => 'aslt-ad-sidebar',
        'footer'          => 'aslt-ad-footer',
        'marketplace'     => 'aslt-ad-middle',
    ];

    return isset( $map[ $position ] ) ? $map[ $position ] : 'aslt-ad-middle';
}

// ---------------------------------------------------------------------------
// RENDER FUNCTION
// ---------------------------------------------------------------------------

/**
 * Render a responsive AdSense unit.
 *
 * @param string $position  Key from aslt_ad_units().
 * @param bool   $echo      True  = echo immediately (default).
 *                          False = return HTML string.
 * @return string|void
 */
function aslt_render_ad( $position, $echo = true ) {
    // Kill-switch: return silently when ads are disabled.
    if ( ! ASLT_ENABLE_ADS ) {
        return $echo ? null : '';
    }

    $units = aslt_ad_units();

    if ( ! isset( $units[ $position ] ) ) {
        return $echo ? null : '';
    }

    $slot      = $units[ $position ];           // numeric string from our own array — safe
    $css_class = aslt_ad_class( $position );

    ob_start();
    ?>
    <div class="aslt-ad <?php echo esc_attr( $css_class ); ?>" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="<?php echo esc_attr( ASLT_ADSENSE_PUBLISHER ); ?>"
             data-ad-slot="<?php echo esc_attr( $slot ); ?>"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>
    <?php
    $html = ob_get_clean();

    if ( $echo ) {
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built entirely from esc_attr() / esc_attr_e() calls above
        echo $html;
    } else {
        return $html;
    }
}
