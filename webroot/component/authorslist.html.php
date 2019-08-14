<h2>Lista utenti</h2>
<table class="table">
	<thead>
	<tr>
		<th scope="col">id</th>
        <th scope="col">Username</th>
		<th scope="col">Nome</th>
        <th scope="col">Email</th>
		<th scope="col">Azioni</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($authors as $author): ?>
	<tr>
		<td><?= htmlspecialchars($author->id, ENT_QUOTES, 'UTF-8'); ?></td>
		<td><?= htmlspecialchars($author->username, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?= htmlspecialchars($author->name, ENT_QUOTES, 'UTF-8'); ?></td>
        <td><?= htmlspecialchars($author->email, ENT_QUOTES, 'UTF-8'); ?></td>
		<td>
			<div class="btn-group" role="group">
				<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Azioni
				</button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
					<a class="dropdown-item" href="/author/permissions?id=<?= $author->id ?? ''; ?>">Modifica permessi</a>
					<form method="post" action="/author/index">
						<input type="hidden" name="id" value="<?= $author->id ?? ''; ?>"/>
						<input type="submit" class="dropdown-item" value="Elimina"?>
					</form>
				</div>
			</div>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>