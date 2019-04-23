<?php require_once(ROOT.'/views/layout/header.php') ?>
    
        <div class="main">
            <div class="container">
                <article class="article">
                    <form class="edit" action="" method="POST"> 
                        <input class="edit__title edit__input" type="text" name="title" value="<?= $post['title'] ?>"/>  
                        <textarea class="edit__text edit__input" name="text" wrap="hard" rows="20"><?= $post['text'] ?></textarea> 
                        <input class="edit__input edit__submit" data-id="<?= $post['postid'] ?>" type="submit" name="submit" value="Save">
                    </form>
                </article>
            </div>
        </div>
    
<?php require_once(ROOT.'/views/layout/footer.php') ?>