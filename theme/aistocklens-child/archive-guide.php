<?php
/**
 * Archive: Guides — Topic Index
 * URL: /guides/
 *
 * Bypasses the standard WP loop and renders all guide_topic terms as cards.
 * Individual topic archives are handled by taxonomy-guide_topic.php.
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();

$guide_topics = get_terms( [
    'taxonomy'   => 'guide_topic',
    'hide_empty' => true,
    'orderby'    => 'count',
    'order'      => 'DESC',
] );

$total_guides = ( ! is_wp_error( $guide_topics ) && ! empty( $guide_topics ) )
    ? array_sum( array_column( (array) $guide_topics, 'count' ) )
    : 0;
?>

<!-- ── Hero ────────────────────────────────────────────────────────────── -->
<div class="asl-learn-hero" style="background:linear-gradient(135deg,#00695C 0%,#00897B 100%)">
    <div class="asl-container">

        <nav class="asl-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'aistocklens-child' ); ?>">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'aistocklens-child' ); ?></a>
            <span class="asl-breadcrumb__sep" aria-hidden="true">›</span>
            <span aria-current="page"><?php esc_html_e( 'Guides', 'aistocklens-child' ); ?></span>
        </nav>

        <h1 style="margin-top:var(--space-4)"><?php esc_html_e( 'Investment Guides', 'aistocklens-child' ); ?></h1>

        <p style="margin-top:var(--space-3)">
            <?php esc_html_e( 'Deep-dive guides on mutual funds, stocks, tax planning, and personal finance — written for Indian investors.', 'aistocklens-child' ); ?>
        </p>

        <?php if ( $total_guides > 0 ) : ?>
        <div style="display:flex;flex-wrap:wrap;gap:var(--space-4);margin-top:var(--space-6)">
            <span style="display:inline-flex;align-items:center;gap:var(--space-2);background:rgba(255,255,255,.2);color:#fff;font-size:var(--text-sm);font-weight:600;padding:.375rem 1rem;border-radius:var(--radius-full)">
                📚 <?php printf(
                    esc_html( _n( '%d Guide', '%d Guides', $total_guides, 'aistocklens-child' ) ),
                    (int) $total_guides
                ); ?>
            </span>
            <?php if ( ! is_wp_error( $guide_topics ) ) : ?>
            <span style="display:inline-flex;align-items:center;gap:var(--space-2);background:rgba(255,255,255,.2);color:#fff;font-size:var(--text-sm);font-weight:600;padding:.375rem 1rem;border-radius:var(--radius-full)">
                🏷️ <?php printf(
                    esc_html( _n( '%d Topic', '%d Topics', count( $guide_topics ), 'aistocklens-child' ) ),
                    count( $guide_topics )
                ); ?>
            </span>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>
</div>

<!-- ── Topic Cards ──────────────────────────────────────────────────────── -->
<div class="asl-section">
    <div class="asl-container">

        <?php aslt_render_ad( 'page_top_2' ); // below page heading ?>

        <?php if ( ! is_wp_error( $guide_topics ) && ! empty( $guide_topics ) ) :
            $idx      = 0;
            $ad_every = 4; // inject a Middle ad after every N topic cards
        ?>

        <div class="asl-grid asl-grid--2">
            <?php foreach ( $guide_topics as $topic ) :
                $is_even      = ( $idx % 2 === 0 );
                $header_class = $is_even ? '' : 'asl-path-card__header--green';
                $btn_class    = $is_even ? 'asl-btn--primary' : 'asl-btn--accent';
                $idx++;

                $preview = new WP_Query( [
                    'post_type'      => 'guide',
                    'posts_per_page' => 6,
                    'post_status'    => 'publish',
                    'tax_query'      => [ [
                        'taxonomy' => 'guide_topic',
                        'field'    => 'term_id',
                        'terms'    => $topic->term_id,
                    ] ],
                    'orderby'        => 'menu_order date',
                    'order'          => 'ASC',
                    'no_found_rows'  => true,
                ] );
            ?>
            <div class="asl-path-card">

                <!-- Card header: topic name + count (+ optional description) -->
                <div class="asl-path-card__header <?php echo esc_attr( $header_class ); ?>">
                    <h2 class="asl-path-card__title">
                        <a href="<?php echo esc_url( get_term_link( $topic ) ); ?>"
                           style="color:inherit;text-decoration:none">
                            <?php echo esc_html( $topic->name ); ?>
                        </a>
                    </h2>
                    <p class="asl-path-card__subtitle">
                        <?php printf(
                            esc_html( _n( '%d Guide', '%d Guides', $topic->count, 'aistocklens-child' ) ),
                            (int) $topic->count
                        ); ?>
                        <?php if ( ! empty( $topic->description ) ) : ?>
                        &nbsp;·&nbsp; <?php echo esc_html( wp_trim_words( $topic->description, 12, '…' ) ); ?>
                        <?php endif; ?>
                    </p>
                </div>

                <!-- Guide list preview -->
                <?php if ( $preview->have_posts() ) : ?>
                <ul class="asl-path-card__lessons">
                    <?php $num = 1; while ( $preview->have_posts() ) : $preview->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="asl-path-card__lesson">
                            <span class="asl-path-card__lesson-num"><?php echo esc_html( $num++ ); ?></span>
                            <?php the_title(); ?>
                        </a>
                    </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
                <?php endif; ?>

                <!-- CTA -->
                <div class="asl-path-card__footer">
                    <a href="<?php echo esc_url( get_term_link( $topic ) ); ?>"
                       class="asl-btn <?php echo esc_attr( $btn_class ); ?>"
                       style="width:100%;justify-content:center">
                        <?php
                        /* translators: %s: topic name */
                        printf( esc_html__( 'View All %s Guides', 'aistocklens-child' ), esc_html( $topic->name ) );
                        ?> →
                    </a>
                </div>

            </div><!-- /.asl-path-card -->

            <?php
            // Inject a full-width Middle ad after every 4th card (while more cards remain)
            if ( $idx % $ad_every === 0 && $idx < count( $guide_topics ) ) :
            ?>
            <div class="aslt-ad-in-grid">
                <?php aslt_render_ad( 'middle' ); ?>
            </div>
            <?php endif; ?>

            <?php endforeach; ?>
        </div><!-- /.asl-grid -->

        <?php else : ?>

        <div style="text-align:center;padding:var(--space-20) 0">
            <p style="font-size:var(--text-lg);color:var(--color-text-muted)">
                <?php esc_html_e( 'No guides published yet. Check back soon!', 'aistocklens-child' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="asl-btn asl-btn--primary" style="margin-top:var(--space-6)">
                <?php esc_html_e( '← Back to Home', 'aistocklens-child' ); ?>
            </a>
        </div>

        <?php endif; ?>

        <?php aslt_render_ad( 'footer' ); // footer ad, inside container ?>

    </div>
</div>

<?php get_footer(); ?>
