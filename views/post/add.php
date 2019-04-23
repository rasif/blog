<?php require_once(ROOT.'/views/layout/header.php') ?>
    
        <div class="main">
            <div class="container">
                <article class="article">
                    <form class="edit" action="" method="POST"> 
                        <input class="edit__title edit__input" type="text" name="title" placeholder="Title"/>  
                        <textarea class="edit__text edit__input" name="text" wrap="hard" rows="20" placeholder="Text"></textarea> 
                        <select size="1" name="category" class="edit__select">
                            <option value="culture" selected>Culture</option>
                            <option value="politics">Politics</option>
                        </select>
                        <input class="edit__input edit__add" type="submit" name="submit" value="Add">
                    </form>
                </article>
            </div>
        </div>
    
<?php require_once(ROOT.'/views/layout/footer.php') ?>