<?php
/**
 * AI Stock Lens Child Theme — functions.php
 *
 * @package aistocklens-child
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

define( 'ASLC_VERSION', '1.0.0' );
define( 'ASLC_DIR',     get_stylesheet_directory() );
define( 'ASLC_URI',     get_stylesheet_directory_uri() );

// -----------------------------------------------------------------------
// 1. ENQUEUE PARENT + CHILD ASSETS
// -----------------------------------------------------------------------
add_action( 'wp_enqueue_scripts', 'aslc_enqueue_assets' );
function aslc_enqueue_assets() {
    // Parent (Blocksy) stylesheet — already loaded by Blocksy itself via theme support;
    // only enqueue if for some reason it isn't.
    if ( ! wp_style_is( 'blocksy-style', 'enqueued' ) ) {
        wp_enqueue_style(
            'blocksy-style',
            get_template_directory_uri() . '/style.css',
            [],
            wp_get_theme( 'blocksy' )->get( 'Version' )
        );
    }

    // Child theme stylesheet
    wp_enqueue_style(
        'aslc-style',
        ASLC_URI . '/style.css',
        [ 'blocksy-style' ],
        ASLC_VERSION
    );

    // Google Fonts (Inter + Poppins)
    wp_enqueue_style(
        'aslc-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap',
        [],
        null
    );

    // Main JS (deferred)
    wp_enqueue_script(
        'aslc-main',
        ASLC_URI . '/assets/js/main.js',
        [],
        ASLC_VERSION,
        true
    );

    wp_script_add_data( 'aslc-main', 'defer', true );
}

// -----------------------------------------------------------------------
// 2. THEME SUPPORTS
// -----------------------------------------------------------------------
add_action( 'after_setup_theme', 'aslc_theme_support' );
function aslc_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'navigation-widgets',
    ] );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'custom-logo', [
        'height'      => 50,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ] );

    // Image sizes
    add_image_size( 'asl-card',     600,  400, true );
    add_image_size( 'asl-hero',    1200,  600, true );
    add_image_size( 'asl-thumb',    400,  300, true );

    // Menus
    register_nav_menus( [
        'primary'       => __( 'Primary Navigation',   'aistocklens-child' ),
        'footer-col-1'  => __( 'Footer: Calculators',  'aistocklens-child' ),
        'footer-col-2'  => __( 'Footer: Learn',        'aistocklens-child' ),
        'footer-col-3'  => __( 'Footer: Company',      'aistocklens-child' ),
    ] );
}

// -----------------------------------------------------------------------
// 3. EXCERPT LENGTH & MORE
// -----------------------------------------------------------------------
add_filter( 'excerpt_length', fn() => 25 );
add_filter( 'excerpt_more',   fn() => '…' );

// -----------------------------------------------------------------------
// 4. REMOVE EMOJI SCRIPTS (performance)
// -----------------------------------------------------------------------
add_action( 'init', 'aslc_disable_emojis' );
function aslc_disable_emojis() {
    remove_action( 'wp_head',             'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles',     'print_emoji_styles' );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles',  'print_emoji_styles' );
    remove_filter( 'the_content_feed',    'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss',    'wp_staticize_emoji' );
    remove_filter( 'wp_mail',            'wp_staticize_emoji_for_email' );
}

// -----------------------------------------------------------------------
// 5. BODY CLASSES
// -----------------------------------------------------------------------
add_filter( 'body_class', 'aslc_body_classes' );
function aslc_body_classes( $classes ) {
    $classes[] = 'asl-site';
    if ( is_front_page() ) $classes[] = 'asl-homepage';
    if ( is_singular( 'lesson' ) ) $classes[] = 'asl-lesson-page';
    if ( is_singular( 'guide' ) )  $classes[] = 'asl-guide-page';
    return $classes;
}

// -----------------------------------------------------------------------
// 6. SCHEMA / JSON-LD HELPERS  (loaded from inc/schema.php)
// -----------------------------------------------------------------------
require_once ASLC_DIR . '/inc/schema.php';

// -----------------------------------------------------------------------
// 7. TEMPLATE HELPER FUNCTIONS
// -----------------------------------------------------------------------

/**
 * Output section header HTML.
 */
function aslc_section_head( $eyebrow, $title, $subtitle = '' ) {
    printf(
        '<div class="asl-section-head">
            <span class="asl-section-head__eyebrow">%1$s</span>
            <h2 class="asl-section-head__title">%2$s</h2>
            %3$s
        </div>',
        esc_html( $eyebrow ),
        esc_html( $title ),
        $subtitle ? '<p class="asl-section-head__subtitle">' . esc_html( $subtitle ) . '</p>' : ''
    );
}

/**
 * Render a breadcrumb trail.
 * Handles: lesson, guide, guide_topic taxonomy, lesson_category taxonomy, generic archive/singular.
 */
