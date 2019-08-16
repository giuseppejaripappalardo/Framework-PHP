<div class="row">
    
    <div class="container-fluid">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filtri di ricerca
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	            <?php foreach ($categories as $category): ?>
                <a class="dropdown-item" href="\joke\index?category=<?=$category->id;?>"> <?= $category->name ?> </a>
	            <?php endforeach ?>
            </div>
        </div>
    </div>
    <article class="container">
        <?php if(isset($joke)): ?>
        <?php foreach($joke as $article): ?>
        <?php $date = new DateTime($article->jokedate) ?>
        <div class="card text-black bg-light shadow pt-0 mt-5 rounded w-100" style="margin-top:10px;">
            <div class="card-body" style="padding:7px;">
                <div class="card-header bg-light mb-3 text-dark"><h6 class="card-title">Barzelletta <?=$article->id;?></h6></div>
                <p class="card-text text-justify" style="margin-top:10px;">
                <?=  (new Parsedown())->text($article->joketext); ?>
            </p>
    <?php if($user):?>
            <div class="btn-group">
            <?php if($loggedIn && $article->authorid == $user->id || $user->hasPermission(\Ijdb\Entity\Author::EDIT_JOKES)): ?>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Azioni
                </button>
            <?php endif ?>
                <div class="dropdown-menu">
                <?php if($loggedIn && $article->authorid == $user->id || $user->hasPermission(\Ijdb\Entity\Author::EDIT_JOKES)): ?>
                        <a href="/joke/edit?id=<?=$article->id ?>" class="dropdown-item">Aggiorna</a>
                <?php endif ?>
                <?php if($loggedIn && $article->authorid == $user->id || $user->hasPermission(\Ijdb\Entity\Author::DELETE_JOKES)): ?>
                        <form action="/joke/delete" method="post" class="dropdown-item">
                            <button type="submit" class="btn btn-danger">Elimina</button>
                            <input type="hidden" name="id" value="<?=$article->id;?>"/>
                        </form>
                <?php endif ?>
                </div>
            </div>
        <?php endif ?>
        </div>
        <div class="card-footer text-justify"><small>ID: <?=$article->id;?> - Data creazione: <?= $date->format('d-m-Y H:i:s');?> - Autore <?= $article->getAuthor()->name; ?></small></div>
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
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php
                $count = ceil($count / $pageLimit);
                for($i = 1; $i <= $count; $i++):
                    if($i == $currentPage):
            ?>
            <li class="page-item active"><a class="page-link" href="/joke/index?page=<?=$i?><?=!empty($categoryid) ? '&category=' . $categoryid : ''?>"><?=$i?></a></li>;
            <?php else: ?>
            <li class="page-item"><a class="page-link" href="/joke/index?page=<?=$i?><?=!empty($categoryid) ? '&category=' . $categoryid : ''?>"><?=$i?></a></li>
            <?php endif; ?>
            <?php endfor; ?>
        </ul>
    </nav>
    </article>
</div>