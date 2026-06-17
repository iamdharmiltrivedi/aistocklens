<?php
/**
 * Archive: Guides
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();
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
        <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>"></div>
        <?php if ( have_posts() ) : ?>
        <div class="asl-grid asl-grid--3">
            <?php while ( have_posts() ) : the_post(); ?>
            <article class="asl-article-card">
                <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'asl-card', [ 'class' => 'asl-article-card__img', 'loading' => 'lazy' ] ); ?>
                </a>
                <?php endif; ?>
                <div class="asl-article-card__body">
                    <span class="asl-article-card__cat"><?php esc_html_e( 'Guide', 'aistocklens-child' ); ?></span>
                    <h2 class="asl-article-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
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
