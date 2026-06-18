<?php
/**
 * Archive: Calculators
 *
 * Always renders the full calculator grid from the known shortcode registry.
 * If CPT posts are published they appear below as additional entries.
 *
 * @package aistocklens-child
 */

defined( 'ABSPATH' ) || exit;

get_header();

$calculators = [
    [
        'icon'  => '💰',
        'title' => __( 'SIP Calculator', 'aistocklens-child' ),
        'desc'  => __( 'Calculate returns on your monthly Systematic Investment Plan contributions.', 'aistocklens-child' ),
        'url'   => home_url( '/calculators/sip-calculator/' ),
        'color' => '#E3F2FD',
    ],
    [
        'icon'  => '🏦',
        'title' => __( 'EMI Calculator', 'aistocklens-child' ),
        'desc'  => __( 'Find your monthly EMI for home, car, or personal loans instantly.', 'aistocklens-child' ),
        'url'   => home_url( '/calculators/emi-calculator/' ),
        'color' => '#E8F5E9',
    ],
    [
        'icon'  => '🏧',
        'title' => __( 'FD Calculator', 'aistocklens-child' ),
        'desc'  => __( 'Estimate maturity amount and interest earned on your Fixed Deposit.', 'aistocklens-child' ),
        'url'   => home_url( '/calculators/fd-calculator/' ),
        'color' => '#FFF8E1',
    ],
    [
        'icon'  => '📈',
        'title' => __( 'CAGR Calculator', 'aistocklens-child' ),
        'desc'  => __( 'Compute the Compounded Annual Growth Rate of any investment.', 'aistocklens-child' ),
        'url'   => home_url( '/calculators/cagr-calculator/' ),
        'color' => '#F3E5F5',
    ],
    [
        'icon'  => '🏛️',
        'title' => __( 'PPF Calculator', 'aistocklens-child' ),
        'desc'  => __( 'Plan your Public Provident Fund corpus and yearly interest earnings.', 'aistocklens-child' ),
        'url'   => home_url( '/calculators/ppf-calculator/' ),
        'color' => '#E0F2F1',
    ],
    [
        'icon'  => '👴',
        'title' => __( 'NPS Calculator', 'aistocklens-child' ),
        'desc'  => __( 'Estimate your National Pension Scheme corpus and monthly pension.', 'aistocklens-child' ),
        'url'   => home_url( '/calculators/nps-calculator/' ),
        'color' => '#FBE9E7',
    ],
    [
        'icon'  => '🎯',
        'title' => __( 'Retirement Calculator', 'aistocklens-child' ),
        'desc'  => __( 'Find out how much you need to save today for a comfortable retirement.', 'aistocklens-child' ),
        'url'   => home_url( '/calculators/retirement-calculator/' ),
        'color' => '#EDE7F6',
    ],
];
?>

<!-- Hero -->
<div class="asl-learn-hero" style="background:linear-gradient(135deg,#1565C0 0%,#0D47A1 100%)">
    <div class="asl-container">
        <?php aslc_breadcrumbs(); ?>
        <h1 style="margin-top:var(--space-4)"><?php esc_html_e( 'Free Financial Calculators', 'aistocklens-child' ); ?></h1>
        <p style="color:rgba(255,255,255,.8);max-width:560px;margin-top:var(--space-3);margin-inline:auto">
            <?php esc_html_e( 'SIP, EMI, FD, CAGR and more — all free, instant, no signup required.', 'aistocklens-child' ); ?>
        </p>
        <!-- Stats badge -->
        <div style="margin-top:var(--space-6)">
            <span style="display:inline-flex;align-items:center;gap:var(--space-2);background:rgba(255,255,255,.2);color:#fff;font-size:var(--text-sm);font-weight:600;padding:.375rem 1rem;border-radius:var(--radius-full)">
                🧮 <?php printf( esc_html__( '%d Free Calculators', 'aistocklens-child' ), count( $calculators ) ); ?>
            </span>
        </div>
    </div>
</div>

<!-- Calculator Grid -->
<div class="asl-section">
    <div class="asl-container">

        <?php aslt_render_ad( 'page_top_2' ); ?>

        <div class="asl-grid asl-grid--4" style="--asl-col-min:220px">
            <?php foreach ( $calculators as $calc ) : ?>
            <a href="<?php echo esc_url( $calc['url'] ); ?>" class="asl-calc-card">
                <div class="asl-calc-card__icon" style="background:<?php echo esc_attr( $calc['color'] ); ?>">
                    <?php echo esc_html( $calc['icon'] ); ?>
                </div>
                <div class="asl-calc-card__title"><?php echo esc_html( $calc['title'] ); ?></div>
                <p class="asl-calc-card__desc"><?php echo esc_html( $calc['desc'] ); ?></p>
                <span class="asl-calc-card__link"><?php esc_html_e( 'Open Calculator', 'aistocklens-child' ); ?> →</span>
            </a>
            <?php endforeach; ?>
        </div>

        <?php aslt_render_ad( 'footer' ); ?>

    </div>
</div>

<?php get_footer(); ?>
