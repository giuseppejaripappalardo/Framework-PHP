<div class="row">
    <article class="container">
        <?php if(isset($joke)): ?>
        <?php foreach($joke as $article): ?>
        <?php $date = new DateTime($article['jokedate']) ?>
        <div class="card text-black bg-light shadow pt-0 mt-5 rounded w-100" style="margin-top:10px;">
            <div class="card-body" style="padding:7px;">
                <div class="card-header bg-light mb-3 text-dark"><h6 class="card-title">Barzelletta <?=$article['id'];?></h6></div>
                <p class="card-text text-justify" style="margin-top:10px;"><?= htmlspecialchars($article['joketext'], ENT_QUOTES, 'UTF-8')?></p>              
     <?php if($loggedIn && $userId == $article['authorid']): ?>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Azioni
                </button>
                <div class="dropdown-menu">
                        <a href="/joke/edit?id=<?=$article['id'] ?>" class="dropdown-item">Aggiorna</a>
                        <form action="/joke/delete" method="post" class="dropdown-item">
                            <button type="submit" class="btn btn-danger">Elimina</button>
                            <input type="hidden" name="id" value="<?=$article['id'];?>"/>
                        </form>
                </div>
            </div>
        <?php endif; ?>
        </div>
        <div class="card-footer text-justify"><small>ID: <?=$article['id'];?> - Data creazione: <?= $date->format('d-m-Y H:i:s');?> - Autore <?= $article['name']; ?></small></div>
        </div>
        <?php endforeach ?>
        <?php endif ?>
        <?php if(!isset($joke) || count($joke) == 0): ?>
        <div class="card text-black bg-light mb-3" style="width: 100%; margin-top:10px;">
            <div class="card-body">
                <?php $noJokeOutput = 'Non sono ancora stati inseriti Joke nel database! Inizia tu da <a href="/joke/edit"> qui! </a>'; ?>
                <center><?= $noJokeOutput ?? '';?></center>
            </div>
        </div>
        <?php endif ?>
    </article>
</div>