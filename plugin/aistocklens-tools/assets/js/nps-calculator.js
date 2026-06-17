/**
 * NPS Calculator — Vanilla JS
 */
(function () {
    'use strict';

    function init() {
        var root = document.querySelector('#aslt-nps');
        if (!root) return;

        syncPair('nps-monthly', 'nps-monthly-range', 'nps-monthly-val', function(v){
            return '₹' + parseFloat(v).toLocaleString('en-IN');
        });
        syncPair('nps-age',    'nps-age-range',    'nps-age-val',    function(v){ return v + ' yrs'; });
        syncPair('nps-return', 'nps-return-range', 'nps-return-val', function(v){ return v + '%'; });

        document.getElementById('nps-calc-btn').addEventListener('click', calculate);
        ['nps-monthly','nps-age','nps-return','nps-annuity'].forEach(function(id){
            document.getElementById(id).addEventListener('input', calculate);
        });

        calculate();
    }

    function calculate() {
        var monthly      = parseFloat(document.getElementById('nps-monthly').value);
        var currentAge   = parseInt(document.getElementById('nps-age').value, 10);
        var annualReturn = parseFloat(document.getElementById('nps-return').value);
        var annuityRate  = parseFloat(document.getElementById('nps-annuity').value) / 100;

        if (!isFinite(monthly) || !isFinite(currentAge) || !isFinite(annualReturn) || !isFinite(annuityRate)) return;
        if (currentAge >= 60) return;

        var r       = annualReturn / 12 / 100;
        var months  = (60 - currentAge) * 12;
        var corpus  = monthly * (Math.pow(1 + r, months) - 1) / r * (1 + r);
        var invested = monthly * months;
        var lumpsum  = corpus * 0.60;
        var annuityCorpus = corpus * 0.40;
        var monthlyPension = (annuityCorpus * annuityRate) / 12;

        setText('nps-invested',       formatINR(invested));
        setText('nps-corpus',         formatINR(corpus));
        setText('nps-lumpsum',        formatINR(lumpsum));
        setText('nps-pension',        '₹' + Math.round(monthlyPension).toLocaleString('en-IN') + '/mo');

        document.getElementById('nps-results').classList.add('visible');
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
