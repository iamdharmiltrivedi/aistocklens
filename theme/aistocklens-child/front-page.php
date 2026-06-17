<?php
/**
 * Homepage Template — AI Stock Lens
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<!-- =====================================================================
     HERO
     ===================================================================== -->
<section class="asl-hero" aria-label="<?php esc_attr_e( 'Site introduction', 'aistocklens-child' ); ?>">
    <div class="asl-container">
        <div class="asl-hero__inner">

            <!-- Text -->
            <div class="asl-hero__content">
                <div class="asl-hero__eyebrow">
                    <span>📈</span>
                    <?php esc_html_e( '100% Free Financial Tools & Education', 'aistocklens-child' ); ?>
                </div>

                <h1 class="asl-hero__title">
                    <?php esc_html_e( 'Learn Investing.', 'aistocklens-child' ); ?><br>
                    <span><?php esc_html_e( 'Use Free Financial Tools.', 'aistocklens-child' ); ?></span>
                </h1>

                <p class="asl-hero__subtitle">
                    <?php esc_html_e( 'Plan your financial future with our SIP, EMI, FD, CAGR calculators and master investing through bite-sized lessons — all free, no signup needed.', 'aistocklens-child' ); ?>
                </p>

                <div class="asl-hero__ctas">
                    <a href="<?php echo esc_url( home_url( '/calculators/' ) ); ?>" class="asl-btn asl-btn--accent asl-btn--lg">
                        🧮 <?php esc_html_e( 'Try Calculators', 'aistocklens-child' ); ?>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/learn/' ) ); ?>" class="asl-btn asl-btn--outline asl-btn--lg" style="color:#fff;border-color:rgba(255,255,255,.6)">
                        📚 <?php esc_html_e( 'Start Learning', 'aistocklens-child' ); ?>
                    </a>
                </div>

                <div class="asl-hero__trust">
                    <div class="asl-hero__trust-item">
                        <span class="dot"></span>
                        <?php esc_html_e( 'No signup needed', 'aistocklens-child' ); ?>
                    </div>
                    <div class="asl-hero__trust-item">
                        <span class="dot"></span>
                        <?php esc_html_e( '8+ Calculators', 'aistocklens-child' ); ?>
                    </div>
                    <div class="asl-hero__trust-item">
                        <span class="dot"></span>
                        <?php esc_html_e( 'Beginner-friendly', 'aistocklens-child' ); ?>
                    </div>
                </div>
            </div>

            <!-- Visual dashboard -->
            <div class="asl-hero__visual" aria-hidden="true">
                <div class="asl-hero__dashboard">
                    <div class="asl-hero__dashboard-title">📊 SIP PROJECTION PREVIEW</div>
                    <div class="asl-hero__stats">
                        <div class="asl-hero__stat">
                            <span class="asl-hero__stat-val">₹5,000</span>
                            <div class="asl-hero__stat-label">Monthly SIP</div>
                        </div>
                        <div class="asl-hero__stat">
                            <span class="asl-hero__stat-val">12%</span>
                            <div class="asl-hero__stat-label">Expected Return</div>
                        </div>
                        <div class="asl-hero__stat">
                            <span class="asl-hero__stat-val">₹11.6L</span>
                            <div class="asl-hero__stat-label">Est. Value (10yr)</div>
                        </div>
                        <div class="asl-hero__stat">
                            <span class="asl-hero__stat-val">₹5.6L</span>
                            <div class="asl-hero__stat-label">Total Gains</div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.asl-hero__inner -->
    </div><!-- /.asl-container -->
</section>

<!-- =====================================================================
     POPULAR CALCULATORS
     ===================================================================== -->
<section class="asl-section" id="calculators">
    <div class="asl-container">
        <?php aslc_section_head(
            __( 'Free Tools', 'aistocklens-child' ),
            __( 'Popular Financial Calculators', 'aistocklens-child' ),
            __( 'Plan smarter with accurate, instant calculations. No account needed.', 'aistocklens-child' )
        ); ?>

        <div class="asl-grid asl-grid--4">
            <?php
            $calculators = [
                [
                    'icon'  => '💰',
                    'bg'    => '#E3F2FD',
                    'title' => 'SIP Calculator',
                    'desc'  => 'Estimate returns on your monthly Systematic Investment Plan.',
                    'slug'  => 'sip-calculator',
                    'sc'    => '[sip_calculator]',
                ],
                [
                    'icon'  => '🏦',
                    'bg'    => '#E8F5E9',
                    'title' => 'EMI Calculator',
                    'desc'  => 'Calculate equated monthly instalments for home, car or personal loans.',
                    'slug'  => 'emi-calculator',
                    'sc'    => '[emi_calculator]',
                ],
                [
                    'icon'  => '🏧',
                    'bg'    => '#FFF3E0',
                    'title' => 'FD Calculator',
                    'desc'  => 'Find out maturity value of your Fixed Deposit at interest rate.',
                    'slug'  => 'fd-calculator',
                    'sc'    => '[fd_calculator]',
                ],
                [
                    'icon'  => '📅',
                    'bg'    => '#F3E5F5',
                    'title' => 'RD Calculator',
                    'desc'  => 'Plan your Recurring Deposit and forecast maturity amount.',
                    'slug'  => 'rd-calculator',
                    'sc'    => '[rd_calculator]',
                ],
                [
                    'icon'  => '📈',
                    'bg'    => '#E0F7FA',
                    'title' => 'CAGR Calculator',
                    'desc'  => 'Measure Compound Annual Growth Rate of any investment.',
                    'slug'  => 'cagr-calculator',
                    'sc'    => '[cagr_calculator]',
                ],
                [
                    'icon'  => '🏛️',
                    'bg'    => '#E8EAF6',
                    'title' => 'PPF Calculator',
                    'desc'  => 'Project Public Provident Fund corpus with yearly contributions.',
                    'slug'  => 'ppf-calculator',
                    'sc'    => '[ppf_calculator]',
                ],
                [
                    'icon'  => '👴',
                    'bg'    => '#FBE9E7',
                    'title' => 'NPS Calculator',
                    'desc'  => 'Estimate your National Pension Scheme retirement corpus.',
                    'slug'  => 'nps-calculator',
                    'sc'    => '[nps_calculator]',
                ],
                [
                    'icon'  => '🌅',
                    'bg'    => '#F1F8E9',
                    'title' => 'Retirement Calculator',
                    'desc'  => 'Plan how much you need to retire comfortably at your target age.',
                    'slug'  => 'retirement-calculator',
                    'sc'    => '[retirement_calculator]',
                ],
            ];

            foreach ( $calculators as $calc ) :
                $url = get_permalink( get_page_by_path( $calc['slug'] ) ) ?: home_url( '/calculators/' . $calc['slug'] . '/' );
            ?>
            <a href="<?php echo esc_url( $url ); ?>" class="asl-calc-card">
                <div class="asl-calc-card__icon" style="background:<?php echo esc_attr( $calc['bg'] ); ?>">
                    <?php echo $calc['icon']; ?>
                </div>
                <div class="asl-calc-card__title"><?php echo esc_html( $calc['title'] ); ?></div>
                <p class="asl-calc-card__desc"><?php echo esc_html( $calc['desc'] ); ?></p>
                <span class="asl-calc-card__link">
                    <?php esc_html_e( 'Calculate now', 'aistocklens-child' ); ?> →
                </span>
            </a>
            <?php endforeach; ?>
        </div><!-- /.asl-grid -->

        <div class="text-center" style="margin-top:var(--space-10)">
            <a href="<?php echo esc_url( home_url( '/calculators/' ) ); ?>" class="asl-btn asl-btn--outline">
                <?php esc_html_e( 'View All Calculators', 'aistocklens-child' ); ?> →
            </a>
        </div>
    </div>
</section>

<!-- AdSense slot between sections -->
<div class="asl-container">
    <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>">
        <!-- AdSense code here -->
    </div>
</div>

<!-- =====================================================================
     LEARNING PATHS
     ===================================================================== -->
<section class="asl-section asl-section--alt" id="learn">
    <div class="asl-container">
        <?php aslc_section_head(
            __( 'Education', 'aistocklens-child' ),
            __( 'Learning Paths', 'aistocklens-child' ),
            __( 'Structured courses to go from zero to investing-confident.', 'aistocklens-child' )
        ); ?>

        <div class="asl-grid asl-grid--2">

            <!-- Mutual Fund Academy -->
            <div class="asl-path-card">
                <div class="asl-path-card__header">
                    <span class="asl-path-card__icon">💼</span>
                    <h3 class="asl-path-card__title"><?php esc_html_e( 'Mutual Fund Academy', 'aistocklens-child' ); ?></h3>
                    <p class="asl-path-card__subtitle"><?php esc_html_e( '6 lessons · Beginner friendly', 'aistocklens-child' ); ?></p>
                </div>
                <ul class="asl-path-card__lessons">
                    <?php
                    $mf_lessons = [
                        [ 'What is a Mutual Fund?',  'what-is-mutual-fund' ],
                        [ 'Types of Mutual Funds',   'types-of-mutual-funds' ],
                        [ 'Understanding NAV',        'understanding-nav' ],
                        [ 'How SIP Works',            'how-sip-works' ],
                        [ 'Expense Ratio Explained',  'expense-ratio' ],
                        [ 'Asset Allocation Strategy','asset-allocation' ],
                    ];
                    foreach ( $mf_lessons as $i => $lesson ) :
                        $url = get_permalink( get_page_by_path( 'learn/mutual-funds/' . $lesson[1] ) )
                               ?: home_url( '/learn/mutual-funds/' . $lesson[1] . '/' );
                    ?>
                    <li>
                        <a href="<?php echo esc_url( $url ); ?>" class="asl-path-card__lesson">
                            <span class="asl-path-card__lesson-num"><?php echo esc_html( $i + 1 ); ?></span>
                            <?php echo esc_html( $lesson[0] ); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="asl-path-card__footer">
                    <a href="<?php echo esc_url( home_url( '/learn/mutual-funds/' ) ); ?>" class="asl-btn asl-btn--primary" style="width:100%;justify-content:center">
                        <?php esc_html_e( 'Start Mutual Fund Course', 'aistocklens-child' ); ?>
                    </a>
                </div>
            </div>

            <!-- Stock Market Academy -->
            <div class="asl-path-card">
                <div class="asl-path-card__header asl-path-card__header--green">
                    <span class="asl-path-card__icon">📊</span>
                    <h3 class="asl-path-card__title"><?php esc_html_e( 'Stock Market Academy', 'aistocklens-child' ); ?></h3>
                    <p class="asl-path-card__subtitle"><?php esc_html_e( '6 lessons · Beginner friendly', 'aistocklens-child' ); ?></p>
                </div>
                <ul class="asl-path-card__lessons">
                    <?php
                    $stock_lessons = [
                        [ 'What is a Stock?',          'what-is-a-stock' ],
                        [ 'Opening a Demat Account',   'demat-account' ],
                        [ 'P/E Ratio Explained',       'pe-ratio' ],
                        [ 'EPS — Earnings Per Share',  'eps-explained' ],
                        [ 'Return on Equity (ROE)',     'roe-explained' ],
                        [ 'Fundamental Analysis',       'fundamental-analysis' ],
                    ];
                    foreach ( $stock_lessons as $i => $lesson ) :
                        $url = get_permalink( get_page_by_path( 'learn/stocks/' . $lesson[1] ) )
                               ?: home_url( '/learn/stocks/' . $lesson[1] . '/' );
                    ?>
                    <li>
                        <a href="<?php echo esc_url( $url ); ?>" class="asl-path-card__lesson">
                            <span class="asl-path-card__lesson-num"><?php echo esc_html( $i + 1 ); ?></span>
                            <?php echo esc_html( $lesson[0] ); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="asl-path-card__footer">
                    <a href="<?php echo esc_url( home_url( '/learn/stocks/' ) ); ?>" class="asl-btn asl-btn--accent" style="width:100%;justify-content:center">
                        <?php esc_html_e( 'Start Stock Market Course', 'aistocklens-child' ); ?>
                    </a>
                </div>
            </div>

        </div><!-- /.asl-grid -->
    </div>
</section>

<!-- =====================================================================
     FEATURED GUIDES
     ===================================================================== -->
<section class="asl-section" id="guides">
    <div class="asl-container">
        <?php aslc_section_head(
            __( 'Deep Dives', 'aistocklens-child' ),
            __( 'Featured Guides', 'aistocklens-child' ),
            __( 'Comprehensive articles written for Indian investors.', 'aistocklens-child' )
        ); ?>

        <?php
        $guides_query = new WP_Query( [
            'post_type'      => 'guide',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order date',
            'order'          => 'ASC',
        ] );

        if ( $guides_query->have_posts() ) :
        ?>
        <div class="asl-grid asl-grid--3">
            <?php while ( $guides_query->have_posts() ) : $guides_query->the_post(); ?>
            <article class="asl-article-card">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'asl-card', [ 'class' => 'asl-article-card__img', 'loading' => 'lazy' ] ); ?>
                    </a>
                <?php else : ?>
                    <div class="asl-article-card__img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;">📘</div>
                <?php endif; ?>
                <div class="asl-article-card__body">
                    <span class="asl-article-card__cat"><?php esc_html_e( 'Guide', 'aistocklens-child' ); ?></span>
                    <h3 class="asl-article-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="asl-article-card__excerpt"><?php the_excerpt(); ?></p>
                    <div class="asl-article-card__meta">
                        <span><?php the_date(); ?></span>
                        <span>· <?php echo esc_html( get_the_author() ); ?></span>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <!-- Placeholder guides before content is added -->
        <div class="asl-grid asl-grid--3">
            <?php
            $placeholder_guides = [
                [ '📘', 'Beginner\'s Guide to Mutual Funds in India', 'Everything you need to know to start investing in mutual funds — types, SIP, direct vs regular, and more.' ],
                [ '📊', 'How to Read a Company\'s Balance Sheet', 'Step-by-step tutorial on understanding assets, liabilities, equity, and key financial ratios.' ],
                [ '💼', 'Building Your First Investment Portfolio', 'Asset allocation strategies for Indian investors at different life stages and risk profiles.' ],
            ];
            foreach ( $placeholder_guides as $g ) :
            ?>
            <article class="asl-article-card">
                <div class="asl-article-card__img" style="display:flex;align-items:center;justify-content:center;font-size:3rem;min-height:160px;background:var(--color-bg-subtle)">
                    <?php echo $g[0]; ?>
                </div>
                <div class="asl-article-card__body">
                    <span class="asl-article-card__cat"><?php esc_html_e( 'Guide', 'aistocklens-child' ); ?></span>
                    <h3 class="asl-article-card__title"><?php echo esc_html( $g[1] ); ?></h3>
                    <p class="asl-article-card__excerpt"><?php echo esc_html( $g[2] ); ?></p>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="text-center" style="margin-top:var(--space-10)">
            <a href="<?php echo esc_url( home_url( '/guides/' ) ); ?>" class="asl-btn asl-btn--outline">
                <?php esc_html_e( 'Browse All Guides', 'aistocklens-child' ); ?> →
            </a>
        </div>
    </div>
</section>

<!-- =====================================================================
     LATEST ARTICLES
     ===================================================================== -->
<section class="asl-section asl-section--alt" id="articles">
    <div class="asl-container">
        <?php aslc_section_head(
            __( 'Latest', 'aistocklens-child' ),
            __( 'Recent Articles', 'aistocklens-child' ),
            __( 'Stay up to date with investing insights and market education.', 'aistocklens-child' )
        ); ?>

        <?php
        $posts_query = new WP_Query( [
            'post_type'      => 'post',
            'posts_per_page' => 6,
            'post_status'    => 'publish',
        ] );

        if ( $posts_query->have_posts() ) :
        ?>
        <div class="asl-grid asl-grid--3">
            <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
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
                    <h3 class="asl-article-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="asl-article-card__excerpt"><?php the_excerpt(); ?></p>
                    <div class="asl-article-card__meta">
                        <span><?php echo esc_html( human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ago' ); ?></span>
                        <span>· <?php echo esc_html( get_the_author() ); ?></span>
                    </div>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <p class="text-center text-muted"><?php esc_html_e( 'Articles coming soon. Check back!', 'aistocklens-child' ); ?></p>
        <?php endif; ?>

        <div class="text-center" style="margin-top:var(--space-10)">
            <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="asl-btn asl-btn--outline">
                <?php esc_html_e( 'View All Articles', 'aistocklens-child' ); ?> →
            </a>
        </div>
    </div>
</section>

<!-- AdSense slot -->
<div class="asl-container">
    <div class="asl-ad-slot" aria-label="<?php esc_attr_e( 'Advertisement', 'aistocklens-child' ); ?>">
        <!-- AdSense code here -->
    </div>
</div>

<!-- =====================================================================
     FAQ
     ===================================================================== -->
<section class="asl-section" id="faq">
    <div class="asl-container asl-container--narrow">
        <?php aslc_section_head(
            __( 'FAQ', 'aistocklens-child' ),
            __( 'Frequently Asked Questions', 'aistocklens-child' )
        ); ?>

        <div class="asl-faq">
            <?php foreach ( aslc_get_homepage_faq() as $i => $item ) : ?>
            <div class="asl-faq__item">
                <button
                    class="asl-faq__question"
                    aria-expanded="false"
                    aria-controls="faq-answer-<?php echo esc_attr( $i ); ?>"
                >
                    <?php echo esc_html( $item['question'] ); ?>
                    <span class="asl-faq__icon" aria-hidden="true">+</span>
                </button>
                <div
                    class="asl-faq__answer"
                    id="faq-answer-<?php echo esc_attr( $i ); ?>"
                    role="region"
                >
                    <p><?php echo esc_html( $item['answer'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
