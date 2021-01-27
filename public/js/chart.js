(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/chart"],{

/***/ "./resources/js/Chart.js/chart.js":
/*!****************************************!*\
  !*** ./resources/js/Chart.js/chart.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

window.addEventListener("load", function () {
  var chart;
  Chart.defaults.global.defaultFontFamily = '"Almarai", sans-serif';
  Chart.defaults.global.defaultFontSize = 14;
  axios.get("/api/stats/chart").then(function (res) {
    var _ref, _ref2, _ref3, _ref4;

    // console.log(res.data);
    chart = res.data;
    createChart({
      id: 'chart-count',
      type: 'line',
      data: {
        labels: Object.keys(chart.purchases['count']),
        datasets: [(_ref = {
          label: lang('app.common.purchases'),
          data: Object.values(chart.purchases['count']),
          borderWidth: 1,
          fill: false,
          borderColor: '#0080ff'
        }, _defineProperty(_ref, "borderWidth", 4), _defineProperty(_ref, "lineTension", 0), _ref), (_ref2 = {
          label: lang('app.common.sales'),
          data: Object.values(chart.sales['count']),
          borderWidth: 1,
          fill: false,
          borderColor: '#f32f2f'
        }, _defineProperty(_ref2, "borderWidth", 4), _defineProperty(_ref2, "lineTension", 0), _ref2)]
      }
    });
    createChart({
      id: 'chart-profits',
      type: 'bar',
      data: {
        labels: Object.keys(chart.purchases['profits']),
        datasets: [(_ref3 = {
          label: lang('app.common.purchases'),
          data: Object.values(chart.purchases['profits']),
          borderWidth: 1,
          fill: false,
          backgroundColor: '#0080ff'
        }, _defineProperty(_ref3, "borderWidth", 4), _defineProperty(_ref3, "lineTension", 0), _ref3), (_ref4 = {
          label: lang('app.common.sales'),
          data: Object.values(chart.sales['profits']),
          borderWidth: 1,
          fill: false,
          backgroundColor: '#f32f2f'
        }, _defineProperty(_ref4, "borderWidth", 4), _defineProperty(_ref4, "lineTension", 0), _ref4)]
      }
    });
  });

  function createChart(object) {
    var ctx = document.getElementById(object.id).getContext("2d");
    var myChart = new Chart(ctx, {
      type: object.type,
      data: object.data,
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
  }
});

/***/ }),

/***/ 1:
/*!**********************************************!*\
  !*** multi ./resources/js/Chart.js/chart.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/najib/projects/estore/resources/js/Chart.js/chart.js */"./resources/js/Chart.js/chart.js");


/***/ })

},[[1,"/js/manifest"]]]);
//# sourceMappingURL=chart.js.map