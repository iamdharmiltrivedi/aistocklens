<?php
/**
 * Single Guide Template
 * URL: /guides/{topic-slug}/{guide-slug}/
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();
the_post();

$guide_id     = get_the_ID();
$guide_topics = get_the_terms( $guide_id, 'guide_topic' );
$has_topic    = ! is_wp_error( $guide_topics ) && ! empty( $guide_topics );
$first_topic  = $has_topic ? $guide_topics[0] : null;
?>

<!-- Breadcrumbs -->
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

                    <!-- Topic badge(s) -->
                    <?php if ( $has_topic ) : ?>
                    <div style="display:flex;flex-wrap:wrap;gap:var(--space-2);margin-bottom:var(--space-3)">
                        <?php foreach ( $guide_topics as $gt ) : ?>
                        <a href="<?php echo esc_url( get_term_link( $gt ) ); ?>" class="asl-badge asl-badge--green" style="text-decoration:none">
                            <?php echo esc_html( $gt->name ); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php else : ?>
                    <span class="asl-badge asl-badge--green" style="margin-bottom:var(--space-3)">
                        <?php esc_html_e( 'Guide', 'aistocklens-child' ); ?>
                    </span>
                    <?php endif; ?>

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

                <?php aslt_render_ad( 'page_top_1' ); // below title, above content ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <?php aslt_render_ad( 'middle' ); // after content body ?>

                <!-- Prev / Next within same topic -->
                <div style="margin-top:var(--space-10);padding-top:var(--space-6);border-top:1px solid var(--color-border);display:flex;justify-content:space-between;flex-wrap:wrap;gap:var(--space-4)">
                    <?php
                    $prev = get_adjacent_post( true, '', true,  'guide_topic' );
                    $next = get_adjacent_post( true, '', false, 'guide_topic' );
                    if ( $prev ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="asl-btn asl-btn--outline">
                        ← <?php echo esc_html( get_the_title( $prev ) ); ?>
                    </a>
                    <?php endif; if ( $next ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="asl-btn asl-btn--primary" style="margin-left:auto">
                        <?php echo esc_html( get_the_title( $next ) ); ?> →
                    </a>
                    <?php endif; ?>
                </div>

            </article>

            <!-- Sidebar -->
            <aside class="asl-sidebar">

                <?php aslt_render_ad( 'right_sidebar' ); ?>

                <div class="asl-sidebar__widget">

                    <h3 class="asl-sidebar__widget-title">
                        <?php if ( $has_topic ) :
                            /* translators: %s: topic name */
                            printf( esc_html__( 'More in %s', 'aistocklens-child' ), esc_html( $first_topic->name ) );
                        else :
                            esc_html_e( 'More Guides', 'aistocklens-child' );
                        endif; ?>
                    </h3>

                    <?php
                    $related_args = [
                        'post_type'      => 'guide',
                        'posts_per_page' => 5,
                        'post__not_in'   => [ $guide_id ],
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'no_found_rows'  => true,
                    ];
                    if ( $has_topic ) {
                        $related_args['tax_query'] = [ [
                            'taxonomy' => 'guide_topic',
                            'field'    => 'term_id',
                            'terms'    => wp_list_pluck( $guide_topics, 'term_id' ),
                        ] ];
                    }
                    $related = new WP_Query( $related_args );
                    ?>

                    <?php if ( $related->have_posts() ) : ?>
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

                    <?php if ( $has_topic ) : ?>
                    <a href="<?php echo esc_url( get_term_link( $first_topic ) ); ?>"
                       class="asl-btn asl-btn--outline"
                       style="display:flex;width:100%;margin-top:var(--space-4);justify-content:center;font-size:.875rem;text-align:center">
                        <?php
                        /* translators: %s: topic name */
                        printf( esc_html__( 'All %s Guides', 'aistocklens-child' ), esc_html( $first_topic->name ) );
                        ?> →
                    </a>
                    <?php endif; ?>

                </div>

                <?php if ( is_active_sidebar( 'asl-learn-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'asl-learn-sidebar' ); ?>
                <?php endif; ?>

            </aside>

        </div>
    </div>
</div>

<!-- Ad: Footer — after article -->
<div class="asl-container">
    <?php aslt_render_ad( 'footer' ); ?>
</div>

<?php get_footer(); ?>
