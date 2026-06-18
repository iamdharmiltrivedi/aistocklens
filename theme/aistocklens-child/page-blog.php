<?php
/**
 * Template Name: Blog Archive
 * Template Post Type: page
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();

$paged    = max( 1, get_query_var( 'paged' ) );
$cat_slug = get_query_var( 'category_name', '' );

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'post_status'    => 'publish',
];

if ( $cat_slug ) {
    $args['category_name'] = sanitize_text_field( $cat_slug );
}

$blog_query = new WP_Query( $args );
?>

<div class="asl-page-header" style="background:var(--color-bg-subtle);border-bottom:1px solid var(--color-border);padding-block:var(--space-8)">
    <div class="asl-container">
        <?php aslc_breadcrumbs(); ?>
        <h1 style="margin-top:var(--space-2)"><?php esc_html_e( 'Blog — Investing Insights', 'aistocklens-child' ); ?></h1>
        <p style="color:var(--color-text-muted);margin:var(--space-2) 0 0">
            <?php esc_html_e( 'Practical articles on mutual funds, stocks, and personal finance for Indian investors.', 'aistocklens-child' ); ?>
        </p>
    </div>
</div>

<div class="asl-section asl-section--sm">
    <div class="asl-container">
        <div class="asl-blog-layout">

            <!-- Main -->
            <main id="main">

                <?php aslt_render_ad( 'page_top_2' ); // below page heading ?>

                <!-- Category filter tabs -->
                <div style="display:flex;flex-wrap:wrap;gap:var(--space-2);margin-bottom:var(--space-8)">
                    <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="asl-badge asl-badge--blue" style="padding:var(--space-2) var(--space-4);font-size:var(--text-sm)">
                        <?php esc_html_e( 'All', 'aistocklens-child' ); ?>
                    </a>
                    <?php
                    $cats = get_categories( [ 'hide_empty' => true, 'number' => 10 ] );
                    foreach ( $cats as $cat ) :
                    ?>
                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="asl-badge" style="background:var(--color-bg-subtle);color:var(--color-text-muted);padding:var(--space-2) var(--space-4);font-size:var(--text-sm)">
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                    <?php endforeach; ?>
                </div>

                <?php if ( $blog_query->have_posts() ) : ?>
                <div class="asl-grid asl-grid--2" style="--asl-col-min:280px">
                    <?php
                    $blog_post_count = 0;
                    while ( $blog_query->have_posts() ) : $blog_query->the_post();
                        $blog_post_count++;
                    ?>
                    <article class="asl-article-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'asl-card', [ 'class' => 'asl-article-card__img', 'loading' => 'lazy' ] ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="asl-article-card__body">
                            <?php
                            $cats = get_the_category();
                            if ( ! empty( $cats ) ) :
                            ?>
                            <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>" class="asl-article-card__cat">
                                <?php echo esc_html( $cats[0]->name ); ?>
                            </a>
                            <?php endif; ?>
                            <h2 class="asl-article-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="asl-article-card__excerpt"><?php the_excerpt(); ?></p>
                            <div class="asl-article-card__meta">
                                <span><?php the_date(); ?></span>
                                <span>· <?php echo esc_html( get_the_author() ); ?></span>
                                <span>· <?php echo esc_html( (int) ceil( str_word_count( get_the_content() ) / 200 ) ); ?> min read</span>
                            </div>
                        </div>
                    </article>
                    <?php if ( $blog_post_count % 5 === 0 && $blog_query->have_posts() ) : ?>
                    <div class="aslt-ad-in-grid">
                        <?php aslt_render_ad( 'middle' ); ?>
                    </div>
                    <?php endif; ?>
                    <?php endwhile; ?>
                </div>

                <?php
                $GLOBALS['wp_query'] = $blog_query;
                aslc_pagination();
                wp_reset_postdata();
                ?>

                <?php else : ?>
                <p class="text-center text-muted" style="padding:var(--space-16) 0">
                    <?php esc_html_e( 'No posts found. Come back soon!', 'aistocklens-child' ); ?>
                </p>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside class="asl-sidebar" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'aistocklens-child' ); ?>">

                <!-- Search -->
                <div class="asl-sidebar__widget">
                    <h3 class="asl-sidebar__widget-title"><?php esc_html_e( 'Search', 'aistocklens-child' ); ?></h3>
                    <?php get_search_form(); ?>
                </div>

                <!-- Ad slot -->
                <?php aslt_render_ad( 'right_sidebar' ); ?>

                <!-- Categories -->
                <div class="asl-sidebar__widget">
                    <h3 class="asl-sidebar__widget-title"><?php esc_html_e( 'Categories', 'aistocklens-child' ); ?></h3>
                    <ul class="asl-footer__links">
                        <?php
                        wp_list_categories( [
                            'title_li'   => '',
                            'show_count' => true,
                            'hide_empty' => true,
                        ] );
                        ?>
                    </ul>
                </div>

                <!-- Popular calculators widget -->
                <div class="asl-sidebar__widget">
                    <h3 class="asl-sidebar__widget-title"><?php esc_html_e( 'Popular Calculators', 'aistocklens-child' ); ?></h3>
                    <ul class="asl-footer__links">
                        <li><a href="<?php echo esc_url( home_url( '/sip-calculator/' ) ); ?>">💰 SIP Calculator</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/emi-calculator/' ) ); ?>">🏦 EMI Calculator</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/fd-calculator/' ) ); ?>">🏧 FD Calculator</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/rd-calculator/' ) ); ?>">📅 RD Calculator</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/lumpsum-calculator/' ) ); ?>">💵 Lumpsum Calculator</a></li>
                    </ul>
                </div>

                <?php if ( is_active_sidebar( 'asl-blog-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'asl-blog-sidebar' ); ?>
                <?php endif; ?>

            </aside>
        </div>
    </div>
</div>

<div class="asl-container">
    <?php aslt_render_ad( 'footer' ); ?>
</div>

<?php get_footer(); ?>
