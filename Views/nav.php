<body>
	<div class="wrapper">

		<header class="header">
			<figure class="logo"><a href="<?= VIEWS_PATH ?>index.html"><img src="Views/img/logo.png" alt="Logo"></figure></a>
			<nav class="menu">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a>Lista desplegable</a>
						<ul>
							<li><a href="genre.html">Action</a></li>
							<li><a href="genre.html">Comedy</a></li>
							<li><a href="genre.html">Drama</a></li>
							<li><a href="genre.html">Romance</a></li>
						</ul>
					</li>
					<li><a>borrar</a>
						<ul>
							<li><a href="year.html">2017</a></li>
							<li><a href="year.html">2016</a></li>
							<li><a href="year.html">2015</a></li>
							<li><a href="year.html">2014</a></li>
						</ul><?php //echo FRONT_ROOT  . "home/peliculas_cartelera*****";?>
					</li>
					<li><a href="<?php  echo FRONT_ROOT ?>Home/peliculas_cartelera">Cartelera(todas las peliculas)</a>
						<ul>
							<li><a href="language.html">English</a></li>
							<li><a href="language.html">German</a></li>
						</ul>
					</li>
					<li><a href="mostwatched.html">Most Watched</a></li>
					<li class="mobsearch">
						<form class="mobform">
							<input type="text" name="s" class="mobsearchfield" placeholder="Search...">
							<input type="submit" value="" class="mobsearchsubmit">
						</form>
					</li>
				</ul>
			</nav>