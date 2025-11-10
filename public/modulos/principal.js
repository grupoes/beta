$(function () {
	$("#titulo").text("Principal "+empresa);
	historial_empleados();
	
	Push.create("Estimado Usuario!", {
		body: "Bienvenido a "+empresa,
		icon: "",
		timeout: 4000,
		onClick: function(){
			window.focus();
			this.close();
		}
	});
});

function historial_empleados(){
	$.getJSON(base_url+"reportes/empleadoshoy",function(data){
          Highcharts.chart('container', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Historial de cobros por Empleado'
			},
			subtitle: {
				text: 'Monto total cobrado por los empleados de '+empresa
			},
			xAxis: {
				type: 'category'
			},
			yAxis: {
				title: {
					text: 'Total de montos cobrados'
				}
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: 'S/. {point.y:.1f}'
					}
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>S/. {point.y:.2f}</b> of total<br/>'
			},
			series: [{
				name: 'Empleado',
				colorByPoint: true,
				data: data
			}],
		});
     });
}