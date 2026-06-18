<?php
/**
 * Custom Post Types & Taxonomies
 *
 * @package aistocklens-tools
 */

defined( 'ABSPATH' ) || exit;

class ASLT_CPT {

    public static function init() {
        add_action( 'init', [ __CLASS__, 'register_all' ] );
        add_filter( 'post_type_link', [ __CLASS__, 'guide_permalink' ], 10, 2 );
    }

    public static function register_all() {
        self::register_taxonomies(); // Taxonomies first so %guide_topic% tag is available for CPT permastruct
        self::register_lessons();
        self::register_calculators();
        self::register_guides();
    }

    // -----------------------------------------------------------------------
    // LESSONS
    // -----------------------------------------------------------------------
    private static function register_lessons() {
        $labels = [
            'name'               => _x( 'Lessons', 'post type general name', 'aistocklens-tools' ),
            'singular_name'      => _x( 'Lesson', 'post type singular name', 'aistocklens-tools' ),
            'menu_name'          => __( 'Lessons', 'aistocklens-tools' ),
            'add_new'            => __( 'Add New', 'aistocklens-tools' ),
            'add_new_item'       => __( 'Add New Lesson', 'aistocklens-tools' ),
            'edit_item'          => __( 'Edit Lesson', 'aistocklens-tools' ),
            'new_item'           => __( 'New Lesson', 'aistocklens-tools' ),
            'view_item'          => __( 'View Lesson', 'aistocklens-tools' ),
            'search_items'       => __( 'Search Lessons', 'aistocklens-tools' ),
            'not_found'          => __( 'No lessons found', 'aistocklens-tools' ),
            'not_found_in_trash' => __( 'No lessons in trash', 'aistocklens-tools' ),
        ];

        register_post_type( 'lesson', [
            'labels'             => $labels,
            'public'             => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-book-alt',
            'menu_position'      => 5,
            'supports'           => [ 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'author', 'revisions' ],
            'has_archive'        => 'learn',
            'rewrite'            => [ 'slug' => 'learn', 'with_front' => false ],
            'hierarchical'       => false,
            'capability_type'    => 'post',
            'taxonomies'         => [ 'lesson_category' ],
        ] );
    }

    // -----------------------------------------------------------------------
    // CALCULATORS
    // -----------------------------------------------------------------------
    private static function register_calculators() {
        $labels = [
            'name'               => _x( 'Calculators', 'post type general name', 'aistocklens-tools' ),
            'singular_name'      => _x( 'Calculator', 'post type singular name', 'aistocklens-tools' ),
            'menu_name'          => __( 'Calculators', 'aistocklens-tools' ),
            'add_new'            => __( 'Add New', 'aistocklens-tools' ),
            'add_new_item'       => __( 'Add New Calculator', 'aistocklens-tools' ),
            'edit_item'          => __( 'Edit Calculator', 'aistocklens-tools' ),
            'not_found'          => __( 'No calculators found', 'aistocklens-tools' ),
        ];

        register_post_type( 'calculator', [
            'labels'          => $labels,
            'public'          => true,
            'show_ui'         => true,
            'show_in_menu'    => true,
            'show_in_rest'    => true,
            'menu_icon'       => 'dashicons-calculator',
            'menu_position'   => 6,
            'supports'        => [ 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ],
            'has_archive'     => 'calculators',
            'rewrite'         => [ 'slug' => 'calculators', 'with_front' => false ],
            'hierarchical'    => false,
            'capability_type' => 'post',
        ] );
    }

