window.addEventListener("app:mounted",(function(){var e={colors:["#10B981"],series:[{name:"Clients Growth",data:[45,20,55,28,45,25,65]}],chart:{type:"area",stacked:!1,height:120,parentHeightOffset:0,toolbar:{show:!1}},dataLabels:{enabled:!1},grid:{padding:{left:0,right:0,top:-28,bottom:-15}},stroke:{width:2},tooltip:{shared:!0},legend:{show:!1},yaxis:{show:!1},xaxis:{labels:{show:!1},axisTicks:{show:!1},axisBorder:{show:!1}}},t=document.querySelector("#client-growth-chart");setTimeout((function(){t._chart=new ApexCharts(t,e),t._chart.render()}));var o={colors:["#FF9800"],series:[{name:"Sales Growth",data:[35,20,45,30,55,27,45]}],chart:{type:"area",stacked:!1,height:120,parentHeightOffset:0,toolbar:{show:!1}},dataLabels:{enabled:!1},grid:{padding:{left:0,right:0,top:-28,bottom:-15}},stroke:{width:2},tooltip:{shared:!0},legend:{show:!1},yaxis:{show:!1},xaxis:{labels:{show:!1},axisTicks:{show:!1},axisBorder:{show:!1}}},r=document.querySelector("#sales-growth-chart");setTimeout((function(){r._chart=new ApexCharts(r,o),r._chart.render()}));var a={colors:["#0EA5E9"],series:[65],chart:{height:120,width:120,type:"radialBar"},plotOptions:{radialBar:{hollow:{size:"60%"},dataLabels:{name:{show:!1,color:"#fff"},value:{show:!0,fontSize:"18px",offsetY:4}}}},grid:{show:!1,padding:{left:-20,right:-20,top:-20,bottom:-23}},stroke:{lineCap:"round"}},s=document.querySelector("#tasks-chart");setTimeout((function(){s._chart=new ApexCharts(s,a),s._chart.render()}));var h={placement:"bottom-end",modifiers:[{name:"offset",options:{offset:[0,4]}}]};new Popper("#client-growth-menu",".popper-ref",".popper-root",h),new Popper("#sales-growth-menu",".popper-ref",".popper-root",h),new Popper("#employees-menu",".popper-ref",".popper-root",h)}),{once:!0});