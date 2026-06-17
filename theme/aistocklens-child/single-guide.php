<?php
/**
 * Single Guide Template
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
            <article id="guide-<?php the_ID(); ?>" class="asl-lesson-content" <?php post_class(); ?>>

                <header style="margin-bottom:var(--space-8)">
                    <span class="asl-badge asl-badge--green" style="margin-bottom:var(--space-3)"><?php esc_html_e( 'Guide', 'aistocklens-child' ); ?></span>
                    <h1 style="font-size:clamp(1.75rem,4vw,2.75rem);margin:var(--space-3) 0"><?php the_title(); ?></h1>
                    <div class="asl-article-card__meta">
                        <span><?php the_date(); ?></span>
                        <span>· <?php the_author(); ?></span>
                        <span>· <?php echo esc_html( (int) ceil( str_word_count( get_the_content() ) / 200 ) ); ?> min read</span>
                    </div>
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div style="margin-top:var(--space-6)">
                        <?php the_post_thumbnail( 'asl-hero', [ 'style' => 'width:100%;border-radius:var(--radius-xl);max-height:440px;object-fit:cover' ] ); ?>
                    </div>
                    <?php endif; ?>
                </header>

                <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>

                <div style="margin-top:var(--space-10);padding-top:var(--space-6);border-top:1px solid var(--color-border);display:flex;justify-content:space-between;flex-wrap:wrap;gap:var(--space-4)">
                    <?php
                    $prev = get_adjacent_post( false, '', true );
                    $next = get_adjacent_post( false, '', false );
                    if ( $prev ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="asl-btn asl-btn--outline">← <?php echo esc_html( get_the_title( $prev ) ); ?></a>
                    <?php endif; if ( $next ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="asl-btn asl-btn--primary" style="margin-left:auto"><?php echo esc_html( get_the_title( $next ) ); ?> →</a>
                    <?php endif; ?>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="asl-sidebar">
                <div class="asl-ad-slot" style="min-height:250px;margin:0 0 var(--space-6)" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>
                <div class="asl-sidebar__widget">
                    <h3 class="asl-sidebar__widget-title"><?php esc_html_e( 'More Guides', 'aistocklens-child' ); ?></h3>
                    <?php
                    $related = new WP_Query( [
                        'post_type'      => 'guide',
                        'posts_per_page' => 5,
                        'post__not_in'   => [ get_the_ID() ],
                        'orderby'        => 'rand',
                    ] );
                    if ( $related->have_posts() ) :
                    ?>
                    <ul class="asl-footer__links">
                        <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" style="color:var(--color-text-muted)">
                                📘 <?php the_title(); ?>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <?php if ( is_active_sidebar( 'asl-learn-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'asl-learn-sidebar' ); ?>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>
