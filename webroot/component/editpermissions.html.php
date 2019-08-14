<form action="" method="post">
<p>Modifica le competenze dell'autore <?= $author->name?> </p>
	  <?php foreach($permissions as $name => $value): ?>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" name="permissions[]" value="<?= $value ?>" 
              <?php if($author->hasPermission($value)): echo 'checked'; endif;?> />
              <label class="form-check-label">
                  <?= $name ?>
              </label>
          </div>
	  <?php endforeach ?>
    <center><button class="btn btn-primary" type="submit">Modifica</button></center>
  </form>