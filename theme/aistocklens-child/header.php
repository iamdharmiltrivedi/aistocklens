<?php
/**
 * Site Header
 *
 * @package aistocklens-child
 */
defined( 'ABSPATH' ) || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="asl-masthead" class="asl-masthead" role="banner">
    <div class="asl-container asl-masthead__inner">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           class="asl-masthead__logo"
           aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo.png' ); ?>"
                 alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                 width="36" height="36" loading="eager">
            <span class="asl-masthead__brand">AI Stock Lens</span>
        </a>

        <!-- Primary Nav -->
        <nav id="asl-primary-nav"
             class="asl-masthead__nav asl-mobile-nav"
             aria-label="<?php esc_attr_e( 'Primary', 'aistocklens-child' ); ?>">
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'asl-masthead__menu',
                'depth'          => 2,
                'fallback_cb'    => 'aslc_primary_nav_fallback',
            ] );
            ?>
        </nav>

        <!-- Mobile burger -->
        <button class="asl-mobile-nav-toggle"
                aria-controls="asl-primary-nav"
                aria-expanded="false"
                aria-label="<?php esc_attr_e( 'Toggle navigation', 'aistocklens-child' ); ?>">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>
</header>
