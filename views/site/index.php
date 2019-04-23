<?php require_once(ROOT.'/views/layout/header.php') ?>

        <div class="main">
            <div class="container">
                <div class="main__container">
                    <? foreach($posts as $post): ?>

                        <article class="post">
                            <figure class="post__figure">
                                <img class="post__image" src="/template/images/posts/clouds.jpg" alt=""/>
                            </figure>
                            <h3 class="post__title"> <?= $post['title'] ?></h3>
                            <p class="post__text">
                                <?= $post['text'] ?>
                            </p>                        
                            <div class="post__bottom">
                                <a href="/post/<?= $post['postid'] ?>" class="post__read button">Read more</a>
                                <div class="post__view">
                                    <img class="post__view-img" src="/template/images/icons/view.png" alt=""/>
                                    <span class="post__count"><?= $post['views'] ?></span>
                                </div>
                            </div>
                        </article>

                    <? endforeach; ?>
                </div>
            </div>
        </div>

        <?php 
        
        if (!isset($_SESSION['user']))
            require_once(ROOT.'/views/layout/registration.php'); 

        ?>

<?php require_once(ROOT.'/views/layout/footer.php') ?>