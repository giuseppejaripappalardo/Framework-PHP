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
				<?php if($loggedIn): ?>
				<li class="nav-item active">
				<a class="nav-link" href="/joke/edit">Inserisci Joke <span class="sr-only">(current)</span></a>
				</li>
				<?php endif; ?>
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
			<form class="form-inline my-2 my-lg-0" action="" method="GET">
				<?php if($loggedIn): ?>
				<a href="/logout" class="btn btn-outline-light my-2 my-sm-0" role="button">Esci</a>
				<?php else: ?>
				<a href="/login" class="btn btn-outline-light my-2 my-sm-0" role="button">Accedi</a>
				<?php endif; ?>
			</form>
		</div>
	</nav>