function aslc_breadcrumbs() {
    echo '<nav class="asl-breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'aistocklens-child' ) . '">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'aistocklens-child' ) . '</a>';
    echo '<span class="asl-breadcrumb__sep" aria-hidden="true">›</span>';

    if ( is_singular( 'lesson' ) ) {
        // Home › Learn › [Category] › Title
        echo '<a href="' . esc_url( get_post_type_archive_link( 'lesson' ) ) . '">' . esc_html__( 'Learn', 'aistocklens-child' ) . '</a>';
        echo '<span class="asl-breadcrumb__sep" aria-hidden="true">›</span>';
        $lesson_cats = get_the_terms( get_the_ID(), 'lesson_category' );
        if ( ! is_wp_error( $lesson_cats ) && ! empty( $lesson_cats ) ) {
            echo '<a href="' . esc_url( get_term_link( $lesson_cats[0] ) ) . '">' . esc_html( $lesson_cats[0]->name ) . '</a>';
            echo '<span class="asl-breadcrumb__sep" aria-hidden="true">›</span>';
        }
        echo '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';

    } elseif ( is_singular( 'guide' ) ) {
        // Home › Guides › [Topic] › Title
        echo '<a href="' . esc_url( get_post_type_archive_link( 'guide' ) ) . '">' . esc_html__( 'Guides', 'aistocklens-child' ) . '</a>';
        echo '<span class="asl-breadcrumb__sep" aria-hidden="true">›</span>';
        $gtopics = get_the_terms( get_the_ID(), 'guide_topic' );
        if ( ! is_wp_error( $gtopics ) && ! empty( $gtopics ) ) {
            echo '<a href="' . esc_url( get_term_link( $gtopics[0] ) ) . '">' . esc_html( $gtopics[0]->name ) . '</a>';
            echo '<span class="asl-breadcrumb__sep" aria-hidden="true">›</span>';
        }
        echo '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';

    } elseif ( is_tax( 'guide_topic' ) ) {
        // Home › Guides › Topic Name
        echo '<a href="' . esc_url( get_post_type_archive_link( 'guide' ) ) . '">' . esc_html__( 'Guides', 'aistocklens-child' ) . '</a>';
        echo '<span class="asl-breadcrumb__sep" aria-hidden="true">›</span>';
        echo '<span aria-current="page">' . esc_html( single_term_title( '', false ) ) . '</span>';

    } elseif ( is_tax( 'lesson_category' ) ) {
        // Home › Learn › Category Name
        echo '<a href="' . esc_url( get_post_type_archive_link( 'lesson' ) ) . '">' . esc_html__( 'Learn', 'aistocklens-child' ) . '</a>';
        echo '<span class="asl-breadcrumb__sep" aria-hidden="true">›</span>';
        echo '<span aria-current="page">' . esc_html( single_term_title( '', false ) ) . '</span>';

    } elseif ( is_singular() || is_page() ) {
        echo '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';

    } elseif ( is_archive() ) {
        echo '<span>' . esc_html( post_type_archive_title( '', false ) ) . '</span>';
    }

    echo '</nav>';
}

/**
 * Format INR currency.
 */
function aslc_format_inr( $amount ) {
    return '₹' . number_format( (float) $amount, 2, '.', ',' );
}

// -----------------------------------------------------------------------
// 8. PAGINATION
// -----------------------------------------------------------------------
function aslc_pagination() {
    $args = [
        'prev_text' => '← ' . __( 'Previous', 'aistocklens-child' ),
        'next_text' => __( 'Next', 'aistocklens-child' ) . ' →',
        'type'      => 'list',
    ];
    $links = paginate_links( $args );
    if ( $links ) {
        echo '<nav class="asl-pagination" aria-label="' . esc_attr__( 'Posts navigation', 'aistocklens-child' ) . '">';
        echo wp_kses_post( $links );
        echo '</nav>';
    }
}

// -----------------------------------------------------------------------
// 9. WIDGETS
// -----------------------------------------------------------------------
add_action( 'widgets_init', 'aslc_register_sidebars' );
function aslc_register_sidebars() {
    $defaults = [
        'before_widget' => '<div id="%1$s" class="asl-sidebar__widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="asl-sidebar__widget-title">',
        'after_title'   => '</h3>',
    ];

    register_sidebar( $defaults + [
        'name' => __( 'Blog Sidebar', 'aistocklens-child' ),
        'id'   => 'asl-blog-sidebar',
    ] );

    register_sidebar( $defaults + [
        'name' => __( 'Learn Sidebar', 'aistocklens-child' ),
        'id'   => 'asl-learn-sidebar',
    ] );

    register_sidebar( $defaults + [
        'name' => __( 'Calculator Sidebar', 'aistocklens-child' ),
        'id'   => 'asl-calc-sidebar',
    ] );
}

// -----------------------------------------------------------------------
// 10. BLOCKSY COMPATIBILITY TWEAKS
// -----------------------------------------------------------------------
// Let Blocksy handle its own header/footer; use our templates for content.
add_filter( 'blocksy:header:before-header', '__return_empty_string' );

// Disable Blocksy's default hero on our custom pages
add_filter( 'blocksy_post_options', 'aslc_blocksy_post_options', 10, 2 );
function aslc_blocksy_post_options( $options, $post ) {
    if ( in_array( get_post_type( $post ), [ 'lesson', 'guide', 'calculator' ], true ) ) {
        $options['has_hero'] = 'no';
    }
    return $options;
}
