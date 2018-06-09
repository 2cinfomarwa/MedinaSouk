/*
 Template Name: Canvab - Bootstrap 4 Admin Dashboard & Frontend
 Author: Themesbrand
 File: Dashboard Init
*/

new Chartist.Bar("#stacked-bar-chart",{labels:["Q1","Q2","Q3","Q4","Q5","Q6","Q7","Q8","Q9","Q10"],series:[[8e5,12e5,14e5,13e5,152e4,12e5,14e5,13e5,152e4,14e5],[2e5,4e5,5e5,3e5,452e3,5e5,4e5,5e5,452e3,5e5],[16e4,29e4,41e4,6e5,588e3,16e4,29e4,6e5,588e3,41e4]]},{stackBars:!0,axisY:{labelInterpolationFnc:function(e){return e/1e3+"k"}},plugins:[Chartist.plugins.tooltip()]}).on("draw",function(e){"bar"===e.type&&e.element.attr({style:"stroke-width: 30px"})});var data={series:[5,3,4]},sum=function(e,t){return e+t};new Chartist.Pie("#simple-pie",data,{labelInterpolationFnc:function(e){return Math.round(e/data.series.reduce(sum)*100)+"%"}}),$(function(){$(".knob").knob()});
