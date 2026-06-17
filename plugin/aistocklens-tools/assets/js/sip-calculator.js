/**
 * SIP Calculator — Vanilla JS
 * No dependencies. Indian currency formatting.
 */
(function () {
    'use strict';

    var SELECTOR = '#aslt-sip';

    function init() {
        var root = document.querySelector(SELECTOR);
        if (!root) return;

        var amtInput   = root.querySelector('#sip-amount');
        var rateInput  = root.querySelector('#sip-rate');
        var yearsInput = root.querySelector('#sip-years');
        var amtRange   = root.querySelector('#sip-amount-range');
        var rateRange  = root.querySelector('#sip-rate-range');
        var yearsRange = root.querySelector('#sip-years-range');
        var calcBtn    = root.querySelector('#sip-calc-btn');
        var resultsEl  = root.querySelector('#sip-results');
        var toggleBtn  = root.querySelector('#sip-toggle-details');
        var detailsEl  = root.querySelector('#sip-details');

        // Sync sliders ↔ inputs
        syncPair(amtInput,   amtRange,   root.querySelector('#sip-amount-val'),  formatINR,    ' ');
        syncPair(rateInput,  rateRange,  root.querySelector('#sip-rate-val'),    function(v){ return v + '%'; });
        syncPair(yearsInput, yearsRange, root.querySelector('#sip-years-val'),   function(v){ return v + ' yrs'; });

        calcBtn.addEventListener('click', calculate);
        amtInput.addEventListener('input',   calculate);
        rateInput.addEventListener('input',  calculate);
        yearsInput.addEventListener('input', calculate);

        toggleBtn && toggleBtn.addEventListener('click', function () {
            detailsEl.classList.toggle('visible');
            var open = detailsEl.classList.contains('visible');
            toggleBtn.setAttribute('aria-expanded', String(open));
            toggleBtn.textContent = open
                ? '📊 Hide year-by-year breakdown ▲'
                : '📊 Show year-by-year breakdown ▼';
        });

        calculate(); // Initial render
    }

    function calculate() {
        var root  = document.querySelector(SELECTOR);
        var amt   = parseFloat(document.getElementById('sip-amount').value);
        var rate  = parseFloat(document.getElementById('sip-rate').value);
        var years = parseInt(document.getElementById('sip-years').value, 10);

        var valid = true;
        valid = validate('sip-amount', isFinite(amt) && amt >= 100 && amt <= 10000000, 'sip-amount-err') && valid;
        valid = validate('sip-rate',   isFinite(rate) && rate >= 1 && rate <= 50,      'sip-rate-err')   && valid;
        valid = validate('sip-years',  isFinite(years) && years >= 1 && years <= 40,  'sip-years-err')  && valid;
        if (!valid) return;

        var r = rate / 12 / 100;
        var n = years * 12;

        var maturity = amt * (Math.pow(1 + r, n) - 1) / r * (1 + r);
        var invested = amt * n;
        var returns  = maturity - invested;
        var gainPct  = ((returns / invested) * 100).toFixed(1);

        // Update summary
        setText('sip-invested', formatINR(invested));
        setText('sip-returns',  formatINR(returns));
        setText('sip-maturity', formatINR(maturity));
        setText('sip-donut-pct', gainPct + '%');

        // Update donut
        updateDonut('sip-donut-invested', 'sip-donut-returns', invested, returns, maturity);

        // Year-by-year table
        buildTable(amt, r, years);

        // Show results
        document.getElementById('sip-results').classList.add('visible');
    }

    function buildTable(amt, r, years) {
        var tbody = document.getElementById('sip-table-body');
        if (!tbody) return;
        tbody.innerHTML = '';
        var value = 0;

        for (var y = 1; y <= years; y++) {
            var monthsTotal = y * 12;
            var monthsPrev  = (y - 1) * 12;
            var totalValue  = amt * (Math.pow(1 + r, monthsTotal) - 1) / r * (1 + r);
            var prevValue   = monthsPrev > 0 ? amt * (Math.pow(1 + r, monthsPrev) - 1) / r * (1 + r) : 0;
            var invested    = amt * monthsTotal;
            var returns     = totalValue - invested;
            var tr = document.createElement('tr');
            tr.innerHTML = '<td>Year ' + y + '</td>' +
                           '<td>' + formatINR(invested)   + '</td>' +
                           '<td>' + formatINR(returns)    + '</td>' +
                           '<td style="font-weight:700">' + formatINR(totalValue) + '</td>';
            tbody.appendChild(tr);
        }
    }

    // ---- Helpers ----
    function syncPair(input, range, display, fmt) {
        function update(val) {
            if (display) display.textContent = fmt(val);
            var min = parseFloat(range.min);
            var max = parseFloat(range.max);
            var pct = ((val - min) / (max - min)) * 100;
            range.style.setProperty('--val', pct.toFixed(1) + '%');
        }
        input.addEventListener('input', function () {
            range.value = this.value;
            update(this.value);
        });
        range.addEventListener('input', function () {
            input.value = this.value;
            update(this.value);
        });
        update(input.value);
    }

    function validate(inputId, condition, errId) {
        var wrap = document.getElementById(inputId) && document.getElementById(inputId).closest('.aslt-input-wrap');
        var err  = document.getElementById(errId);
        if (!condition) {
            if (wrap) wrap.classList.add('has-error');
            if (err)  err.classList.add('visible');
            return false;
        }
        if (wrap) wrap.classList.remove('has-error');
        if (err)  err.classList.remove('visible');
        return true;
    }

    function setText(id, text) {
        var el = document.getElementById(id);
        if (el) el.textContent = text;
    }

    function updateDonut(investedId, returnsId, invested, returns, total) {
        var investedEl = document.getElementById(investedId);
        var returnsEl  = document.getElementById(returnsId);
        if (!investedEl || !returnsEl) return;
        var circum = 100;
        var investedPct = (invested / total) * circum;
        var returnsPct  = (returns  / total) * circum;
        investedEl.setAttribute('stroke-dasharray', investedPct.toFixed(2) + ' ' + (circum - investedPct).toFixed(2));
        returnsEl.setAttribute('stroke-dasharray',  returnsPct.toFixed(2)  + ' ' + (circum - returnsPct).toFixed(2));
        returnsEl.setAttribute('stroke-dashoffset', -(investedPct).toFixed(2));
    }

    function formatINR(n) {
        n = Math.round(n);
        if (n >= 10000000) return '₹' + (n / 10000000).toFixed(2) + ' Cr';
        if (n >= 100000)   return '₹' + (n / 100000).toFixed(2)   + ' L';
        return '₹' + n.toLocaleString('en-IN');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
}());
