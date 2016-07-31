<?php echo js('highcharts/highcharts.js');
echo js('highcharts/modules/data.js');
echo js('highcharts/modules/drilldown.js');
?>
<script type="text/javascript">
$(function () {
    $('#container_entidad').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Solicitudes por entidad'
        },
        /*subtitle: {
            text: 'Clic en la columna para ver más detalle.'
        },*/
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total de solicitudes por entidad.'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },
        series: [{
            name: 'Entidades',
            colorByPoint: true,
            data: <?php echo $solicitud_x_entidad; ?>,
        }],
    });

	$('#container_subsistema').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Solicitudes por subsistema'
        },
        /*subtitle: {
            text: 'Clic en la columna para ver más detalle.'
        },*/
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total de solicitudes por subsistema.'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },
        series: [{
            name: 'Subsistemas',
            colorByPoint: true,
            data: <?php echo $solicitud_x_subsistema; ?>,
        }],
    });
});
</script>

<div id="container_entidad" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<br><br>
<div id="container_subsistema" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
