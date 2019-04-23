<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Medium - a place to read and write big ideas and stories</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700">
        <link rel="stylesheet" href="/template/css/style.css">
    </head>
    <body>
        <div class="preloader"></div>

        <header class="header">
            <div class="header__container container">
                <a class="header__title" href="/">
                    <h1 class="title">Medium</h1>
                </a>
                <? if (!isset($_SESSION['user'])): ?>
                    <span class="header__register button button-border">Get started</span>
                    <span class="header__sign button">Sign in</span>
                <? else: ?>
                    <a class="header__right button button-border" href="/user/exit">Exit</a>
                    <a href="/post/add/">
                        <img class="header__edit" src="/template/images/icons/add.png" alt=""/>
                    </a>
                    <? if (isset($canEdit) && $canEdit): ?>
                        <a href="/post/delete/<?= $post['postid'] ?>">
                            <img class="header__edit" src="/template/images/icons/delete.png" alt=""/>
                        </a>
                        <a href="/post/edit/<?= $post['postid'] ?>">
                            <img class="header__edit" src="/template/images/icons/edit.png" alt=""/>
                        </a>
                    <? endif ?>
                <? endif; ?>
                
                <?php require_once(ROOT.'/views/layout/searchform.php'); ?>
                <?php require_once(ROOT.'/views/layout/menu.php'); ?>
            </div>
        </header>