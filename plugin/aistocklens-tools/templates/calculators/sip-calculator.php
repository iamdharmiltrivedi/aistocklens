<?php defined( 'ABSPATH' ) || exit; ?>
<div class="aslt-calc" id="aslt-sip" role="region" aria-label="SIP Calculator">

    <div class="aslt-card">
        <h2 style="margin:0 0 1.5rem;font-size:1.375rem;font-weight:700;color:#1A1A2E">SIP Calculator</h2>

        <div class="aslt-grid aslt-grid--2">
            <!-- Monthly Investment -->
            <div class="aslt-field">
                <label for="sip-amount">Monthly Investment</label>
                <div class="aslt-input-wrap">
                    <span class="aslt-prefix">₹</span>
                    <input type="number" id="sip-amount" value="5000" min="100" max="10000000" step="100" aria-describedby="sip-amount-err" placeholder="5000">
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="sip-amount-range" min="100" max="100000" step="100" value="5000" aria-label="Monthly investment slider">
                    <span class="aslt-slider-val" id="sip-amount-val">₹5,000</span>
                </div>
                <span class="aslt-error-msg" id="sip-amount-err" role="alert">Enter a valid amount (₹100 – ₹1,00,00,000)</span>
            </div>

            <!-- Expected Return -->
            <div class="aslt-field">
                <label for="sip-rate">Expected Annual Return</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="sip-rate" value="12" min="1" max="50" step="0.1" aria-describedby="sip-rate-err" placeholder="12">
                    <span class="aslt-suffix">%</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="sip-rate-range" min="1" max="30" step="0.5" value="12" aria-label="Return rate slider">
                    <span class="aslt-slider-val" id="sip-rate-val">12%</span>
                </div>
                <span class="aslt-error-msg" id="sip-rate-err" role="alert">Enter a rate between 1% and 50%</span>
            </div>

            <!-- Duration -->
            <div class="aslt-field">
                <label for="sip-years">Investment Duration</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="sip-years" value="10" min="1" max="40" step="1" aria-describedby="sip-years-err" placeholder="10">
                    <span class="aslt-suffix">Years</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="sip-years-range" min="1" max="40" step="1" value="10" aria-label="Duration slider">
                    <span class="aslt-slider-val" id="sip-years-val">10 yrs</span>
                </div>
                <span class="aslt-error-msg" id="sip-years-err" role="alert">Enter duration between 1 and 40 years</span>
            </div>

        </div>

        <button class="aslt-btn" id="sip-calc-btn" type="button">Calculate SIP Returns</button>
    </div>

    <!-- Results -->
    <div class="aslt-results aslt-card" id="sip-results" aria-live="polite">

        <div class="aslt-result-summary">
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Total Invested</div>
                <div class="aslt-result-box__value" id="sip-invested">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Total Returns</div>
                <div class="aslt-result-box__value" id="sip-returns" style="color:#16A34A">—</div>
            </div>
            <div class="aslt-result-box aslt-result-box--primary">
                <div class="aslt-result-box__label">Maturity Value</div>
                <div class="aslt-result-box__value" id="sip-maturity">—</div>
            </div>
        </div>

        <!-- Donut chart -->
        <div class="aslt-chart-wrap">
            <div class="aslt-donut" role="img" aria-label="Investment vs returns chart">
                <svg viewBox="0 0 36 36" aria-hidden="true">
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#E5E7EB" stroke-width="3.2"/>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#1565C0" stroke-width="3.2"
                            stroke-dasharray="0 100" id="sip-donut-invested" stroke-linecap="round"/>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#00897B" stroke-width="3.2"
                            stroke-dasharray="0 100" id="sip-donut-returns" stroke-linecap="round"/>
                </svg>
                <div class="aslt-donut__center">
                    <strong id="sip-donut-pct">—</strong>
                    <span>gain</span>
                </div>
            </div>
            <ul class="aslt-legend">
                <li><span class="aslt-legend-dot" style="background:#1565C0"></span>Amount Invested</li>
                <li><span class="aslt-legend-dot" style="background:#00897B"></span>Estimated Returns</li>
            </ul>
        </div>

        <!-- Year-by-year breakdown toggle -->
        <button class="aslt-details-toggle" id="sip-toggle-details" type="button" aria-expanded="false">
            📊 Show year-by-year breakdown ▼
        </button>
        <div class="aslt-details" id="sip-details">
            <div class="aslt-breakdown-wrap">
                <table class="aslt-breakdown" aria-label="Year-by-year SIP breakdown">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Invested</th>
                            <th>Returns</th>
                            <th>Total Value</th>
                        </tr>
                    </thead>
                    <tbody id="sip-table-body"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Formula -->
    <div class="aslt-seo-section">
        <div class="aslt-formula">
            <div class="aslt-formula__title">SIP Formula</div>
            <code>M = P × { [(1 + r)ⁿ - 1] / r } × (1 + r)

Where:
  M = Maturity Amount
  P = Monthly SIP Amount
  r = Monthly Rate of Return (Annual Rate ÷ 12 ÷ 100)
  n = Total Months (Years × 12)</code>
        </div>

        <h2>What is a SIP Calculator?</h2>
        <p>A SIP (Systematic Investment Plan) calculator helps you estimate the future value of your monthly mutual fund investments. By entering your monthly investment amount, expected annual return, and investment duration, you get an instant projection of your wealth creation.</p>

        <h2>How to Use This SIP Calculator</h2>
        <ul>
            <li><strong>Monthly Investment:</strong> Enter the fixed amount you plan to invest each month. Even ₹500/month can create significant wealth over time.</li>
            <li><strong>Expected Return:</strong> Historical equity mutual fund returns in India have ranged from 10–15% annually. Use 10–12% for a conservative estimate.</li>
            <li><strong>Duration:</strong> The longer you stay invested, the more powerful compounding becomes. Try 15–20 years to see the difference.</li>
        </ul>

        <h2>Benefits of SIP Investing</h2>
        <ul>
            <li><strong>Rupee Cost Averaging:</strong> You buy more units when prices are low and fewer when high, automatically averaging your purchase cost.</li>
            <li><strong>Power of Compounding:</strong> Returns are reinvested, so you earn returns on your returns — the longer you invest, the greater the effect.</li>
            <li><strong>Disciplined Saving:</strong> Auto-debit keeps you consistent without requiring manual action each month.</li>
            <li><strong>Flexibility:</strong> You can start with as low as ₹100/month and increase your SIP as income grows.</li>
        </ul>
    </div>
</div>
