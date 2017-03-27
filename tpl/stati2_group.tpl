  
<script type="text/rocketscript" data-rocketsrc="http://code.jquery.com/jquery-1.11.2.min.js"></script>
      <script data-cfasync="false"  src="http://kidris.ru/demo/amcharts/amcharts.js" type="text/javascript"></script>
        <script data-cfasync="false"  src="http://kidris.ru/demo/amcharts/serial.js" type="text/javascript"></script>
      
        <style type="text/css">

            .amcharts-graph-g1 .amcharts-graph-stroke {
                stroke-dasharray: 3px 3px;
                stroke-linejoin: round;
                stroke-linecap: round;
                -webkit-animation: am-moving-dashes 1s linear infinite;
                animation: am-moving-dashes 1s linear infinite;
            }

            @-webkit-keyframes am-moving-dashes {
                100% {
                    stroke-dashoffset: -30px;
                }
            }
            @keyframes am-moving-dashes {
                100% {
                    stroke-dashoffset: -30px;
                }
            }


            .lastBullet {
                -webkit-animation: am-pulsating 1s ease-out infinite;
                animation: am-pulsating 1s ease-out infinite;
            }
            @-webkit-keyframes am-pulsating {
                0% {
                    stroke-opacity: 1;
                    stroke-width: 0px;
                }
                100% {
                    stroke-opacity: 0;
                    stroke-width: 50px;
                }
            }
            @keyframes am-pulsating {
                0% {
                    stroke-opacity: 1;
                    stroke-width: 0px;
                }
                100% {
                    stroke-opacity: 0;
                    stroke-width: 50px;
                }
            }

            .amcharts-graph-column-front {
                -webkit-transition: all .3s .3s ease-out;
                transition: all .3s .3s ease-out;
            }
            .amcharts-graph-column-front:hover {
                fill: #496375;
                stroke: #496375;
                -webkit-transition: all .3s ease-out;
                transition: all .3s ease-out;
            }


            .amcharts-graph-g2 {
              stroke-linejoin: round;
              stroke-linecap: round;
              stroke-dasharray: 500%;
              stroke-dasharray: 0 \0/;    /* fixes IE prob */
              stroke-dashoffset: 0 \0/;   /* fixes IE prob */
              -webkit-animation: am-draw 40s;
              animation: am-draw 40s;
            }
            @-webkit-keyframes am-draw {
                0% {
                    stroke-dashoffset: 500%;
                }
                100% {
                    stroke-dashoffset: 0px;
                }
            }
            @keyframes am-draw {
                0% {
                    stroke-dashoffset: 500%;
                }
                100% {
                    stroke-dashoffset: 0px;
                }
            }




        </style>

  
       
    <style type="text/css">
       
        .jumbotron {
            text-align: center;
        }
        .alert_block {
            text-align: center;
        }
        .row {
            text-align: center;
        }

        a {
            text-decoration: none;
        }
        #counter {
			display: none;
		}
		.footer-row {
			text-align: left;
		}
        .onoffswitch {
    position: relative; width: 93px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    height: 30px; padding: 0; line-height: 30px;
    border: 2px solid #999999; border-radius: 30px;
    background-color: #D6D6D6;
    transition: background-color 0.3s ease-in;
}
.onoffswitch-label:before {
    content: "";
    display: block; width: 30px; margin: 0px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 61px;
    border: 2px solid #999999; border-radius: 30px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label {
    background-color: #18BC9C;
}
.onoffswitch-checkbox:checked + .onoffswitch-label, .onoffswitch-checkbox:checked + .onoffswitch-label:before {
   border-color: #18BC9C;
}
.onoffswitch-checkbox:checked + .onoffswitch-label:before {
    right: 0px; 
}
</style>


