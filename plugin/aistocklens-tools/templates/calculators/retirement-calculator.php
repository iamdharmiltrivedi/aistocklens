<?php defined( 'ABSPATH' ) || exit; ?>
<div class="aslt-calc" id="aslt-retirement" role="region" aria-label="Retirement Calculator">

    <div class="aslt-card">
        <h2 style="margin:0 0 1.5rem;font-size:1.375rem;font-weight:700;color:#1A1A2E">Retirement Planning Calculator</h2>

        <div class="aslt-grid aslt-grid--2">
            <div class="aslt-field">
                <label for="ret-age">Current Age</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="ret-age" value="30" min="18" max="59" step="1" placeholder="30">
                    <span class="aslt-suffix">Years</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="ret-retire-age">Retirement Age</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="ret-retire-age" value="60" min="40" max="70" step="1" placeholder="60">
                    <span class="aslt-suffix">Years</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="ret-monthly-expense">Current Monthly Expenses</label>
                <div class="aslt-input-wrap">
                    <span class="aslt-prefix">₹</span>
                    <input type="number" id="ret-monthly-expense" value="50000" min="5000" max="1000000" step="1000" placeholder="50000">
                </div>
            </div>

            <div class="aslt-field">
                <label for="ret-inflation">Inflation Rate</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="ret-inflation" value="6" min="2" max="15" step="0.5" placeholder="6">
                    <span class="aslt-suffix">%</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="ret-life-exp">Life Expectancy</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="ret-life-exp" value="85" min="70" max="100" step="1" placeholder="85">
                    <span class="aslt-suffix">Years</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="ret-investment-return">Expected Return (Post-Retirement)</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="ret-investment-return" value="8" min="4" max="15" step="0.5" placeholder="8">
                    <span class="aslt-suffix">%</span>
                </div>
            </div>
        </div>

        <button class="aslt-btn" id="ret-calc-btn" type="button">Calculate Retirement Corpus Needed</button>
    </div>

    <div class="aslt-results aslt-card" id="ret-results" aria-live="polite">
        <div class="aslt-result-summary">
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Monthly Expense at Retirement</div>
                <div class="aslt-result-box__value" id="ret-future-expense">—</div>
            </div>
            <div class="aslt-result-box aslt-result-box--primary">
                <div class="aslt-result-box__label">Corpus Required</div>
                <div class="aslt-result-box__value" id="ret-corpus">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Monthly SIP Needed</div>
                <div class="aslt-result-box__value" id="ret-sip-needed" style="color:#16A34A">—</div>
            </div>
        </div>
        <p style="text-align:center;color:#6B7280;font-size:.8125rem;margin-top:1rem">
            * Monthly SIP assumes 12% annual return during accumulation phase.
        </p>
    </div>

    <div class="aslt-seo-section">
        <h2>How to Plan for Retirement in India</h2>
        <ul>
            <li><strong>Start Early:</strong> Starting at 25 vs 35 can reduce required monthly savings by 60%+ due to compounding.</li>
            <li><strong>Account for Inflation:</strong> At 6% inflation, expenses double every 12 years. Your retirement corpus must outpace this.</li>
            <li><strong>Diversify:</strong> Combine PPF, NPS, equity mutual funds, and fixed income for a balanced retirement portfolio.</li>
            <li><strong>Healthcare Buffer:</strong> Add 20–30% extra to the corpus estimate for medical expenses in later years.</li>
        </ul>
    </div>
</div>
