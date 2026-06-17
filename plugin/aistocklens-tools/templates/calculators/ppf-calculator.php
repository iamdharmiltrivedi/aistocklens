<?php defined( 'ABSPATH' ) || exit; ?>
<div class="aslt-calc" id="aslt-ppf" role="region" aria-label="PPF Calculator">

    <div class="aslt-card">
        <h2 style="margin:0 0 1.5rem;font-size:1.375rem;font-weight:700;color:#1A1A2E">PPF Calculator (Public Provident Fund)</h2>

        <div class="aslt-grid aslt-grid--2">
            <div class="aslt-field">
                <label for="ppf-amount">Yearly Contribution</label>
                <div class="aslt-input-wrap">
                    <span class="aslt-prefix">₹</span>
                    <input type="number" id="ppf-amount" value="150000" min="500" max="150000" step="500" placeholder="150000">
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="ppf-amount-range" min="500" max="150000" step="500" value="150000">
                    <span class="aslt-slider-val" id="ppf-amount-val">₹1.5 L</span>
                </div>
                <span class="aslt-field__hint">Max: ₹1,50,000 per year (Section 80C limit)</span>
            </div>

            <div class="aslt-field">
                <label for="ppf-rate">PPF Interest Rate</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="ppf-rate" value="7.1" min="5" max="12" step="0.05" placeholder="7.1">
                    <span class="aslt-suffix">%</span>
                </div>
                <span class="aslt-field__hint">Current rate: 7.1% p.a. (Apr–Jun 2025)</span>
            </div>

            <div class="aslt-field">
                <label for="ppf-years">Investment Duration</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="ppf-years" value="15" min="15" max="50" step="5" placeholder="15">
                    <span class="aslt-suffix">Years</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="ppf-years-range" min="15" max="50" step="5" value="15">
                    <span class="aslt-slider-val" id="ppf-years-val">15 yrs</span>
                </div>
                <span class="aslt-field__hint">Minimum 15 years; extendable in 5-year blocks</span>
            </div>
        </div>

        <button class="aslt-btn" id="ppf-calc-btn" type="button">Calculate PPF Maturity</button>
    </div>

    <div class="aslt-results aslt-card" id="ppf-results" aria-live="polite">
        <div class="aslt-result-summary">
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Total Invested</div>
                <div class="aslt-result-box__value" id="ppf-invested">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Interest Earned</div>
                <div class="aslt-result-box__value" id="ppf-interest" style="color:#16A34A">—</div>
            </div>
            <div class="aslt-result-box aslt-result-box--primary">
                <div class="aslt-result-box__label">Maturity Value</div>
                <div class="aslt-result-box__value" id="ppf-maturity">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Tax Saved (30% slab)</div>
                <div class="aslt-result-box__value" id="ppf-tax" style="color:#D97706">—</div>
            </div>
        </div>

        <button class="aslt-details-toggle" id="ppf-toggle-details" type="button" aria-expanded="false">
            📊 Show year-by-year breakdown ▼
        </button>
        <div class="aslt-details" id="ppf-details">
            <div class="aslt-breakdown-wrap">
                <table class="aslt-breakdown">
                    <thead>
                        <tr><th>Year</th><th>Contribution</th><th>Interest</th><th>Closing Balance</th></tr>
                    </thead>
                    <tbody id="ppf-table-body"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="aslt-seo-section">
        <div class="aslt-formula">
            <div class="aslt-formula__title">PPF Formula (Annual Compounding)</div>
            <code>F = P × { [(1 + r)ⁿ - 1] / r }

Where:
  F = Maturity Amount
  P = Annual Contribution
  r = Annual Interest Rate ÷ 100
  n = Number of Years</code>
        </div>
        <h2>PPF Investment Benefits</h2>
        <ul>
            <li><strong>EEE Tax Status:</strong> Investment, interest, and maturity are all tax-free under the Exempt-Exempt-Exempt regime.</li>
            <li><strong>Section 80C:</strong> Contributions up to ₹1.5 lakh qualify for deduction.</li>
            <li><strong>Loan Facility:</strong> You can take a loan against PPF from Year 3 to Year 6.</li>
            <li><strong>Partial Withdrawal:</strong> Allowed from Year 7 onwards, subject to limits.</li>
            <li><strong>Sovereign Guarantee:</strong> PPF is backed by the Government of India — zero credit risk.</li>
        </ul>
    </div>
</div>
