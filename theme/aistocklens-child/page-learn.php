<?php
/**
 * Template Name: Learn Hub
 * Template Post Type: page
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<!-- Learn Hero -->
<section class="asl-learn-hero">
    <div class="asl-container" style="text-align:center">
        <?php aslc_breadcrumbs(); ?>
        <h1><?php esc_html_e( 'Learn Investing — Free Courses', 'aistocklens-child' ); ?></h1>
        <p style="font-size:var(--text-lg);color:rgba(255,255,255,.8);max-width:580px;margin-inline:auto;margin-top:var(--space-4)">
            <?php esc_html_e( 'Structured learning paths to help you understand mutual funds, stocks, and personal finance — from scratch.', 'aistocklens-child' ); ?>
        </p>
    </div>
</section>

<div class="asl-section">
    <div class="asl-container">

        <!-- AdSense -->
        <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>

        <!-- Path selection -->
        <?php aslc_section_head( __( 'Choose Your Path', 'aistocklens-child' ), __( 'Learning Paths', 'aistocklens-child' ) ); ?>
        <div class="asl-grid asl-grid--2" style="margin-bottom:var(--space-16)">

            <!-- Mutual Funds -->
            <a href="<?php echo esc_url( home_url( '/learn/mutual-funds/' ) ); ?>" class="asl-path-card" style="text-decoration:none;color:inherit">
                <div class="asl-path-card__header">
                    <span class="asl-path-card__icon">💼</span>
                    <h2 class="asl-path-card__title"><?php esc_html_e( 'Mutual Fund Academy', 'aistocklens-child' ); ?></h2>
                    <p class="asl-path-card__subtitle"><?php esc_html_e( '6 lessons · ~30 min total', 'aistocklens-child' ); ?></p>
                </div>
                <div style="padding:var(--space-6)">
                    <p style="color:var(--color-text-muted);font-size:var(--text-sm)">
                        <?php esc_html_e( 'Master mutual fund investing: understand NAV, expense ratios, SIP mechanics, and how to build a diversified portfolio.', 'aistocklens-child' ); ?>
                    </p>
                    <span class="asl-btn asl-btn--primary" style="margin-top:var(--space-4)">
                        <?php esc_html_e( 'Start Learning →', 'aistocklens-child' ); ?>
                    </span>
                </div>
            </a>

            <!-- Stock Market -->
            <a href="<?php echo esc_url( home_url( '/learn/stocks/' ) ); ?>" class="asl-path-card" style="text-decoration:none;color:inherit">
                <div class="asl-path-card__header asl-path-card__header--green">
                    <span class="asl-path-card__icon">📊</span>
                    <h2 class="asl-path-card__title"><?php esc_html_e( 'Stock Market Academy', 'aistocklens-child' ); ?></h2>
                    <p class="asl-path-card__subtitle"><?php esc_html_e( '6 lessons · ~40 min total', 'aistocklens-child' ); ?></p>
                </div>
                <div style="padding:var(--space-6)">
                    <p style="color:var(--color-text-muted);font-size:var(--text-sm)">
                        <?php esc_html_e( 'Understand stocks from scratch: open a demat account, read financial ratios, and apply fundamental analysis to pick stocks.', 'aistocklens-child' ); ?>
                    </p>
                    <span class="asl-btn asl-btn--accent" style="margin-top:var(--space-4)">
                        <?php esc_html_e( 'Start Learning →', 'aistocklens-child' ); ?>
                    </span>
                </div>
            </a>
        </div>

        <!-- All Lessons (CPT query) -->
        <?php aslc_section_head( __( 'All Lessons', 'aistocklens-child' ), __( 'Browse Individual Lessons', 'aistocklens-child' ) ); ?>

        <?php
        $lessons_q = new WP_Query( [
            'post_type'      => 'lesson',
            'posts_per_page' => 12,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
        ] );

        if ( $lessons_q->have_posts() ) :
        ?>
        <div class="asl-grid asl-grid--3">
            <?php while ( $lessons_q->have_posts() ) : $lessons_q->the_post(); ?>
            <article class="asl-module-card">
                <div class="asl-module-card__header">
                    <div class="asl-card__icon" style="background:var(--color-bg-subtle)">📖</div>
                    <div>
                        <h3 class="asl-card__title" style="font-size:var(--text-base)"><?php the_title(); ?></h3>
                        <?php
                        $terms = get_the_terms( get_the_ID(), 'lesson_category' );
                        if ( $terms && ! is_wp_error( $terms ) ) :
                        ?>
                        <span class="asl-badge asl-badge--blue"><?php echo esc_html( $terms[0]->name ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div style="padding:var(--space-4) var(--space-6)">
                    <p class="asl-card__desc"><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="asl-btn asl-btn--outline" style="margin-top:var(--space-4);font-size:var(--text-sm);padding:var(--space-2) var(--space-4)">
                        <?php esc_html_e( 'Read Lesson', 'aistocklens-child' ); ?> →
                    </a>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <p class="text-center text-muted"><?php esc_html_e( 'Lessons coming soon. Check back shortly!', 'aistocklens-child' ); ?></p>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
