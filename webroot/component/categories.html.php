<h2>Categorie</h2>
<table class="table">
	<thead>
	<tr>
		<th scope="col">id</th>
		<th scope="col">Nome</th>
		<th scope="col">Azioni</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($categories as $category): ?>
	<tr>
		<td><?= htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?></td>
		<td><?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></td>
		<td>
			<div class="btn-group" role="group">
				<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Azioni
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
					<a class="dropdown-item" href="/category/edit?id=<?= $category->id ?? ''; ?>">Modifica</a>
					<form method="post" action="/category/delete">
						<input type="hidden" name="id" value="<?= $category->id ?? ''; ?>"/>
						<input type="submit" class="dropdown-item" value="Elimina"?>
					</form>
				</div>
			</div>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>