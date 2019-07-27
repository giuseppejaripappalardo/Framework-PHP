<div class="container">
        <form class="was-validated" action="" method="post">
            <div class="mb-3">
                <input type="hidden" name="category[id]" value="<?= $category->id ?? '' ?>"/>
                <label for="validationTextarea">Inserisci il nome della categoria</label>
                <input type="text" class="form-control is-invalid" id="validationTextarea" placeholder="Scrivi il nome della categoria" id="categoryname" name="category[name]"  value="<?= $category->name ?? '' ?>" required></input>
                <div class="invalid-feedback">
                    Inserisci un nome di categoria.
                </div>
            </div>
            <center><button class="btn btn-primary" type="submit">Inserisci</button></center>
        </form>
</div>