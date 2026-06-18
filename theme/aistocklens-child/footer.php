<?php
/**
 * Site Footer
 *
 * @package aistocklens-child
 */
defined( 'ABSPATH' ) || exit;
?>

<footer class="asl-footer" aria-label="<?php esc_attr_e( 'Site footer', 'aistocklens-child' ); ?>">
    <div class="asl-container">
        <div class="asl-footer__grid">

            <!-- Brand col -->
            <div>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:inline-flex;align-items:center;gap:var(--space-2);margin-bottom:var(--space-3);text-decoration:none">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo.png' ); ?>"
                         alt="AI Stock Lens" width="32" height="32" loading="lazy">
                    <span class="asl-footer__brand-name">AI Stock Lens</span>
                </a>
                <p class="asl-footer__tagline">
                    <?php esc_html_e( 'Free financial tools, investment guides, and market insights for Indian investors.', 'aistocklens-child' ); ?>
                </p>
                <div style="display:flex;gap:var(--space-3)">
                    <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="asl-btn asl-btn--outline" style="font-size:var(--text-sm);padding:.375rem .875rem;color:rgba(255,255,255,.7);border-color:rgba(255,255,255,.2)">
                        <?php esc_html_e( 'Read Blog', 'aistocklens-child' ); ?>
                    </a>
                </div>
            </div>

            <!-- Calculators col -->
            <div>
                <p class="asl-footer__col-title"><?php esc_html_e( 'Calculators', 'aistocklens-child' ); ?></p>
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer-col-1',
                    'container'      => false,
                    'menu_class'     => 'asl-footer__links',
                    'depth'          => 1,
                    'fallback_cb'    => 'aslc_footer_calc_fallback',
                ] );
                ?>
            </div>

            <!-- Learn col -->
            <div>
                <p class="asl-footer__col-title"><?php esc_html_e( 'Learn', 'aistocklens-child' ); ?></p>
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer-col-2',
                    'container'      => false,
                    'menu_class'     => 'asl-footer__links',
                    'depth'          => 1,
                    'fallback_cb'    => 'aslc_footer_learn_fallback',
                ] );
                ?>
            </div>

            <!-- Company col -->
            <div>
                <p class="asl-footer__col-title"><?php esc_html_e( 'Company', 'aistocklens-child' ); ?></p>
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer-col-3',
                    'container'      => false,
                    'menu_class'     => 'asl-footer__links',
                    'depth'          => 1,
                    'fallback_cb'    => 'aslc_footer_company_fallback',
                ] );
                ?>
            </div>

        </div><!-- /.asl-footer__grid -->

        <!-- Disclaimer -->
        <div class="asl-footer__disclaimer">
            <?php esc_html_e( 'Disclaimer: AI Stock Lens is for educational and informational purposes only. Nothing on this site constitutes financial advice, investment recommendation, or solicitation to buy or sell any security. Always consult a qualified financial advisor before making investment decisions. Mutual fund investments are subject to market risks.', 'aistocklens-child' ); ?>
        </div>

        <!-- Bottom bar -->
        <div class="asl-footer__bottom">
            <span>
                &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
                <?php echo esc_html( get_bloginfo( 'name' ) ); ?>.
                <?php esc_html_e( 'All rights reserved.', 'aistocklens-child' ); ?>
            </span>
            <span style="display:flex;gap:var(--space-6);flex-wrap:wrap">
                <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" style="color:inherit"><?php esc_html_e( 'Privacy Policy', 'aistocklens-child' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/disclaimer/' ) ); ?>" style="color:inherit"><?php esc_html_e( 'Disclaimer', 'aistocklens-child' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color:inherit"><?php esc_html_e( 'Contact', 'aistocklens-child' ); ?></a>
            </span>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
