<?php
/**
 * Archive: Calculators
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="asl-learn-hero" style="background:linear-gradient(135deg,#1565C0 0%,#0D47A1 100%)">
    <div class="asl-container">
        <?php aslc_breadcrumbs(); ?>
        <h1 style="margin-top:var(--space-4)"><?php esc_html_e( 'Free Financial Calculators', 'aistocklens-child' ); ?></h1>
        <p style="color:rgba(255,255,255,.8);max-width:560px;margin-top:var(--space-3)">
            <?php esc_html_e( 'SIP, EMI, FD, CAGR and more — all free, instant, no signup required.', 'aistocklens-child' ); ?>
        </p>
    </div>
</div>

<div class="asl-section">
    <div class="asl-container">
        <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>
        <?php if ( have_posts() ) : ?>
        <div class="asl-grid asl-grid--4">
            <?php while ( have_posts() ) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="asl-calc-card">
                <div class="asl-calc-card__icon" style="background:var(--color-bg-subtle)">🧮</div>
                <div class="asl-calc-card__title"><?php the_title(); ?></div>
                <p class="asl-calc-card__desc"><?php the_excerpt(); ?></p>
                <span class="asl-calc-card__link"><?php esc_html_e( 'Open Calculator', 'aistocklens-child' ); ?> →</span>
            </a>
            <?php endwhile; ?>
        </div>
        <?php aslc_pagination(); ?>
        <?php else : ?>
        <p class="text-center text-muted"><?php esc_html_e( 'Calculators coming soon!', 'aistocklens-child' ); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
