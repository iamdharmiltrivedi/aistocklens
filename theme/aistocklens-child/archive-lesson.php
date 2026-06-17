<?php
/**
 * Archive: Lessons
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="asl-learn-hero">
    <div class="asl-container">
        <?php aslc_breadcrumbs(); ?>
        <h1 style="margin-top:var(--space-4)"><?php post_type_archive_title(); ?></h1>
        <?php if ( get_the_archive_description() ) : ?>
        <div class="archive-description" style="color:rgba(255,255,255,.8)">
            <?php the_archive_description(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="asl-section">
    <div class="asl-container">
        <?php if ( have_posts() ) : ?>
        <div class="asl-grid asl-grid--3">
            <?php while ( have_posts() ) : the_post(); ?>
            <article id="lesson-<?php the_ID(); ?>" class="asl-module-card">
                <div class="asl-module-card__header">
                    <div class="asl-card__icon" style="background:var(--color-bg-subtle)">📖</div>
                    <div>
                        <h2 class="asl-card__title" style="font-size:var(--text-base)">
                            <a href="<?php the_permalink(); ?>" style="color:inherit"><?php the_title(); ?></a>
                        </h2>
                        <?php
                        $terms = get_the_terms( get_the_ID(), 'lesson_category' );
                        if ( $terms && ! is_wp_error( $terms ) ) :
                        ?>
                        <span class="asl-badge asl-badge--blue" style="margin-top:var(--space-1)"><?php echo esc_html( $terms[0]->name ); ?></span>
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
            <?php endwhile; ?>
        </div>
        <?php aslc_pagination(); ?>
        <?php else : ?>
        <p class="text-center text-muted"><?php esc_html_e( 'No lessons published yet.', 'aistocklens-child' ); ?></p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
