<?php defined( 'ABSPATH' ) || exit; ?>
<div class="aslt-calc" id="aslt-emi" role="region" aria-label="EMI Calculator">

    <div class="aslt-card">
        <h2 style="margin:0 0 1.5rem;font-size:1.375rem;font-weight:700;color:#1A1A2E">EMI Calculator</h2>

        <div class="aslt-grid aslt-grid--2">
            <!-- Loan Amount -->
            <div class="aslt-field">
                <label for="emi-principal">Loan Amount</label>
                <div class="aslt-input-wrap">
                    <span class="aslt-prefix">₹</span>
                    <input type="number" id="emi-principal" value="1000000" min="1000" max="100000000" step="10000" placeholder="1000000">
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="emi-principal-range" min="100000" max="10000000" step="50000" value="1000000">
                    <span class="aslt-slider-val" id="emi-principal-val">₹10 L</span>
                </div>
            </div>

            <!-- Interest Rate -->
            <div class="aslt-field">
                <label for="emi-rate">Annual Interest Rate</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="emi-rate" value="8.5" min="1" max="36" step="0.05" placeholder="8.5">
                    <span class="aslt-suffix">%</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="emi-rate-range" min="1" max="24" step="0.25" value="8.5">
                    <span class="aslt-slider-val" id="emi-rate-val">8.5%</span>
                </div>
            </div>

            <!-- Tenure -->
            <div class="aslt-field">
                <label for="emi-tenure">Loan Tenure</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="emi-tenure" value="20" min="1" max="30" step="1" placeholder="20">
                    <span class="aslt-suffix">Years</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="emi-tenure-range" min="1" max="30" step="1" value="20">
                    <span class="aslt-slider-val" id="emi-tenure-val">20 yrs</span>
                </div>
            </div>
        </div>

        <button class="aslt-btn" id="emi-calc-btn" type="button">Calculate EMI</button>
    </div>

    <div class="aslt-results aslt-card" id="emi-results" aria-live="polite">
        <div class="aslt-result-summary">
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Principal Amount</div>
                <div class="aslt-result-box__value" id="emi-principal-out">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Total Interest</div>
                <div class="aslt-result-box__value" id="emi-interest-out" style="color:#DC2626">—</div>
            </div>
            <div class="aslt-result-box aslt-result-box--primary">
                <div class="aslt-result-box__label">Monthly EMI</div>
                <div class="aslt-result-box__value" id="emi-monthly-out">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Total Payment</div>
                <div class="aslt-result-box__value" id="emi-total-out">—</div>
            </div>
        </div>

        <div class="aslt-chart-wrap">
            <div class="aslt-donut" role="img" aria-label="Principal vs interest pie chart">
                <svg viewBox="0 0 36 36" aria-hidden="true">
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#E5E7EB" stroke-width="3.2"/>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#1565C0" stroke-width="3.2"
                            stroke-dasharray="0 100" id="emi-donut-principal" stroke-linecap="round"/>
                    <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#DC2626" stroke-width="3.2"
                            stroke-dasharray="0 100" id="emi-donut-interest" stroke-linecap="round"/>
                </svg>
                <div class="aslt-donut__center">
                    <strong id="emi-interest-pct">—</strong>
                    <span>interest</span>
                </div>
            </div>
            <ul class="aslt-legend">
                <li><span class="aslt-legend-dot" style="background:#1565C0"></span>Principal Amount</li>
                <li><span class="aslt-legend-dot" style="background:#DC2626"></span>Total Interest</li>
            </ul>
        </div>

        <button class="aslt-details-toggle" id="emi-toggle-details" type="button" aria-expanded="false">
            📊 Show amortization schedule ▼
        </button>
        <div class="aslt-details" id="emi-details">
            <div class="aslt-breakdown-wrap">
                <table class="aslt-breakdown" aria-label="EMI amortization schedule">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Principal Paid</th>
                            <th>Interest Paid</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody id="emi-table-body"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="aslt-seo-section">
        <div class="aslt-formula">
            <div class="aslt-formula__title">EMI Formula</div>
            <code>EMI = P × r × (1 + r)ⁿ / [(1 + r)ⁿ - 1]

Where:
  P = Principal Loan Amount
  r = Monthly Interest Rate (Annual Rate ÷ 12 ÷ 100)
  n = Total Months (Tenure in Years × 12)</code>
        </div>

        <h2>What is an EMI Calculator?</h2>
        <p>An EMI (Equated Monthly Instalment) calculator helps you plan your loan repayments. Whether it's a home loan, car loan, or personal loan, knowing your monthly outgo in advance helps you budget effectively and choose the right loan tenure.</p>

        <h2>How to Reduce Your EMI</h2>
        <ul>
            <li><strong>Larger Down Payment:</strong> Reduces the principal, which directly reduces EMI.</li>
            <li><strong>Longer Tenure:</strong> Spreads payments over more months, lowering EMI — but increases total interest.</li>
            <li><strong>Better Credit Score:</strong> A CIBIL score above 750 helps you negotiate lower interest rates.</li>
            <li><strong>Balance Transfer:</strong> Move to a lender offering a lower rate if you're mid-loan.</li>
        </ul>
    </div>
</div>
