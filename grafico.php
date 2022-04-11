<?php
	
	$date= date("Y-m-d")."<br>";



// Pegar o último dia.
$P_Dia = date("Y-m-01");
$U_Dia = date("Y-m-d");

 $ontemm = date('Y-m-d', strtotime("-1 days"));

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8"/>
		<title>  Geração </title>
		
	<style>
		
		.chartBox{
		width:650px;
		}
	
	</style>
	
	</head>
	
	
	
	<body>
	
	<div class="chartBox">
	<center> Geração Kw </center>
	<canvas id="myChart" ></canvas>
	</div>
	
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
		
		
		<?php
			
			 include 'conexao1.php';
	   
	 $sql =" select (Sum_AVG_UG1+Sum_AVG_UG2) as Total, y.dia from (select sum(x.mediaUG1) as Sum_AVG_UG1,sum(x.mediaUG2) as Sum_AVG_UG2, x.dia from (select avg(ug1_pot_ativa) as mediaUG1,avg(ug2_pot_ativa) as mediaUG2, cast(data as date) as dia, hour(hora) as hora from usina_cgh_arabuta group by cast(data as date),hour(hora)) x group by x.dia) y where dia between '2022-04-01' and '$ontemm' group by y.dia";
	   
	 $consulta = mysqli_query($conexao, $sql);
	   
	   while ($dados = mysqli_fetch_array($consulta)) {
		   $dia1 = $dados['Total'];
		   $dia = $dados['dia'];
		   ?>
       
		  '<?php echo $dia ?>',
		  
		<?php }; ?>
		
		
		],
        datasets: [{
            label: 'Gerado',
            data: [
			<?php
			
			 include 'conexao1.php';
	   
	 $sql =" select (Sum_AVG_UG1+Sum_AVG_UG2) as Total, y.dia from (select sum(x.mediaUG1) as Sum_AVG_UG1,sum(x.mediaUG2) as Sum_AVG_UG2, x.dia from (select avg(ug1_pot_ativa) as mediaUG1,avg(ug2_pot_ativa) as mediaUG2, cast(data as date) as dia, hour(hora) as hora from usina_cgh_arabuta group by cast(data as date),hour(hora)) x group by x.dia) y where dia between '2022-04-01' and '$ontemm' group by y.dia";
	   
	 $consulta = mysqli_query($conexao, $sql);
	   
	   while ($dados = mysqli_fetch_array($consulta)) {
		   $dia1 = $dados['Total'];
		   $dia = $dados['dia'];
		   ?>
       
		  '<?php echo $dia1?>',
		  
		<?php }; ?>
			
			
			],
            backgroundColor: [
                'rgba(0, 143, 251)',
                'rgba(0, 143, 251)',
                'rgba(0, 143, 251)',
                'rgba(0, 143, 251)',
                'rgba(0, 143, 251)',
                'rgba(0, 143, 251)',
            ],
            borderColor: [
               'rgba(0, 143, 251)',
               'rgba(0, 143, 251)',
               'rgba(0, 143, 251)',
               'rgba(0, 143, 251)',
               'rgba(0, 143, 251)',
               'rgba(0, 143, 251)',
            ],
            borderWidth: 0,
			datalabels:{
			
			color: 'black',
			anchor: 'end',
			align: 'top',
			offset: 1,
			rotation: 270
			}
        }]
    },
	plugins: [ChartDataLabels],
	label:{
		position : 'top'
		}
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
	
	
	</body>
</html>