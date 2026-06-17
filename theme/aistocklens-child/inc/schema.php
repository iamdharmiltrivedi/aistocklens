<?php
/**
 * JSON-LD Schema Markup
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_head', 'aslc_schema_markup' );
function aslc_schema_markup() {
    $schema = [];

    // Sitelinks SearchBox on homepage
    if ( is_front_page() ) {
        $schema[] = [
            '@context' => 'https://schema.org',
            '@type'    => 'WebSite',
            'name'     => get_bloginfo( 'name' ),
            'url'      => home_url( '/' ),
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => [
                    '@type'       => 'EntryPoint',
                    'urlTemplate' => home_url( '/?s={search_term_string}' ),
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];

        $schema[] = [
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => get_bloginfo( 'name' ),
            'url'      => home_url( '/' ),
            'logo'     => [
                '@type' => 'ImageObject',
                'url'   => ASLC_URI . '/assets/img/logo.png',
            ],
            'sameAs' => [],
        ];
    }

    // BreadcrumbList on single posts/pages
    if ( is_singular() && ! is_front_page() ) {
        $breadcrumbs = [
            [
                '@type'    => 'ListItem',
                'position' => 1,
                'name'     => get_bloginfo( 'name' ),
                'item'     => home_url( '/' ),
            ],
        ];

        $position = 2;

        if ( is_singular( 'lesson' ) ) {
            $breadcrumbs[] = [
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => 'Learn',
                'item'     => get_post_type_archive_link( 'lesson' ),
            ];
        }

        if ( is_singular( 'guide' ) ) {
            $breadcrumbs[] = [
                '@type'    => 'ListItem',
                'position' => $position++,
                'name'     => 'Guides',
                'item'     => get_post_type_archive_link( 'guide' ),
            ];
        }

        $breadcrumbs[] = [
            '@type'    => 'ListItem',
            'position' => $position,
            'name'     => get_the_title(),
            'item'     => get_permalink(),
        ];

        $schema[] = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $breadcrumbs,
        ];
    }

    // Article schema for posts
    if ( is_singular( 'post' ) ) {
        $schema[] = [
            '@context'         => 'https://schema.org',
            '@type'            => 'Article',
            'headline'         => get_the_title(),
            'description'      => wp_strip_all_tags( get_the_excerpt() ),
            'url'              => get_permalink(),
            'datePublished'    => get_the_date( 'c' ),
            'dateModified'     => get_the_modified_date( 'c' ),
            'author'           => [
                '@type' => 'Person',
                'name'  => get_the_author(),
            ],
            'publisher'        => [
                '@type' => 'Organization',
                'name'  => get_bloginfo( 'name' ),
                'logo'  => [
                    '@type' => 'ImageObject',
                    'url'   => ASLC_URI . '/assets/img/logo.png',
                ],
            ],
        ];
    }

    // FAQPage schema — add to pages with FAQ section
    if ( is_front_page() ) {
        $faq_items = aslc_get_homepage_faq();
        if ( ! empty( $faq_items ) ) {
            $faq_schema_items = array_map( fn( $item ) => [
                '@type'          => 'Question',
                'name'           => $item['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => $item['answer'],
                ],
            ], $faq_items );

            $schema[] = [
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => $faq_schema_items,
            ];
        }
    }

    if ( empty( $schema ) ) return;

    foreach ( $schema as $item ) {
        printf(
            '<script type="application/ld+json">%s</script>' . "\n",
            wp_json_encode( $item, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT )
        );
    }
}

/**
 * Return FAQ items for homepage schema + template rendering.
 */
function aslc_get_homepage_faq() {
    return [
        [
            'question' => 'What is a SIP calculator?',
            'answer'   => 'A SIP (Systematic Investment Plan) calculator helps you estimate the future value of your monthly SIP investments using the compound interest formula. Enter your monthly amount, expected return rate, and investment duration to see projected returns.',
        ],
        [
            'question' => 'How is EMI calculated?',
            'answer'   => 'EMI (Equated Monthly Installment) is calculated using the formula: EMI = P × r × (1+r)^n / ((1+r)^n - 1), where P is the principal loan amount, r is the monthly interest rate, and n is the number of monthly installments.',
        ],
        [
            'question' => 'What is the difference between SIP and lump sum investment?',
            'answer'   => 'In SIP, you invest a fixed amount every month, which averages out market volatility (called rupee cost averaging). In lump sum, you invest the entire amount at once, which can be riskier but may generate higher returns if timed correctly.',
        ],
        [
            'question' => 'What is CAGR and why does it matter?',
            'answer'   => 'CAGR (Compound Annual Growth Rate) measures the annual growth rate of an investment over a specified time period, assuming profits were reinvested. It helps compare the performance of different investments on an equal footing.',
        ],
        [
            'question' => 'What is expense ratio in mutual funds?',
            'answer'   => 'The expense ratio is the annual fee that all funds or ETFs charge their shareholders. It covers management fees, administrative fees, and other operational costs. A lower expense ratio means more of your returns stay in your pocket.',
        ],
        [
            'question' => 'Is this website SEBI registered?',
            'answer'   => 'AI Stock Lens is a financial education platform providing informational content only. We are not SEBI registered investment advisors. Content on this site is for educational purposes and should not be construed as investment advice. Please consult a SEBI-registered advisor before making investment decisions.',
        ],
    ];
}
