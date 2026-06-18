<?php
/**
 * Archive: Guides
 * URL: /guides/
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();

$all_guide_topics = get_terms( [
    'taxonomy'   => 'guide_topic',
    'hide_empty' => true,
    'orderby'    => 'count',
    'order'      => 'DESC',
] );
?>

<div class="asl-learn-hero" style="background:linear-gradient(135deg,#00695C 0%,#00897B 100%)">
    <div class="asl-container">
        <?php aslc_breadcrumbs(); ?>
        <h1 style="margin-top:var(--space-4)"><?php esc_html_e( 'Investment Guides', 'aistocklens-child' ); ?></h1>
        <p style="color:rgba(255,255,255,.8);max-width:560px;margin-top:var(--space-3)">
            <?php esc_html_e( 'Deep-dive guides on mutual funds, stocks, tax planning, and personal finance for Indian investors.', 'aistocklens-child' ); ?>
        </p>
    </div>
</div>

<div class="asl-section">
    <div class="asl-container">

        <!-- Topic filter pills -->
        <?php if ( ! is_wp_error( $all_guide_topics ) && ! empty( $all_guide_topics ) ) : ?>
        <div style="display:flex;flex-wrap:wrap;gap:var(--space-3);margin-bottom:var(--space-8)">
            <?php foreach ( $all_guide_topics as $topic ) : ?>
            <a href="<?php echo esc_url( get_term_link( $topic ) ); ?>" class="asl-btn asl-btn--outline" style="font-size:.875rem">
                <?php echo esc_html( $topic->name ); ?>
                <span style="margin-left:var(--space-2);opacity:.6;font-size:.8em"><?php echo esc_html( $topic->count ); ?></span>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>

        <?php if ( have_posts() ) : ?>
        <div class="asl-grid asl-grid--3">
            <?php while ( have_posts() ) : the_post();
                $card_topics = get_the_terms( get_the_ID(), 'guide_topic' );
            ?>
            <article class="asl-article-card" <?php post_class(); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'asl-card', [ 'class' => 'asl-article-card__img', 'loading' => 'lazy' ] ); ?>
                </a>
                <?php else : ?>
                <div class="asl-article-card__img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;min-height:160px;background:var(--color-bg-subtle)">📘</div>
                <?php endif; ?>
                <div class="asl-article-card__body">
                    <?php if ( ! is_wp_error( $card_topics ) && ! empty( $card_topics ) ) : ?>
                    <a href="<?php echo esc_url( get_term_link( $card_topics[0] ) ); ?>" class="asl-article-card__cat">
                        <?php echo esc_html( $card_topics[0]->name ); ?>
                    </a>
                    <?php else : ?>
                    <span class="asl-article-card__cat"><?php esc_html_e( 'Guide', 'aistocklens-child' ); ?></span>
                    <?php endif; ?>
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
        <p class="text-center text-muted"><?php esc_html_e( 'Guides coming soon!', 'aistocklens-child' ); ?></p>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
