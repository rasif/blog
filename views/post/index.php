<?php require_once(ROOT.'/views/layout/header.php') ?>
    
        <div class="main">
            <div class="container">
                <article class="article">
                    <figure class="article__figure">
                        <img class="article__image" src="/template/images/posts/clouds.jpg" alt=""/>
                    </figure>     
                    <h3 class="article__title"> <?= $post['title'] ?></h3>  
                    <p class="article__text"> <?= $post['text'] ?></p> 
                    <div class="post__bottom">
                        <div class="post__view">
                            <img class="post__view-img" src="/template/images/icons/view.png" alt=""/>
                            <span class="post__count"><?= $post['views'] ?></span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        
        <?php 
            if (!isset($_SESSION['user']))
                require_once(ROOT.'/views/layout/registration.php'); 
        ?>

<?php require_once(ROOT.'/views/layout/footer.php') ?>