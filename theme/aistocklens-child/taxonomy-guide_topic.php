<?php
/**
 * Taxonomy Archive: Guide Topics
 * URL: /guides/{topic-slug}/
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();

$current_term       = get_queried_object();
$guides_archive_url = get_post_type_archive_link( 'guide' );
?>

<!-- Hero -->
<div class="asl-learn-hero" style="background:linear-gradient(135deg,#1565C0 0%,#1976D2 100%)">
    <div class="asl-container">

        <nav class="asl-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'aistocklens-child' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'aistocklens-child' ); ?></a>
            <span class="asl-breadcrumb__sep" aria-hidden="true">›</span>
            <a href="<?php echo esc_url( $guides_archive_url ); ?>"><?php esc_html_e( 'Guides', 'aistocklens-child' ); ?></a>
            <span class="asl-breadcrumb__sep" aria-hidden="true">›</span>
            <span aria-current="page"><?php echo esc_html( $current_term->name ); ?></span>
        </nav>

        <h1 style="margin-top:var(--space-4)"><?php echo esc_html( $current_term->name ); ?></h1>

        <p style="color:rgba(255,255,255,.8);max-width:560px;margin-top:var(--space-3)">
            <?php
            if ( ! empty( $current_term->description ) ) {
                echo esc_html( $current_term->description );
            } else {
                printf(
                    /* translators: %1$d: count, %2$s: topic name */
                    esc_html__( '%1$d guides on %2$s for Indian investors.', 'aistocklens-child' ),
                    (int) $current_term->count,
                    esc_html( $current_term->name )
                );
            }
            ?>
        </p>

        <div style="margin-top:var(--space-4)">
            <span style="display:inline-block;background:rgba(255,255,255,.2);color:#fff;font-size:.875rem;padding:.375rem 1rem;border-radius:9999px;font-weight:500">
                <?php printf(
                    esc_html( _n( '%d Guide', '%d Guides', $current_term->count, 'aistocklens-child' ) ),
                    (int) $current_term->count
                ); ?>
            </span>
        </div>

    </div>
</div>

<!-- Guide grid -->
<div class="asl-section">
    <div class="asl-container">

        <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>

        <?php if ( have_posts() ) : ?>
        <div class="asl-grid asl-grid--3">
            <?php while ( have_posts() ) : the_post(); ?>
            <article class="asl-article-card" <?php post_class(); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'asl-card', [ 'class' => 'asl-article-card__img', 'loading' => 'lazy' ] ); ?>
                </a>
                <?php else : ?>
                <div class="asl-article-card__img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;min-height:160px;background:var(--color-bg-subtle)">📘</div>
                <?php endif; ?>
                <div class="asl-article-card__body">
                    <span class="asl-article-card__cat"><?php echo esc_html( $current_term->name ); ?></span>
                    <h2 class="asl-article-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="asl-article-card__excerpt"><?php the_excerpt(); ?></p>
                    <div class="asl-article-card__meta">
                        <span><?php the_date(); ?></span>
                        <span>· <?php echo esc_html( (int) ceil( str_word_count( get_the_content() ) / 200 ) ); ?> min read</span>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <?php aslc_pagination(); ?>

        <?php else : ?>
        <p class="text-center text-muted">
            <?php esc_html_e( 'No guides in this topic yet. Check back soon!', 'aistocklens-child' ); ?>
        </p>
        <?php endif; ?>

        <!-- Other topics -->
        <?php
        $other_topics = get_terms( [
            'taxonomy'   => 'guide_topic',
            'hide_empty' => true,
            'exclude'    => [ $current_term->term_id ],
        ] );
        if ( ! is_wp_error( $other_topics ) && ! empty( $other_topics ) ) :
        ?>
        <div style="margin-top:var(--space-16);padding-top:var(--space-10);border-top:1px solid var(--color-border)">
            <h2 style="font-size:1.25rem;font-weight:600;margin-bottom:var(--space-5)">
                <?php esc_html_e( 'Explore Other Topics', 'aistocklens-child' ); ?>
            </h2>
            <div style="display:flex;flex-wrap:wrap;gap:var(--space-3)">
                <?php foreach ( $other_topics as $other_topic ) : ?>
                <a href="<?php echo esc_url( get_term_link( $other_topic ) ); ?>" class="asl-btn asl-btn--outline" style="font-size:.875rem">
                    <?php echo esc_html( $other_topic->name ); ?>
                    <span style="margin-left:var(--space-2);opacity:.6"><?php echo esc_html( $other_topic->count ); ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
