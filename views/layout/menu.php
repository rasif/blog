<div class="header__menu">
                <div class="container">
                    <nav class="menu">
                        <ul class="menu__list">
                            <li class="menu__item"><a class="menu__link menu__link-active" href="/">Home</a></li>
                            <? if (isset($_SESSION['user'])): ?>
                                <li class="menu__item"><a class="menu__link" href="/post/all">All</a></li>   
                            <? endif; ?> 
                            <li class="menu__item"><a class="menu__link" href="/post/culture">Culture</a></li>
                            <li class="menu__item"><a class="menu__link" href="/post/politics">Politics</a></li>                                                
                        </ul>
                    </nav>
                </div>
            </div>