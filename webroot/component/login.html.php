<div class="container">

    <?php if(isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p><?= $error ?></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <form action="" method="POST">
    <div class="form-group">
        <label for="Username">Username</label>
        <input type="text" class="form-control" id="username" name="author[username]"aria-describedby="emailHelp" placeholder="Scegli un nome utente.">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="author[password]">
    </div>    

    <input type="submit" class="btn btn-primary" value="Accedi">
    </form>

<p>Se non sei registrato, registrati <a href="/author/register">qui!</a></p>
</div>