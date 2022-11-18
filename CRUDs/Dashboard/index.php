<?php
    include('../includes/head.php');
?>
<h1 class="pt-2">Dashboard</h1>

<h4 class="pt-3">Tabla de Registros</h4>
<table id="tablaRegistros" class="table" style="width:100%">
    <thead class="text-center">
        <tr>
            <th>ID</th>
            <th>Alarma</th>
            <th>Origen</th>
            <th>Fecha y Hora</th>
            <th>Tipo</th>
            <th>Fue Atendido</th>
            <th>Fecha y Hora (Atendido)</th>
            <th>Tiempo de Respuesta</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>


<section>
    <center>
        <div class="container">
            <h4>Cantidad de enfermeros activos: <span id="cantEnfermerosActivos"></span></h4>
            <h4>Cantidad de enfermeros inactivos: <span id="cantEnfermerosInactivos"></span></h4>
            <h4>Cantidad de pacientes activos: <span id="cantPacientesActivos"></span></h4>
            <h4>Cantidad de pacientes inactivos: <span id="cantPacientesInactivos"></span></h4>
            <h4>Cantidad de alarmas activos: <span id="cantAlarmasActivos"></span></h4>
            <h4>Cantidad de alarmas inactivos: <span id="cantAlarmasInactivos"></span></h4>
            <h4>Cantidad de registros: <span id="cantRegistros"></span></h4>
            <h4>Promedio tiempo de respuesta: <span id="promedioRespuesta"></span></h4>
            <div class="col-6">
                <h1>Cantidad de alertas por mes</h1>
                <canvas id="AlertasPMes"></canvas>
            </div>
            <div class="col-6">
                <h1>Origen de alertas</h1>
                <canvas id="OrigenAlerta"></canvas>
            </div>
            <div class="col-6">
                <h1>Cantidad de enfermeros VS pacientes</h1>
                <canvas id="CantEnfermerosPacientes"></canvas>
            </div>
            <div class="col-6">
                <h1>Tiempos de respuesta</h1>
                <canvas id="TiempoRespuestaPorMes"></canvas>
                <canvas id="PeorTiempoRespuesta"></canvas>
            </div>
        </div>
    </center>
</section>

<?php
include ('../../DB/DBConnection.php');
    $dbHandler = DbHandler();
    $LEER=$dbHandler->prepare("SELECT enfermeros.ID_Enfermero, enfermeros.Estado,  alarmas.Origen, pacientes.ID_Paciente, pacientes.Estado FROM enfermeros ,alarmas, pacientes WHERE enfermeros.Estado=1 AND pacientes.Estado=1;");
    $LEER->execute();
    $ce = -1;
	$cp = -1;
    $b = 0;
    $c = 0;
    foreach ($LEER as $dato) {
        if (isset($dato['ID_Enfermero'])) {
						$ce++;
					}
        if (isset($dato['ID_Paciente'])) {
            $cp++;
        }
        if ($dato['Origen'] == 'Baño' || $dato['Origen'] == 'baño') {
            $b++;
        }
        elseif ($dato['Origen'] == 'Cama' || $dato['Origen'] == 'cama') {
            $c++;
        }
    }
    $b = array($b,$c);
    $c = array($ce, $cp);
    $a = array(7,10);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var data1 = <?php echo $data = json_encode($a); ?>;
    var data2 = <?php echo $data = json_encode($b); ?>;
    var data3 = <?php echo $data = json_encode($c); ?>;

    const APM = document.getElementById('AlertasPMes');
    new Chart(APM, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Cantidad de alertas',
                data: data1,
                borderWidth: 2,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const OA = document.getElementById('OrigenAlerta');
    new Chart(OA, {
        type: 'doughnut',
        data: {
            labels: ['Baño', 'Cama'],
            datasets: [{
                label: 'Cantidad de alertas azules por mes',
                data: data2,
                borderWidth: 2,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const CEP = document.getElementById('CantEnfermerosPacientes');
    new Chart(CEP, {
        type: 'doughnut',
        data: {
            labels: ['Enfermeros', 'Pacientes'],
            datasets: [{
                label: 'Cantidad de personal VS pacientes',
                data: data3,
                borderWidth: 2,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const TRPM = document.getElementById('TiempoRespuestaPorMes');
    new Chart(TRPM, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Tiempo de respuesta promedio',
                data: [3,21,23.432],
                borderWidth: 2,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    const PTR = document.getElementById('PeorTiempoRespuesta');
    new Chart(PTR, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Peor tiempo de respuesta',
                data: [3,21,23.432],
                borderColor: '#f24150',
                backgroundColor: '#f24150'
            },
            {
                label: 'Mejor tiempo de respuesta',
                data: [3,21,23.432],
            borderColor: '#41f264',
            backgroundColor: '#41f264'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<?php
    include('../includes/footer.php');
?>
