/**
 * EMI Calculator — Vanilla JS
 */
(function () {
    'use strict';

    var SELECTOR = '#aslt-emi';

    function init() {
        var root = document.querySelector(SELECTOR);
        if (!root) return;

        syncPair('emi-principal', 'emi-principal-range', 'emi-principal-val', formatINRShort);
        syncPair('emi-rate',      'emi-rate-range',      'emi-rate-val',      function(v){ return v + '%'; });
        syncPair('emi-tenure',    'emi-tenure-range',    'emi-tenure-val',    function(v){ return v + ' yrs'; });

        document.getElementById('emi-calc-btn').addEventListener('click', calculate);
        ['emi-principal','emi-rate','emi-tenure'].forEach(function(id){
            document.getElementById(id).addEventListener('input', calculate);
        });

        var toggleBtn  = document.getElementById('emi-toggle-details');
        var detailsEl  = document.getElementById('emi-details');
        toggleBtn && toggleBtn.addEventListener('click', function () {
            detailsEl.classList.toggle('visible');
            var open = detailsEl.classList.contains('visible');
            toggleBtn.setAttribute('aria-expanded', String(open));
            toggleBtn.textContent = open ? '📊 Hide amortization schedule ▲' : '📊 Show amortization schedule ▼';
        });

        calculate();
    }

    function calculate() {
        var P = parseFloat(document.getElementById('emi-principal').value);
        var annualRate = parseFloat(document.getElementById('emi-rate').value);
        var years = parseInt(document.getElementById('emi-tenure').value, 10);

        if (!isFinite(P) || P <= 0) return;
        if (!isFinite(annualRate) || annualRate <= 0) return;
        if (!isFinite(years) || years <= 0) return;

        var r = annualRate / 12 / 100;
        var n = years * 12;
        var emi = P * r * Math.pow(1 + r, n) / (Math.pow(1 + r, n) - 1);
        var totalPayment = emi * n;
        var totalInterest = totalPayment - P;
        var interestPct = ((totalInterest / totalPayment) * 100).toFixed(1);

        setText('emi-principal-out',  formatINR(P));
        setText('emi-interest-out',   formatINR(totalInterest));
        setText('emi-monthly-out',    formatINR(emi));
        setText('emi-total-out',      formatINR(totalPayment));
        setText('emi-interest-pct',   interestPct + '%');

        // Donut
        var pPct = (P / totalPayment) * 100;
        var iPct = (totalInterest / totalPayment) * 100;
        setDonut('emi-donut-principal', pPct, 0);
        setDonut('emi-donut-interest',  iPct, -pPct);

        // Amortization table
        buildTable(P, r, n, emi, years);

        document.getElementById('emi-results').classList.add('visible');
    }

    function buildTable(P, r, n, emi, years) {
        var tbody = document.getElementById('emi-table-body');
        if (!tbody) return;
        tbody.innerHTML = '';
        var balance = P;
        for (var y = 1; y <= years; y++) {
            var yearPrincipal = 0;
            var yearInterest  = 0;
            for (var m = 0; m < 12 && (y - 1) * 12 + m < n; m++) {
                var intPmt  = balance * r;
                var prinPmt = emi - intPmt;
                yearInterest  += intPmt;
                yearPrincipal += prinPmt;
                balance -= prinPmt;
            }
            if (balance < 0) balance = 0;
            var tr = document.createElement('tr');
            tr.innerHTML = '<td>Year ' + y + '</td>' +
                           '<td>' + formatINR(yearPrincipal) + '</td>' +
                           '<td>' + formatINR(yearInterest)  + '</td>' +
                           '<td style="font-weight:700">' + formatINR(Math.max(0, balance)) + '</td>';
            tbody.appendChild(tr);
        }
    }

    function syncPair(inputId, rangeId, displayId, fmt) {
        var input   = document.getElementById(inputId);
        var range   = document.getElementById(rangeId);
        var display = document.getElementById(displayId);
        if (!input || !range) return;
        function update(val) {
            if (display) display.textContent = fmt(val);
            var min = parseFloat(range.min), max = parseFloat(range.max);
            var pct = ((val - min) / (max - min)) * 100;
            range.style.setProperty('--val', pct.toFixed(1) + '%');
        }
        input.addEventListener('input', function () { range.value = this.value; update(this.value); });
        range.addEventListener('input', function () { input.value = this.value; update(this.value); });
        update(input.value);
    }

    function setDonut(id, pct, offset) {
        var el = document.getElementById(id);
        if (!el) return;
        el.setAttribute('stroke-dasharray', pct.toFixed(2) + ' ' + (100 - pct).toFixed(2));
        el.setAttribute('stroke-dashoffset', offset.toFixed(2));
    }

    function setText(id, text) {
        var el = document.getElementById(id);
        if (el) el.textContent = text;
    }

    function formatINR(n) {
        n = Math.round(n);
        if (n >= 10000000) return '₹' + (n / 10000000).toFixed(2) + ' Cr';
        if (n >= 100000)   return '₹' + (n / 100000).toFixed(2)   + ' L';
        return '₹' + n.toLocaleString('en-IN');
    }

    function formatINRShort(n) {
        n = parseFloat(n);
        if (n >= 10000000) return '₹' + (n / 10000000).toFixed(1) + ' Cr';
        if (n >= 100000)   return '₹' + (n / 100000).toFixed(1)   + ' L';
        return '₹' + Math.round(n).toLocaleString('en-IN');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
}());
