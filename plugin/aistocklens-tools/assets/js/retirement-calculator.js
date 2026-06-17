/**
 * Retirement Calculator — Vanilla JS
 */
(function () {
    'use strict';

    function init() {
        var root = document.querySelector('#aslt-retirement');
        if (!root) return;

        document.getElementById('ret-calc-btn').addEventListener('click', calculate);
        ['ret-age','ret-retire-age','ret-monthly-expense','ret-inflation','ret-life-exp','ret-investment-return'].forEach(function(id){
            document.getElementById(id).addEventListener('input', calculate);
        });

        calculate();
    }

    function calculate() {
        var currentAge    = parseInt(document.getElementById('ret-age').value, 10);
        var retireAge     = parseInt(document.getElementById('ret-retire-age').value, 10);
        var monthlyExpense= parseFloat(document.getElementById('ret-monthly-expense').value);
        var inflation     = parseFloat(document.getElementById('ret-inflation').value) / 100;
        var lifeExp       = parseInt(document.getElementById('ret-life-exp').value, 10);
        var postReturnRate= parseFloat(document.getElementById('ret-investment-return').value) / 100;

        if (!isFinite(currentAge) || !isFinite(retireAge) || retireAge <= currentAge) return;
        if (!isFinite(monthlyExpense) || !isFinite(inflation) || !isFinite(lifeExp)) return;

        var yearsToRetire   = retireAge - currentAge;
        var retirementYears = lifeExp - retireAge;

        // Future monthly expense at retirement (inflation adjusted)
        var futureMonthlyExpense = monthlyExpense * Math.pow(1 + inflation, yearsToRetire);

        // Corpus needed using PV of annuity (real rate)
        var realRate   = (postReturnRate - inflation) / (1 + inflation);
        var monthlyReal= realRate / 12;
        var totalMonths= retirementYears * 12;
        var corpus;

        if (Math.abs(monthlyReal) < 0.0001) {
            corpus = futureMonthlyExpense * totalMonths;
        } else {
            corpus = futureMonthlyExpense * (1 - Math.pow(1 + monthlyReal, -totalMonths)) / monthlyReal;
        }

        // Monthly SIP needed to build corpus (assuming 12% return)
        var sipR  = 0.12 / 12 / 100 * 100; // 12% annual
        sipR      = 0.12 / 12;
        var sipN  = yearsToRetire * 12;
        var sipAmt= corpus * sipR / ((Math.pow(1 + sipR, sipN) - 1) * (1 + sipR));

        setText('ret-future-expense', '₹' + Math.round(futureMonthlyExpense).toLocaleString('en-IN') + '/mo');
        setText('ret-corpus',         formatINR(corpus));
        setText('ret-sip-needed',     '₹' + Math.round(sipAmt).toLocaleString('en-IN') + '/mo');

        document.getElementById('ret-results').classList.add('visible');
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