    // -----------------------------------------------------------------------
    // GUIDES
    // URL: /guides/{topic-slug}/{guide-slug}/
    // -----------------------------------------------------------------------
    private static function register_guides() {
        $labels = [
            'name'               => _x( 'Guides', 'post type general name', 'aistocklens-tools' ),
            'singular_name'      => _x( 'Guide', 'post type singular name', 'aistocklens-tools' ),
            'menu_name'          => __( 'Guides', 'aistocklens-tools' ),
            'add_new'            => __( 'Add New', 'aistocklens-tools' ),
            'add_new_item'       => __( 'Add New Guide', 'aistocklens-tools' ),
            'edit_item'          => __( 'Edit Guide', 'aistocklens-tools' ),
            'new_item'           => __( 'New Guide', 'aistocklens-tools' ),
            'view_item'          => __( 'View Guide', 'aistocklens-tools' ),
            'search_items'       => __( 'Search Guides', 'aistocklens-tools' ),
            'not_found'          => __( 'No guides found', 'aistocklens-tools' ),
            'not_found_in_trash' => __( 'No guides in trash', 'aistocklens-tools' ),
        ];

        register_post_type( 'guide', [
            'labels'          => $labels,
            'public'          => true,
            'show_ui'         => true,
            'show_in_menu'    => true,
            'show_in_rest'    => true,
            'menu_icon'       => 'dashicons-media-document',
            'menu_position'   => 7,
            'supports'        => [ 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'author', 'revisions' ],
            'has_archive'     => 'guides',
            'rewrite'         => [ 'slug' => 'guides/%guide_topic%', 'with_front' => false ],
            'hierarchical'    => false,
            'capability_type' => 'post',
            'taxonomies'      => [ 'guide_topic' ],
        ] );
    }

    // -----------------------------------------------------------------------
    // TAXONOMIES
    // -----------------------------------------------------------------------
    private static function register_taxonomies() {
        // Lesson Category
        register_taxonomy( 'lesson_category', 'lesson', [
            'labels'            => [
                'name'          => __( 'Lesson Categories', 'aistocklens-tools' ),
                'singular_name' => __( 'Lesson Category', 'aistocklens-tools' ),
                'menu_name'     => __( 'Categories', 'aistocklens-tools' ),
            ],
            'public'            => true,
            'hierarchical'      => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'rewrite'           => [ 'slug' => 'learn/category', 'with_front' => false ],
        ] );

        // Guide Topic — archive at /guides/{topic-slug}/
        register_taxonomy( 'guide_topic', 'guide', [
            'labels'            => [
                'name'          => __( 'Guide Topics', 'aistocklens-tools' ),
                'singular_name' => __( 'Guide Topic', 'aistocklens-tools' ),
                'menu_name'     => __( 'Topics', 'aistocklens-tools' ),
                'add_new_item'  => __( 'Add New Topic', 'aistocklens-tools' ),
                'edit_item'     => __( 'Edit Topic', 'aistocklens-tools' ),
                'update_item'   => __( 'Update Topic', 'aistocklens-tools' ),
                'search_items'  => __( 'Search Topics', 'aistocklens-tools' ),
                'all_items'     => __( 'All Topics', 'aistocklens-tools' ),
                'not_found'     => __( 'No topics found', 'aistocklens-tools' ),
            ],
            'public'            => true,
            'hierarchical'      => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'rewrite'           => [
                'slug'         => 'guides',
                'with_front'   => false,
                'hierarchical' => false, // /guides/{term-slug}/ even for child terms
            ],
        ] );
    }

    // -----------------------------------------------------------------------
    // PERMALINK FILTER — replaces %guide_topic% in guide URLs
    // Produces: /guides/{topic-slug}/{guide-slug}/
    // -----------------------------------------------------------------------
    public static function guide_permalink( $post_link, $post ) {
        if ( 'guide' !== get_post_type( $post ) ) {
            return $post_link;
        }
        if ( false === strpos( $post_link, '%guide_topic%' ) ) {
            return $post_link;
        }
        $terms = get_the_terms( $post->ID, 'guide_topic' );
        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
            $slug = $terms[0]->slug;
        } else {
            $slug = 'uncategorized';
        }
        return str_replace( '%guide_topic%', $slug, $post_link );
    }
}
