	<nav class="navbar-expand-lg navbar navbar-dark bg-primary">
		<a class="navbar-brand" href="/joke/index">SmartJoke</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
					  
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
				<a class="nav-link" href="/joke/index">Home <span class="sr-only">(current)</span></a>
				</li>
				
				<li class="nav-item active">
				<a class="nav-link" href="/joke/edit">Inserisci Joke <span class="sr-only">(current)</span></a>
				</li>
			</ul>
		<?php if(isset($joke)): ?>
		<button type="button" class="btn btn-primary">
			Joke in Database <span class="badge badge-danger">
			<?php
			echo count($joke);
			?>
			</span>
		</button>
		<?php endif;?>
		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="search" placeholder="Cerca" aria-label="Search">
			<button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cerca</button>
		</form>
		</div>
	</nav>