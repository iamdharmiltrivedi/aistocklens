<?php
/**
 * Single Calculator Page Template
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();
?>

<div style="background:var(--color-bg-subtle);border-bottom:1px solid var(--color-border);padding-block:var(--space-5)">
    <div class="asl-container">
        <?php aslc_breadcrumbs(); ?>
    </div>
</div>

<div class="asl-section asl-section--sm">
    <div class="asl-container">
        <div class="asl-blog-layout">
            <main>
                <h1 style="margin-bottom:var(--space-2)"><?php the_title(); ?></h1>
                <p style="color:var(--color-text-muted);margin-bottom:var(--space-8)"><?php the_excerpt(); ?></p>

                <!-- The shortcode content (calculator) -->
                <div class="asl-calc-wrapper">
                    <?php the_content(); ?>
                </div>

                <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>
            </main>

            <aside class="asl-sidebar">
                <div class="asl-ad-slot" style="min-height:250px;margin:0 0 var(--space-6)" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>
                <div class="asl-sidebar__widget">
                    <h3 class="asl-sidebar__widget-title"><?php esc_html_e( 'Other Calculators', 'aistocklens-child' ); ?></h3>
                    <ul class="asl-footer__links">
                        <li><a href="<?php echo esc_url( home_url( '/calculators/sip-calculator/' ) ); ?>">💰 SIP Calculator</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/calculators/emi-calculator/' ) ); ?>">🏦 EMI Calculator</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/calculators/fd-calculator/' ) ); ?>">🏧 FD Calculator</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/calculators/cagr-calculator/' ) ); ?>">📈 CAGR Calculator</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/calculators/ppf-calculator/' ) ); ?>">🏛️ PPF Calculator</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/calculators/nps-calculator/' ) ); ?>">👴 NPS Calculator</a></li>
                    </ul>
                </div>
                <?php if ( is_active_sidebar( 'asl-calc-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'asl-calc-sidebar' ); ?>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>
