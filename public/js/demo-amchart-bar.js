var root = am5.Root.new("chartdiv");
              root.setThemes([
                  am5themes_Animated.new(root)
              ]);

            var barchart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true
            }));

            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var barcursor = barchart.set("cursor", am5xy.XYCursor.new(root, {}));
            barcursor.lineY.set("visible", false);

            var barxRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
            barxRenderer.labels.template.setAll({
            rotation: -90,
            centerY: am5.p50,
            centerX: am5.p100,
            paddingRight: 15
            });

            barxRenderer.grid.template.setAll({
            location: 1
            })

            var barxAxis = barchart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.3,
            categoryField: "country",
            renderer: barxRenderer,
            tooltip: am5.Tooltip.new(root, {})
            }));

            var baryAxis = barchart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0.3,
            renderer: am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })
            }));


            // Create series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var barchartseries = barchart.series.push(am5xy.ColumnSeries.new(root, {
            name: "Series 1",
            xAxis: barxAxis,
            yAxis: baryAxis,
            valueYField: "value",
            sequencedInterpolation: true,
            categoryXField: "country",
            tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
            })
            }));

            barchartseries.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
            barchartseries.columns.template.adapters.add("fill", function(fill, target) {
                return barchart.get("colors").getIndex(barchartseries.columns.indexOf(target));
            });

            barchartseries.columns.template.adapters.add("stroke", function(stroke, target) {
                return barchart.get("colors").getIndex(barchartseries.columns.indexOf(target));
            });


            // Set data
            var databar = [{
            country: "USA",
            value: 2025
            }, {
            country: "China",
            value: 1882
            }, {
            country: "Japan",
            value: 1809
            }, {
            country: "Germany",
            value: 1322
            }, {
            country: "UK",
            value: 1122
            }, {
            country: "France",
            value: 1114
            }, {
            country: "India",
            value: 984
            }, {
            country: "Spain",
            value: 711
            }, {
            country: "Netherlands",
            value: 665
            }, {
            country: "South Korea",
            value: 443
            }, {
            country: "Canada",
            value: 441
            }];

            barxAxis.data.setAll(databar);
            barchartseries.data.setAll(databar);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            barchartseries.appear(1000);
            barchart.appear(1000, 100);