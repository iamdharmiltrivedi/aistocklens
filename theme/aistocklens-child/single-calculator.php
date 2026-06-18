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
                <p style="color:var(--color-text-muted);margin-bottom:var(--space-4)"><?php the_excerpt(); ?></p>

                <?php aslt_render_ad( 'page_top_1' ); // below calculator title ?>

                <!-- The shortcode content (calculator) -->
                <div class="asl-calc-wrapper">
                    <?php the_content(); ?>
                </div>

                <?php aslt_render_ad( 'middle' ); // below calculator results ?>
            </main>

            <aside class="asl-sidebar">
                <?php aslt_render_ad( 'right_sidebar' ); ?>
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

<!-- Ad: Footer -->
<div class="asl-container">
    <?php aslt_render_ad( 'footer' ); ?>
</div>

<?php get_footer(); ?>
