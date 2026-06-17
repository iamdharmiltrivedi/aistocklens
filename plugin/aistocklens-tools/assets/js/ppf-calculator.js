/**
 * PPF Calculator — Vanilla JS
 */
(function () {
    'use strict';

    function init() {
        var root = document.querySelector('#aslt-ppf');
        if (!root) return;

        syncPair('ppf-amount', 'ppf-amount-range', 'ppf-amount-val', function(v){
            return v >= 100000 ? '₹' + (v/100000).toFixed(1) + ' L' : '₹' + Math.round(v).toLocaleString('en-IN');
        });
        syncPair('ppf-years', 'ppf-years-range', 'ppf-years-val', function(v){ return v + ' yrs'; });

        document.getElementById('ppf-calc-btn').addEventListener('click', calculate);
        ['ppf-amount','ppf-rate','ppf-years'].forEach(function(id){
            document.getElementById(id).addEventListener('input', calculate);
        });

        var toggleBtn = document.getElementById('ppf-toggle-details');
        var detailsEl = document.getElementById('ppf-details');
        toggleBtn && toggleBtn.addEventListener('click', function () {
            detailsEl.classList.toggle('visible');
            var open = detailsEl.classList.contains('visible');
            toggleBtn.setAttribute('aria-expanded', String(open));
            toggleBtn.textContent = open ? '📊 Hide year-by-year breakdown ▲' : '📊 Show year-by-year breakdown ▼';
        });

        calculate();
    }

    function calculate() {
        var P = parseFloat(document.getElementById('ppf-amount').value);
        var r = parseFloat(document.getElementById('ppf-rate').value) / 100;
        var n = parseInt(document.getElementById('ppf-years').value, 10);

        if (!isFinite(P) || !isFinite(r) || !isFinite(n)) return;

        // PPF compounds annually, contribution at beginning of year
        var maturity = 0;
        var tbody    = document.getElementById('ppf-table-body');
        if (tbody) tbody.innerHTML = '';

        var balance = 0;
        for (var y = 1; y <= n; y++) {
            balance = (balance + P) * (1 + r);
            var interest = balance - P * y;
            if (tbody) {
                var tr = document.createElement('tr');
                tr.innerHTML = '<td>Year ' + y + '</td>' +
                               '<td>' + formatINR(P * y) + '</td>' +
                               '<td>' + formatINR(balance - P * y) + '</td>' +
                               '<td style="font-weight:700">' + formatINR(balance) + '</td>';
                tbody.appendChild(tr);
            }
        }
        maturity = balance;
        var invested    = P * n;
        var interestEarned = maturity - invested;
        var taxSaved    = Math.min(P, 150000) * n * 0.30; // simplified 30% slab

        setText('ppf-invested',  formatINR(invested));
        setText('ppf-interest',  formatINR(interestEarned));
        setText('ppf-maturity',  formatINR(maturity));
        setText('ppf-tax',       formatINR(taxSaved));

        document.getElementById('ppf-results').classList.add('visible');
    }

    function syncPair(inputId, rangeId, displayId, fmt) {
        var input = document.getElementById(inputId);
        var range = document.getElementById(rangeId);
        var disp  = document.getElementById(displayId);
        if (!input || !range) return;
        function update(v) {
            if (disp) disp.textContent = fmt(v);
            var pct = ((v - range.min) / (range.max - range.min)) * 100;
            range.style.setProperty('--val', pct.toFixed(1) + '%');
        }
        input.addEventListener('input', function(){ range.value = this.value; update(this.value); });
        range.addEventListener('input', function(){ input.value = this.value; update(this.value); });
        update(input.value);
    }

    function setText(id, text) { var el = document.getElementById(id); if (el) el.textContent = text; }

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
