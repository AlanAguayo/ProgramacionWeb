<?php
include "../recursos/barraNavegacion.php";
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Pagina Alan</title>
	<link rel="stylesheet" href="../styles/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="../scripts/jquery-3.6.1.js"></script>
	<script>
		dinero = 45.6;
		dinero = "pedro";
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="../styles/bootstrap.css">
</head>

<body>
	<div class="container-fluid" style="margin: 10px; padding:10;">
		<div class="row">
			<div class="col-md-12">
				<div class="carousel slide" id="carousel-283836">
					<ol class="carousel-indicators">
						<li data-slide-to="0" data-target="#carousel-283836" class="active">
						</li>
						<li data-slide-to="1" data-target="#carousel-283836">
						</li>
						<li data-slide-to="2" data-target="#carousel-283836">
						</li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img class="d-block w-100" alt="Carousel Bootstrap First" src="https://www.layoutit.com/img/sports-q-c-1600-500-1.jpg" />
							<div class="carousel-caption">
								<h4>
									First Thumbnail label
								</h4>
								<p>
									Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
								</p>
							</div>
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" alt="Carousel Bootstrap Second" src="https://www.layoutit.com/img/sports-q-c-1600-500-2.jpg" />
							<div class="carousel-caption">
								<h4>
									Second Thumbnail label
								</h4>
								<p>
									Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
								</p>
							</div>
						</div>
						<div class="carousel-item">
							<img class="d-block w-100" alt="Carousel Bootstrap Third" src="https://www.layoutit.com/img/sports-q-c-1600-500-3.jpg" />
							<div class="carousel-caption">
								<h4>
									Third Thumbnail label
								</h4>
								<p>
									Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
								</p>
							</div>
						</div>
					</div> <a class="carousel-control-prev" href="#carousel-283836" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" href="#carousel-283836" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
				</div>
				<br />
				<div class="row">
					<?php
					include "../recursos/classServicios.php";
					$oServicios->m_query("SELECT * from Servicios order by Nombre");
					foreach ($oServicios->a_registros as $registro) {
					?>
						<div class="col-md-3">
							<div class="card">
								<h5 class="card-header">
									<?php echo $registro['Nombre']; ?>
								</h5>
								<div class="card-body">
									<p class="card-text">
										<?php echo $registro['Descripcion']; ?>
									</p>
								</div>
								<div class="card-footer">
									$<?php echo $registro['Precio']; ?>
								</div>
							</div>
						</div>

					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<?php
	if (isset($_GET['e']))
		switch ($_GET['e']) {
			case 10:
				echo '<span class="btn btn-success">Datos actualizados</span>';
				break;
		}

	?>

	<script>
		function ocultar() {
			//fondo.style.visibility="hidden";
			fondo.style.display = "none";
		}

		function mostrar() {
			//fondo.style.visibility="visible";
			fondo.style.display = "block";
		}

		function zoom(tipo) {
			if (tipo == 1) {
				if (parseInt(capa.style.width) < 50)
					capa.style.width = parseInt(capa.style.width) + 1 + "%";
			} else
			if (parseInt(capa.style.width) > 1)
				capa.style.width = parseInt(capa.style.width) - 1 + "%";
		}

		function mover(tipo) {
			switch (tipo) {
				case 1:
					if (parseInt(capa.style.left) > 0)
						capa.style.left = parseInt(capa.style.left) - 1 + "%";
					break;
				case 2:
					if (parseInt(capa.style.left) < 100)
						capa.style.left = parseInt(capa.style.left) + 1 + "%";
					break;
				case 3:
					if (parseInt(capa.style.top) > 0)
						capa.style.top = parseInt(capa.style.top) - 1 + "%";
					break;
				case 4:
					if (parseInt(capa.style.top) < 100)
						capa.style.top = parseInt(capa.style.top) + 1 + "%";
					break;
			}

		}
	</script>

	<button type="button" onclick="ocultar()">Ocultar</button>
	<button type="button" onclick="mostrar()">Mostrar</button>
	<button type="button" onclick="zoom(1)">Zoom+</button>
	<button type="button" onclick="zoom(2)">Zoom-</button>

	<button type="button" onclick="mover(1)">Izquierda</button>
	<button type="button" onclick="mover(2)">Derecha</button>
	<button type="button" onclick="mover(3)">Arriba</button>
	<button type="button" onclick="mover(4)">Abajo</button>

	<div id="capa" style="position:absolute; left:10%; top:40%; width:10%;">
		<img width="100%" src="../images/st3.jpg" id="fondo" />
		<h3>Hola</h3>
	</div>
	<p class='parrafo'>parrafo</p>
	<p>segundo parrafo</p>
	<span>span</span>
	<div id="capa">capa</div>
	<script>
		$(document).ready(function() {
			console.log('ready!');
		});
	</Script>
</body>

</html>