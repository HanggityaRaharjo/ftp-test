/**
 * ---------------------------------------
 * This demo was created using amCharts 5.
 * 
 * For more information visit:
 * https://www.amcharts.com/
 * 
 * Documentation is available at:
 * https://www.amcharts.com/docs/v5/
 * ---------------------------------------
 */

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root3 = am5.Root.new("gauchartdiv");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root3.setThemes([
  am5themes_Animated.new(root3)
]);

// Create chart
// https://www.amcharts.com/docs/v5/charts/radar-chart/
var chart3 = root3.container.children.push(
  am5radar.RadarChart.new(root3, {
    panX: false,
    panY: false,
    startAngle: 180,
    endAngle: 360
  })
);

chart3.getNumberFormatter().set("numberFormat", "#'%'");

// Create axis and its renderer
// https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Axes
var axisRenderer3 = am5radar.AxisRendererCircular.new(root3, {
  innerRadius: -40
});

axisRenderer3.grid.template.setAll({
  stroke: root3.interfaceColors.get("background"),
  visible: true,
  strokeOpacity: 0.8
});

var xAxis3 = chart3.xAxes.push(
  am5xy.ValueAxis.new(root3, {
    maxDeviation: 0,
    min: 0,
    max: 100,
    strictMinMax: true,
    renderer: axisRenderer3
  })
);

// Add clock hand
// https://www.amcharts.com/docs/v5/charts/radar-chart/gauge-charts/#Clock_hands
var axisDataItem3 = xAxis3.makeDataItem({});

var clockHand3 = am5radar.ClockHand.new(root3, {
  pinRadius: 50,
  radius: am5.percent(100),
  innerRadius: 50,
  bottomWidth: 0,
  topWidth: 0
});

clockHand3.pin.setAll({
  fillOpacity: 0,
  strokeOpacity: 0.5,
  stroke: am5.color(0x000000),
  strokeWidth: 1,
  strokeDasharray: [2, 2]
});
clockHand3.hand.setAll({
  fillOpacity: 0,
  strokeOpacity: 0.5,
  stroke: am5.color(0x000000),
  strokeWidth: 0.5
});

var bullet3 = axisDataItem3.set(
  "bullet",
  am5xy.AxisBullet.new(root3, {
    sprite: clockHand3
  })
);

xAxis3.createAxisRange(axisDataItem3);

var label3 = chart3.radarContainer.children.push(
  am5.Label.new(root3, {
    centerX: am5.percent(50),
    textAlign: "center",
    centerY: am5.percent(50),
    fontSize: "1.5em"
  })
);

axisDataItem3.set("value", 50);
bullet3.get("sprite").on("rotation", function () {
  var value3 = axisDataItem3.get("value");
  label3.set("text", Math.round(value3).toString() + "%");
});

setInterval(function () {
  var value3 = Math.round(Math.random() * 100);

  axisDataItem3.animate({
    key: "value",
    to: value3,
    duration: 500,
    easing: am5.ease.out(am5.ease.cubic)
  });

  axisRange03.animate({
    key: "endValue",
    to: value3,
    duration: 500,
    easing: am5.ease.out(am5.ease.cubic)
  });

  axisRange13.animate({
    key: "value",
    to: value3,
    duration: 500,
    easing: am5.ease.out(am5.ease.cubic)
  });
}, 2000);

chart3.bulletsContainer.set("mask", undefined);

var colorSet3 = am5.ColorSet.new(root3, {});

var axisRange03 = xAxis3.createAxisRange(
  xAxis3.makeDataItem({
    above: true,
    value: 0,
    endValue: 50
  })
);

axisRange03.get("axisFill").setAll({
  visible: true,
  fill: colorSet3.getIndex(0)
});

axisRange03.get("label").setAll({
  forceHidden: true
});

var axisRange13 = xAxis3.createAxisRange(
  xAxis3.makeDataItem({
    above: true,
    value: 50,
    endValue: 100
  })
);

axisRange13.get("axisFill").setAll({
  visible: true,
  fill: colorSet3.getIndex(4)
});

axisRange13.get("label").setAll({
  forceHidden: true
});

// Make stuff animate on load
chart3.appear(1000, 100);