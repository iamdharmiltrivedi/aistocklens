<?php
/**
 * Footer Content — included from Blocksy's footer via hook
 * Or used directly in custom templates via get_template_part().
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;
?>

<footer class="asl-footer" role="contentinfo">
    <div class="asl-container">
        <div class="asl-footer__grid">

            <!-- Brand -->
            <div>
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <div class="asl-footer__brand-name">
                        <?php bloginfo( 'name' ); ?>
                    </div>
                <?php endif; ?>
                <p class="asl-footer__tagline">
                    <?php esc_html_e( 'Free financial tools and investing education for every Indian — from first-time investors to seasoned traders.', 'aistocklens-child' ); ?>
                </p>
                <div style="display:flex;gap:.75rem">
                    <!-- Social icons (replace href with real URLs) -->
                    <a href="#" aria-label="Twitter" style="color:rgba(255,255,255,.5);font-size:1.25rem;transition:color 200ms" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.5)'">𝕏</a>
                    <a href="#" aria-label="YouTube" style="color:rgba(255,255,255,.5);font-size:1.25rem;transition:color 200ms" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.5)'">▶</a>
                    <a href="#" aria-label="Telegram" style="color:rgba(255,255,255,.5);font-size:1.25rem;transition:color 200ms" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.5)'">✈</a>
                </div>
            </div>

            <!-- Calculators -->
            <div>
                <h3 class="asl-footer__col-title"><?php esc_html_e( 'Calculators', 'aistocklens-child' ); ?></h3>
                <ul class="asl-footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/calculators/sip-calculator/' ) ); ?>"><?php esc_html_e( 'SIP Calculator', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/calculators/emi-calculator/' ) ); ?>"><?php esc_html_e( 'EMI Calculator', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/calculators/fd-calculator/' ) ); ?>"><?php esc_html_e( 'FD Calculator', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/calculators/cagr-calculator/' ) ); ?>"><?php esc_html_e( 'CAGR Calculator', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/calculators/ppf-calculator/' ) ); ?>"><?php esc_html_e( 'PPF Calculator', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/calculators/nps-calculator/' ) ); ?>"><?php esc_html_e( 'NPS Calculator', 'aistocklens-child' ); ?></a></li>
                </ul>
            </div>

            <!-- Learn -->
            <div>
                <h3 class="asl-footer__col-title"><?php esc_html_e( 'Learn', 'aistocklens-child' ); ?></h3>
                <ul class="asl-footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/learn/mutual-funds/' ) ); ?>"><?php esc_html_e( 'Mutual Fund Academy', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/learn/stocks/' ) ); ?>"><?php esc_html_e( 'Stock Market Academy', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/guides/' ) ); ?>"><?php esc_html_e( 'Investment Guides', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Blog', 'aistocklens-child' ); ?></a></li>
                </ul>
            </div>

            <!-- Company -->
            <div>
                <h3 class="asl-footer__col-title"><?php esc_html_e( 'Company', 'aistocklens-child' ); ?></h3>
                <ul class="asl-footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms of Use', 'aistocklens-child' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/disclaimer/' ) ); ?>"><?php esc_html_e( 'Disclaimer', 'aistocklens-child' ); ?></a></li>
                </ul>
            </div>

        </div><!-- /.asl-footer__grid -->

        <div class="asl-footer__bottom">
            <span>
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:rgba(255,255,255,.6)"><?php bloginfo( 'name' ); ?></a>.
                <?php esc_html_e( 'All rights reserved.', 'aistocklens-child' ); ?>
            </span>
            <span><?php esc_html_e( 'Made with ♥ for Indian Investors', 'aistocklens-child' ); ?></span>
        </div>

        <div class="asl-footer__disclaimer">
            <strong><?php esc_html_e( 'Disclaimer:', 'aistocklens-child' ); ?></strong>
            <?php esc_html_e( 'AI Stock Lens is an independent financial education platform. All calculators and content are for informational and educational purposes only. This is not investment advice. We are not SEBI registered. Mutual fund investments are subject to market risks. Please read all scheme-related documents carefully and consult a qualified financial advisor before investing.', 'aistocklens-child' ); ?>
        </div>

    </div><!-- /.asl-container -->
</footer>
