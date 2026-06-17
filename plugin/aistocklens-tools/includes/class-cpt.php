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
    }

    public static function register_all() {
        self::register_lessons();
        self::register_calculators();
        self::register_guides();
        self::register_taxonomies();
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
    // -----------------------------------------------------------------------
    private static function register_guides() {
        $labels = [
            'name'               => _x( 'Guides', 'post type general name', 'aistocklens-tools' ),
            'singular_name'      => _x( 'Guide', 'post type singular name', 'aistocklens-tools' ),
            'menu_name'          => __( 'Guides', 'aistocklens-tools' ),
            'add_new'            => __( 'Add New', 'aistocklens-tools' ),
            'add_new_item'       => __( 'Add New Guide', 'aistocklens-tools' ),
            'edit_item'          => __( 'Edit Guide', 'aistocklens-tools' ),
            'not_found'          => __( 'No guides found', 'aistocklens-tools' ),
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
            'rewrite'         => [ 'slug' => 'guides', 'with_front' => false ],
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
            'rewrite'           => [ 'slug' => 'learn/category' ],
        ] );

        // Guide Topic
        register_taxonomy( 'guide_topic', 'guide', [
            'labels'            => [
                'name'          => __( 'Guide Topics', 'aistocklens-tools' ),
                'singular_name' => __( 'Guide Topic', 'aistocklens-tools' ),
                'menu_name'     => __( 'Topics', 'aistocklens-tools' ),
            ],
            'public'            => true,
            'hierarchical'      => true,
            'show_in_rest'      => true,
            'rewrite'           => [ 'slug' => 'guides/topic' ],
        ] );
    }
}
