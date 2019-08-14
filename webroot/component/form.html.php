<div class="container">
<?php if( empty($joke->authorid) || $user->id == $joke->authorid || $user->hasPermission(\Ijdb\Entity\Author::EDIT_JOKES)): ?>
  <form class="was-validated" action="/joke/edit" method="post">
    <div class="mb-3">
      <label for="validationTextarea">Inserisci Barzelletta</label>
      <input type="hidden" name="joke[id]" value="<?= $joke->id ?? '' ?>"/>
      <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Scrivi qui la tua barzelletta" id="joketext" name="joke[joketext]"  required><?= $joke->joketext ?? '' ?></textarea>
      <div class="invalid-feedback">
        Inserisci una barzelletta nella text area.
      </div>
    </div>
      
      <p>Seleziona una categoria:</p>
	  <?php foreach($categories as $category): ?>
          <div class="form-check">
              <?php if($joke && $joke->hasCategory($category->id)): ?>
              <input class="form-check-input" type="checkbox" checked name="category[]" value="<?= $category->id ?>">
              <?php else: ?>
              <input class="form-check-input" type="checkbox" name="category[]" value="<?= $category->id ?>">
              <?php endif ?>
              <label class="form-check-label">
                  <?= $category->name ?>
              </label>
          </div>
	  <?php endforeach ?>
    <center><button class="btn btn-primary" type="submit">Inserisci</button></center>
  </form>
  <?php else: ?> 
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <p>Non sei autorizzato a svolgere questa azione. Non sei tu l'autore di questo articolo.</p>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  <?php endif; ?>
</div>