/**
 * CAGR Calculator — Vanilla JS
 */
(function () {
    'use strict';

    function init() {
        var root = document.querySelector('#aslt-cagr');
        if (!root) return;

        syncPair('cagr-years', 'cagr-years-range', 'cagr-years-val', function(v){ return v + ' yrs'; });

        document.getElementById('cagr-calc-btn').addEventListener('click', calculate);
        ['cagr-initial','cagr-final','cagr-years'].forEach(function(id){
            document.getElementById(id).addEventListener('input', calculate);
        });

        calculate();
    }

    function calculate() {
        var initial = parseFloat(document.getElementById('cagr-initial').value);
        var final   = parseFloat(document.getElementById('cagr-final').value);
        var years   = parseFloat(document.getElementById('cagr-years').value);

        if (!isFinite(initial) || initial <= 0) return;
        if (!isFinite(final)   || final   <= 0) return;
        if (!isFinite(years)   || years   <= 0) return;

        var cagr    = (Math.pow(final / initial, 1 / years) - 1) * 100;
        var gain    = final - initial;
        var absPct  = ((gain / initial) * 100).toFixed(1);
        var context = getContext(cagr);

        setText('cagr-rate', cagr.toFixed(2) + '%');
        setText('cagr-gain', formatINR(gain));
        setText('cagr-abs',  absPct + '%');
        setText('cagr-context', context);

        document.getElementById('cagr-results').classList.add('visible');
    }

    function getContext(cagr) {
        if (cagr < 4)  return 'This is below savings account rates. Consider higher-yield instruments.';
        if (cagr < 8)  return 'Comparable to FD / debt fund returns.';
        if (cagr < 12) return 'Good — similar to Nifty 50 long-term average.';
        if (cagr < 18) return 'Excellent — above market average. Exceptional performance!';
        return 'Outstanding returns! Verify your inputs for accuracy.';
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
