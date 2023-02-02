<?php
include "../recursos/barraNavegacionUser.php";
?>

<!DOCTYPE html>
<html>

<head>
  <title>Pagina Alan</title>
  <link rel="stylesheet" href="../styles/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
			<br/>
			<div class="row">
				<?php
				include "../recursos/classServicios.php";
				$oServicios ->m_query("SELECT * from Servicios order by Nombre");
				foreach($oServicios->a_registros as $registro) {
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
if(isset($_GET['e']))
switch($_GET['e']){
  case 10:echo '<span class="btn btn-success">Datos actualizados</span>';
  break;
}

?>
</body>

</html>
