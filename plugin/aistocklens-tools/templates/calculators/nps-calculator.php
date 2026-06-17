<?php defined( 'ABSPATH' ) || exit; ?>
<div class="aslt-calc" id="aslt-nps" role="region" aria-label="NPS Calculator">

    <div class="aslt-card">
        <h2 style="margin:0 0 1.5rem;font-size:1.375rem;font-weight:700;color:#1A1A2E">NPS Calculator (National Pension Scheme)</h2>

        <div class="aslt-grid aslt-grid--2">
            <div class="aslt-field">
                <label for="nps-monthly">Monthly Contribution</label>
                <div class="aslt-input-wrap">
                    <span class="aslt-prefix">₹</span>
                    <input type="number" id="nps-monthly" value="5000" min="500" max="500000" step="500" placeholder="5000">
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="nps-monthly-range" min="500" max="50000" step="500" value="5000">
                    <span class="aslt-slider-val" id="nps-monthly-val">₹5,000</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="nps-age">Current Age</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="nps-age" value="30" min="18" max="60" step="1" placeholder="30">
                    <span class="aslt-suffix">Years</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="nps-age-range" min="18" max="60" step="1" value="30">
                    <span class="aslt-slider-val" id="nps-age-val">30 yrs</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="nps-return">Expected Annual Return</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="nps-return" value="10" min="5" max="18" step="0.5" placeholder="10">
                    <span class="aslt-suffix">%</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="nps-return-range" min="5" max="18" step="0.5" value="10">
                    <span class="aslt-slider-val" id="nps-return-val">10%</span>
                </div>
            </div>

            <div class="aslt-field">
                <label for="nps-annuity">Annuity Rate</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="nps-annuity" value="6" min="4" max="10" step="0.25" placeholder="6">
                    <span class="aslt-suffix">%</span>
                </div>
                <span class="aslt-field__hint">Pension income rate from annuity corpus (40% of NPS corpus)</span>
            </div>
        </div>

        <button class="aslt-btn" id="nps-calc-btn" type="button">Calculate NPS Retirement</button>
    </div>

    <div class="aslt-results aslt-card" id="nps-results" aria-live="polite">
        <div class="aslt-result-summary">
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Total Invested</div>
                <div class="aslt-result-box__value" id="nps-invested">—</div>
            </div>
            <div class="aslt-result-box aslt-result-box--primary">
                <div class="aslt-result-box__label">NPS Corpus at 60</div>
                <div class="aslt-result-box__value" id="nps-corpus">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Lump Sum (60%)</div>
                <div class="aslt-result-box__value" id="nps-lumpsum">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Monthly Pension</div>
                <div class="aslt-result-box__value" id="nps-pension" style="color:#16A34A">—</div>
            </div>
        </div>
    </div>

    <div class="aslt-seo-section">
        <div class="aslt-formula">
            <div class="aslt-formula__title">NPS Corpus Formula</div>
            <code>Corpus = M × { [(1 + r)ⁿ - 1] / r } × (1 + r)

Monthly Pension = (Corpus × 40% × Annuity Rate) / 12

Where:
  M = Monthly Contribution
  r = Monthly Return (Annual ÷ 12 ÷ 100)
  n = Months to Retirement (Age 60 - Current Age) × 12</code>
        </div>
        <h2>NPS Withdrawal Rules</h2>
        <ul>
            <li><strong>60% Lump Sum:</strong> Tax-free on maturity at age 60.</li>
            <li><strong>40% Annuity:</strong> Must be used to buy an annuity, which pays monthly pension. Annuity income is taxable.</li>
            <li><strong>Early Exit:</strong> After 3 years, up to 25% can be withdrawn for specific purposes.</li>
            <li><strong>Tax Benefits:</strong> Contributions up to ₹1.5L under Sec 80C + additional ₹50,000 under Sec 80CCD(1B).</li>
        </ul>
    </div>
</div>
