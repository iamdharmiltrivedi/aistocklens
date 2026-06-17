<?php defined( 'ABSPATH' ) || exit; ?>
<div class="aslt-calc" id="aslt-cagr" role="region" aria-label="CAGR Calculator">

    <div class="aslt-card">
        <h2 style="margin:0 0 1.5rem;font-size:1.375rem;font-weight:700;color:#1A1A2E">CAGR Calculator</h2>

        <div class="aslt-grid aslt-grid--2">
            <div class="aslt-field">
                <label for="cagr-initial">Initial Investment Value</label>
                <div class="aslt-input-wrap">
                    <span class="aslt-prefix">₹</span>
                    <input type="number" id="cagr-initial" value="100000" min="1" placeholder="100000">
                </div>
            </div>

            <div class="aslt-field">
                <label for="cagr-final">Final Investment Value</label>
                <div class="aslt-input-wrap">
                    <span class="aslt-prefix">₹</span>
                    <input type="number" id="cagr-final" value="250000" min="1" placeholder="250000">
                </div>
            </div>

            <div class="aslt-field">
                <label for="cagr-years">Number of Years</label>
                <div class="aslt-input-wrap">
                    <input type="number" id="cagr-years" value="5" min="1" max="50" step="1" placeholder="5">
                    <span class="aslt-suffix">Years</span>
                </div>
                <div class="aslt-slider-row" style="margin-top:.5rem">
                    <input type="range" class="aslt-slider" id="cagr-years-range" min="1" max="30" step="1" value="5">
                    <span class="aslt-slider-val" id="cagr-years-val">5 yrs</span>
                </div>
            </div>
        </div>

        <button class="aslt-btn" id="cagr-calc-btn" type="button">Calculate CAGR</button>
    </div>

    <div class="aslt-results aslt-card" id="cagr-results" aria-live="polite">
        <div class="aslt-result-summary">
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Total Gain</div>
                <div class="aslt-result-box__value" id="cagr-gain" style="color:#16A34A">—</div>
            </div>
            <div class="aslt-result-box">
                <div class="aslt-result-box__label">Absolute Returns</div>
                <div class="aslt-result-box__value" id="cagr-abs">—</div>
            </div>
            <div class="aslt-result-box aslt-result-box--primary">
                <div class="aslt-result-box__label">CAGR</div>
                <div class="aslt-result-box__value" id="cagr-rate">—</div>
            </div>
        </div>
        <p id="cagr-context" style="text-align:center;color:#6B7280;font-size:.875rem;margin-top:.5rem"></p>
    </div>

    <div class="aslt-seo-section">
        <div class="aslt-formula">
            <div class="aslt-formula__title">CAGR Formula</div>
            <code>CAGR = (Final Value / Initial Value)^(1/n) - 1

Where:
  n = Number of Years</code>
        </div>
        <h2>What is CAGR?</h2>
        <p>CAGR (Compound Annual Growth Rate) is the rate at which an investment has grown from beginning to end value, assuming profits were reinvested each year. It's the most accurate way to compare performance of different investments over different time periods.</p>

        <h2>CAGR Benchmarks for Indian Investors</h2>
        <ul>
            <li><strong>Savings Account:</strong> ~3–4% CAGR</li>
            <li><strong>Fixed Deposit:</strong> ~6–8% CAGR</li>
            <li><strong>Debt Mutual Funds:</strong> ~6–9% CAGR</li>
            <li><strong>Nifty 50 (10yr avg):</strong> ~12–14% CAGR</li>
            <li><strong>Small Cap Funds:</strong> ~14–18% CAGR (higher risk)</li>
        </ul>
    </div>
</div>