<script>
              var chart{rows_id}Data = [
             {tableforstats}

               
            ];
                       var chart{rows_id};

            AmCharts.ready(function () {
                // SERIAL CHART
                chart{rows_id} = new AmCharts.AmSerialChart();
                chart{rows_id}.addClassNames = true;
                chart{rows_id}.dataProvider = chart{rows_id}Data;
                chart{rows_id}.categoryField = "date";
                chart{rows_id}.dataDateFormat = "YYYY-MM-DD";
                chart{rows_id}.startDuration = 1;
                chart{rows_id}.color = "#FFFFFF";
                chart{rows_id}.marginLeft = 0;

                // AXES
                // category
                var categoryAxis = chart{rows_id}.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD
                categoryAxis.autoGridCount = false;
                categoryAxis.gridCount = 50;
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.gridColor = "#FFFFFF";
                categoryAxis.axisColor = "#555555";
                // we want custom date formatting, so we change it in next line
                categoryAxis.dateFormats = [{
                    period: 'DD',
                    format: 'DD'
                }, {
                    period: 'WW',
                    format: 'MMM DD'
                }, {
                    period: 'MM',
                    format: 'MMM'
                }, {
                    period: 'YYYY',
                    format: 'YYYY'
                }];

                // as we have data of different units, we create three different value axes
                // Distance value axis
                var distanceAxis = new AmCharts.ValueAxis();
                distanceAxis.title = "Сообщения";
                distanceAxis.gridAlpha = 0;
                distanceAxis.axisAlpha = 0;
                chart{rows_id}.addValueAxis(distanceAxis);

                // latitude value axis
                var latitudeAxis = new AmCharts.ValueAxis();
                latitudeAxis.gridAlpha = 0;
                latitudeAxis.axisAlpha = 0;
                latitudeAxis.title = "duration and latitude";
                latitudeAxis.offset = 83;
                latitudeAxis.titleOffset = 10;
                latitudeAxis.position = "right";
                chart{rows_id}.addValueAxis(latitudeAxis);

                // duration value axis
                var durationAxis = new AmCharts.ValueAxis();
                // the following line makes this value axis to convert values to duration
                // it tells the axis what duration unit it should use. mm - minute, hh - hour...
                durationAxis.duration = "mm";
                durationAxis.durationUnits = {
                    DD: "d. ",
                    hh: "h ",
                    mm: "min",
                    ss: ""
                };
                durationAxis.gridAlpha = 0;
                durationAxis.axisAlpha = 0;
                durationAxis.inside = false;
                durationAxis.position = "right";
                chart{rows_id}.addValueAxis(durationAxis);

                // GRAPHS
                // distance graph
                var distanceGraph = new AmCharts.AmGraph();
                distanceGraph.valueField = "distance";
                distanceGraph.title = "Сообщений";
                distanceGraph.type = "column";
                distanceGraph.fillAlphas = 0.9;
                distanceGraph.valueAxis = distanceAxis; // indicate which axis should be used
                distanceGraph.balloonText = "[[value]] сообщений";
                distanceGraph.legendValueText = "[[value]] сообщений";
                distanceGraph.legendPeriodValueText = "Всего: [[value.sum]] сообщений";
                distanceGraph.lineColor = "#263138";
                distanceGraph.alphaField = "alpha";
                chart{rows_id}.addGraph(distanceGraph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonDateFormat = undefined;
                chartCursor.cursorAlpha = 0;
                chartCursor.valueBalloonsEnabled = false;
                chartCursor.valueLineBalloonEnabled = true;
                chartCursor.valueLineEnabled = true;
                chartCursor.valueLineAlpha = 0.5;
                chart{rows_id}.addChartCursor(chartCursor);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.bulletType = "round";
                legend.equalWidths = false;
                legend.valueWidth = 120;
                legend.useGraphSettings = true;
                legend.color = "#FFFFFF";
                chart{rows_id}.addLegend(legend);

 var chartScrollbar = new AmCharts.ChartScrollbar();
                chart{rows_id}.addChartScrollbar(chartScrollbar);
                // WRITE
                chart{rows_id}.write("chart{rows_id}div");
            });
        </script>