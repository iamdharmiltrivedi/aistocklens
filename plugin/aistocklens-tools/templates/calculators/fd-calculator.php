<?php defined( 'ABSPATH' ) || exit; ?>
<div class="aslt-calc" id="aslt-fd" role="region" aria-label="FD Calculator">

    <div class="aslt-card">
        <h2 style="margin:0 0 1.5rem;font-size:1.375rem;font-weight:700;color:#1A1A2E">Fixed Deposit (FD) Calculator</h2>

        <div class="aslt-grid aslt-grid--2">
            <div class="aslt-field">
                <label for="fd-principal">Principal Amount</label>
                <div class="aslt-input-wrap">
                    <span class="aslt-prefix">₹</span>
                    <input type="number" id="fd-principal" value="100000" min="1000" max="100000000" step="5000" placeholder="100000">
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="fd-principal-range" min="5000" max="5000000" step="5000" value="100000">
                    <span class="aslt-slider-val" id="fd-principal-val">₹1 L</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="fd-rate">Annual Interest Rate</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="fd-rate" value="7" min="1" max="15" step="0.05" placeholder="7">
                    <span class="aslt-suffix">%</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="fd-rate-range" min="1" max="12" step="0.25" value="7">
                    <span class="aslt-slider-val" id="fd-rate-val">7%</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="fd-years">Duration</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="fd-years" value="5" min="1" max="20" step="1" placeholder="5">
                    <span class="aslt-suffix">Years</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="fd-years-range" min="1" max="20" step="1" value="5">
                    <span class="aslt-slider-val" id="fd-years-val">5 yrs</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="fd-compound">Compounding Frequency</label>
                <div class="aslt-input-wrap">
                    <select id="fd-compound" style="padding:.75rem 1rem;flex:1;border:none;background:transparent;font-family:inherit;font-size:.9375rem;color:#111827;outline:none">
                        <option value="4">Quarterly</option>
                        <option value="2">Half-Yearly</option>
                        <option value="1">Annually</option>
                        <option value="12">Monthly</option>
                    </select>
                </div>
            </div>
        </div>

        <button class="aslt-btn" id="fd-calc-btn" type="button">Calculate FD Maturity</button>
    </div>

    <div class="aslt-results aslt-card" id="fd-results" aria-live="polite">
        <div class="aslt-result-summary">
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Principal Invested</div>
                <div class="aslt-result-box__value" id="fd-invested">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Total Interest Earned</div>
                <div class="aslt-result-box__value" id="fd-interest" style="color:#16A34A">—</div>
            </div>
            <div class="aslt-result-box aslt-result-box--primary">
                <div class="aslt-result-box__label">Maturity Amount</div>
                <div class="aslt-result-box__value" id="fd-maturity">—</div>
            </div>
        </div>

        <div class="aslt-chart-wrap">
            <div class="aslt-donut" role="img" aria-label="FD Principal vs Interest">
                <svg viewBox="0 0 36 36" aria-hidden="true">
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#E5E7EB" stroke-width="3.2"/>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#1565C0" stroke-width="3.2"
                            stroke-dasharray="0 100" id="fd-donut-principal" stroke-linecap="round"/>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#16A34A" stroke-width="3.2"
                            stroke-dasharray="0 100" id="fd-donut-interest" stroke-linecap="round"/>
                </svg>
                <div class="aslt-donut__center">
                    <strong id="fd-interest-pct">—</strong>
                    <span>returns</span>
                </div>
            </div>
            <ul class="aslt-legend">
                <li><span class="aslt-legend-dot" style="background:#1565C0"></span>Principal</li>
                <li><span class="aslt-legend-dot" style="background:#16A34A"></span>Interest Earned</li>
            </ul>
        </div>
    </div>

    <div class="aslt-seo-section">
        <div class="aslt-formula">
            <div class="aslt-formula__title">Compound Interest Formula (FD)</div>
            <code>A = P × (1 + r/n)^(n×t)

Where:
  A = Maturity Amount
  P = Principal Amount
  r = Annual Interest Rate (as decimal)
  n = Compounding Frequency per year
  t = Time in Years</code>
        </div>
        <h2>What is an FD Calculator?</h2>
        <p>A Fixed Deposit (FD) calculator computes the maturity value of your lump sum investment at a bank or NBFC, based on the interest rate and compounding frequency. Most Indian banks offer quarterly compounding on FDs.</p>

        <h2>FD vs Mutual Funds</h2>
        <ul>
            <li>FDs offer guaranteed returns — ideal for capital preservation and short-term goals.</li>
            <li>Equity mutual funds have historically delivered 10–14% CAGR but carry market risk.</li>
            <li>FD interest is taxable as per your income slab; equity LTCG above ₹1 lakh is taxed at 10%.</li>
            <li>Senior citizens get 0.25–0.5% higher FD rates at most banks.</li>
        </ul>
    </div>
</div>
