/**
 * FD Calculator — Vanilla JS
 */
(function () {
    'use strict';

    function init() {
        var root = document.querySelector('#aslt-fd');
        if (!root) return;

        syncPair('fd-principal', 'fd-principal-range', 'fd-principal-val', function(v){
            v = parseFloat(v);
            return v >= 100000 ? '₹' + (v/100000).toFixed(1) + ' L' : '₹' + Math.round(v).toLocaleString('en-IN');
        });
        syncPair('fd-rate',  'fd-rate-range',  'fd-rate-val',  function(v){ return v + '%'; });
        syncPair('fd-years', 'fd-years-range', 'fd-years-val', function(v){ return v + ' yrs'; });

        document.getElementById('fd-calc-btn').addEventListener('click', calculate);
        ['fd-principal','fd-rate','fd-years','fd-compound'].forEach(function(id){
            document.getElementById(id).addEventListener('input', calculate);
        });

        calculate();
    }

    function calculate() {
        var P = parseFloat(document.getElementById('fd-principal').value);
        var r = parseFloat(document.getElementById('fd-rate').value) / 100;
        var t = parseFloat(document.getElementById('fd-years').value);
        var n = parseFloat(document.getElementById('fd-compound').value);

        if (!isFinite(P) || !isFinite(r) || !isFinite(t) || !isFinite(n)) return;

        var A = P * Math.pow(1 + r / n, n * t);
        var interest = A - P;
        var gainPct  = ((interest / P) * 100).toFixed(1);

        setText('fd-invested',     formatINR(P));
        setText('fd-interest',     formatINR(interest));
        setText('fd-maturity',     formatINR(A));
        setText('fd-interest-pct', gainPct + '%');

        var pPct = (P / A) * 100;
        var iPct = (interest / A) * 100;
        setDonut('fd-donut-principal', pPct, 0);
        setDonut('fd-donut-interest',  iPct, -pPct);

        document.getElementById('fd-results').classList.add('visible');
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

    function setDonut(id, pct, offset) {
        var el = document.getElementById(id);
        if (!el) return;
        el.setAttribute('stroke-dasharray', pct.toFixed(2) + ' ' + (100 - pct).toFixed(2));
        el.setAttribute('stroke-dashoffset', offset.toFixed(2));
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
