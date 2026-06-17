<?php
/**
 * Single Lesson Template
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();

the_post();

// Get all lessons in same category for sidebar nav
$current_terms = get_the_terms( get_the_ID(), 'lesson_category' );
$nav_lessons   = [];
if ( $current_terms && ! is_wp_error( $current_terms ) ) {
    $nav_lessons = get_posts( [
        'post_type'      => 'lesson',
        'posts_per_page' => -1,
        'tax_query'      => [[
            'taxonomy' => 'lesson_category',
            'field'    => 'term_id',
            'terms'    => wp_list_pluck( $current_terms, 'term_id' ),
        ]],
        'orderby' => 'menu_order title',
        'order'   => 'ASC',
    ] );
}

$prev_lesson = get_adjacent_post( false, '', true );
$next_lesson = get_adjacent_post( false, '', false );
?>

<div style="background:var(--color-bg-subtle);border-bottom:1px solid var(--color-border);padding-block:var(--space-5)">
    <div class="asl-container">
        <?php aslc_breadcrumbs(); ?>
    </div>
</div>

<div class="asl-section asl-section--sm">
    <div class="asl-container">
        <div class="asl-lesson-layout">

            <!-- Sidebar nav -->
            <?php if ( ! empty( $nav_lessons ) ) : ?>
            <nav class="asl-lesson-nav" aria-label="<?php esc_attr_e( 'Lesson navigation', 'aistocklens-child' ); ?>">
                <div class="asl-lesson-nav__title">
                    <?php
                    if ( $current_terms ) {
                        echo esc_html( $current_terms[0]->name );
                    } else {
                        esc_html_e( 'Lessons', 'aistocklens-child' );
                    }
                    ?>
                </div>
                <ul class="asl-lesson-nav__list">
                    <?php foreach ( $nav_lessons as $i => $lesson ) : ?>
                    <li class="asl-lesson-nav__item <?php echo ( $lesson->ID === get_the_ID() ) ? 'active' : ''; ?>">
                        <a href="<?php echo esc_url( get_permalink( $lesson->ID ) ); ?>">
                            <span style="width:22px;font-size:var(--text-xs);color:var(--color-text-light)"><?php echo esc_html( $i + 1 ); ?>.</span>
                            <?php echo esc_html( $lesson->post_title ); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <?php endif; ?>

            <!-- Content -->
            <article id="lesson-<?php the_ID(); ?>" class="asl-lesson-content" <?php post_class(); ?>>

                <!-- Lesson header -->
                <header class="asl-lesson-content__header" style="margin-bottom:var(--space-8)">
                    <?php
                    if ( $current_terms && ! is_wp_error( $current_terms ) ) :
                        foreach ( $current_terms as $term ) :
                    ?>
                    <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="asl-badge asl-badge--blue" style="margin-bottom:var(--space-3)">
                        <?php echo esc_html( $term->name ); ?>
                    </a>
                    <?php endforeach; endif; ?>

                    <h1 style="font-size:clamp(1.75rem,4vw,2.75rem);margin:var(--space-3) 0"><?php the_title(); ?></h1>

                    <div class="asl-article-card__meta">
                        <span><?php the_date(); ?></span>
                        <span>· <?php esc_html_e( 'by', 'aistocklens-child' ); ?> <?php the_author(); ?></span>
                        <span>· <?php echo esc_html( (int) ceil( str_word_count( get_the_content() ) / 200 ) ); ?> <?php esc_html_e( 'min read', 'aistocklens-child' ); ?></span>
                    </div>
                </header>

                <!-- AdSense - top of content -->
                <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>

                <!-- The lesson content -->
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <!-- AdSense - bottom of content -->
                <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>

                <!-- Lesson navigation (prev/next) -->
                <nav class="asl-lesson-pagination" aria-label="<?php esc_attr_e( 'Lesson navigation', 'aistocklens-child' ); ?>"
                     style="display:flex;justify-content:space-between;gap:var(--space-4);flex-wrap:wrap;margin-top:var(--space-10);padding-top:var(--space-6);border-top:1px solid var(--color-border)">
                    <?php if ( $prev_lesson ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $prev_lesson ) ); ?>" class="asl-btn asl-btn--outline">
                        ← <?php echo esc_html( get_the_title( $prev_lesson ) ); ?>
                    </a>
                    <?php endif; ?>
                    <?php if ( $next_lesson ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $next_lesson ) ); ?>" class="asl-btn asl-btn--primary" style="margin-left:auto">
                        <?php echo esc_html( get_the_title( $next_lesson ) ); ?> →
                    </a>
                    <?php endif; ?>
                </nav>

            </article>
        </div>
    </div>
</div>

<?php get_footer(); ?>
