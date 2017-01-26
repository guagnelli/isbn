<?php echo js('highcharts/highcharts.js');
echo js('highcharts/modules/data.js');
echo js('highcharts/modules/drilldown.js');
$div_subsistema = $div_entidad = '';
?>
<script type="text/javascript">
$(function () {
    <?php if(isset($solicitud_x_entidad) && $solicitud_x_entidad!='[]'){ 
        $div_entidad = '<br><br><div id="container_entidad" style="min-width: 310px; height: 400px; margin: 0 auto"></div>';
        ?>
        $('#container_entidad').highcharts({
            chart: {
                type: 'bar',
                events: {
                    click: function(event) {
                        alert ('x: '+ event.xAxis[0].value +', y: '+ event.yAxis[0].value);
                    }
                } 
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
                    },
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
                point: {
                    events: {
                         click: function() {
                             /*console.log('Category: '+ this.category +', value: '+ this.y+' '+this.x);
                             //console.log(this);
                             console.log(this.name);
                             console.log(this.identificador);
                             console.log(this.tipo);*/
                             document.location.href='solicitud/index?tipo='+this.tipo+'&id='+this.identificador;
                         }
                    }
                }
            }],
        });
    <?php }
    if(isset($solicitud_x_subcategoria) && $solicitud_x_subcategoria!='[]'){ 
        $div_subcategoria = '<br><br><div id="container_subcategoria" style="min-width: 310px; height: 400px; margin: 0 auto"></div>';
        ?>
        $('#container_subcategoria').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Solicitudes por subcategoría'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total de solicitudes por subcategoría.'
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
                name: 'Subcategorías',
                colorByPoint: true,
                data: <?php echo $solicitud_x_subcategoria; ?>,
                point: {
                    events: {
                         click: function() {
                             document.location.href='solicitud/index?tipo='+this.tipo+'&id='+this.identificador;
                         }
                    }
                }
            }],
        });
    <?php }
    if(isset($solicitud_x_estado) && $solicitud_x_estado!='[]'){ ?>
        $('#container_estado').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Solicitudes por estado'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total de solicitudes por estado del proceso.'
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
                name: 'Estados',
                colorByPoint: true,
                data: <?php echo $solicitud_x_estado; ?>,
                point: {
                    events: {
                         click: function() {
                             document.location.href='solicitud/index?tipo='+this.tipo+'&id='+this.identificador;
                         }
                    }
                }
            }],
        });
    <?php } 
    if(isset($solicitud_x_subsistema) && $solicitud_x_subsistema!='[]'){ 
        $div_subsistema = '<br><br><div id="container_subsistema" style="min-width: 310px; height: 400px; margin: 0 auto"></div>';
        ?>
    	$('#container_subsistema').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Solicitudes por subsistema'
            },
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
                point: {
                    events: {
                         click: function() {
                             document.location.href='solicitud/index?tipo='+this.tipo+'&id='+this.identificador;
                         }
                    }
                }
            }],
        });
    <?php } ?>
});
</script>
<div id="container_estado" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<?php 
echo isset($div_entidad) ? $div_entidad : ""; 
echo isset($div_subsistema) ? $div_subsistema : "";
echo isset($div_subcategoria) ? $div_subcategoria : "";
?>
