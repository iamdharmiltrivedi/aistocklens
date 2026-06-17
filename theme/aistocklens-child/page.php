<?php
/**
 * Default Page Template
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="asl-page-header" style="background:var(--color-bg-subtle);border-bottom:1px solid var(--color-border);padding-block:var(--space-8)">
    <div class="asl-container">
        <?php aslc_breadcrumbs(); ?>
        <h1 style="margin:0"><?php the_title(); ?></h1>
    </div>
</div>

<div class="asl-section asl-section--sm">
    <div class="asl-container">
        <div class="asl-blog-layout">
            <main id="main" class="asl-main-content">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'asl-page-content' ); ?>>
                    <div class="entry-content" style="max-width:var(--container-narrow)">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php endwhile; endif; ?>
            </main>

            <aside class="asl-sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'aistocklens-child' ); ?>">
                <div class="asl-sidebar__widget">
                    <h3 class="asl-sidebar__widget-title"><?php esc_html_e( 'Quick Links', 'aistocklens-child' ); ?></h3>
                    <ul class="asl-footer__links">
                        <li><a href="<?php echo esc_url( home_url( '/calculators/' ) ); ?>">🧮 <?php esc_html_e( 'All Calculators', 'aistocklens-child' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/learn/' ) ); ?>">📚 <?php esc_html_e( 'Learn Investing', 'aistocklens-child' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/guides/' ) ); ?>">📘 <?php esc_html_e( 'Guides', 'aistocklens-child' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">📰 <?php esc_html_e( 'Blog', 'aistocklens-child' ); ?></a></li>
                    </ul>
                </div>
                <?php if ( is_active_sidebar( 'asl-blog-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'asl-blog-sidebar' ); ?>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>
