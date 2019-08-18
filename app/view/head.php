<header>
    <!-- Nav Mobile -->
    <div class="uk-hidden@l"> <!-- Classe para deixar oculto o conteudo na resolucao 1200x => oculto -->
        <div class="uk-grid uk-background-secondary uk-light">
            
            <a class="uk-margin-small-left uk-margin-small-top" type="button" uk-toggle="target: #offcanvas-nav-primary" uk-icon="icon: table; ratio: 4.2"></a>
            <span class="uk-position-top-center m-titulo">SHOW CAST</span>
        </div>
            <div id="offcanvas-nav-primary" uk-offcanvas="overlay: true">
            
                <div class="uk-offcanvas-bar m_uk-offcanvas-bar uk-flex uk-flex-column">
                    <div class="uk-position-small uk-position-top-right uk-overlay ">
                        <a href="" uk-icon="icon: close; ratio: 2" uk-toggle="target: #offcanvas-nav-primary"></a>
                    </div>
                    <img src="public/img/logo.png" alt="logotipo">
                    <ul class="m_uk-nav uk-nav uk-nav-primary m_uk-nav-primary uk-nav-center uk-margin-auto-vertical">
                        <li class="uk-active"><a href="#"><span class="uk-margin-small-right" uk-icon="icon: home; ratio: 2.5"></span>Home</a></li>
                        <li class="uk-parent">
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: code; ratio: 2.5"></span>Portfólio</a>
                            <ul class="m_uk-nav-sub uk-nav-sub">
                                <li><a href="#">Sub item</a></li>
                                <li><a href="#">Sub item</a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: coments; ratio: 2.5"></span>Contatos</a>
                        </li>
                        <li class="uk-nav-header m_uk-nav-header">Show Cast ++</li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: grid; ; ratio: 2.5"></span> Blog</a>
                        </li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: cog; ; ratio: 2.5"></span> SCM</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: user; ratio: 2.5"></span>Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Nav Mobile -->

    <!-- Nav Desktop --> 
    <div class="uk-visible@l"> <!-- class uk-visible@l para deixar visivel me telas >= 1200x -->
        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: push">
            <ul class="uk-slideshow-items">
                <li>
                    <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                        <!-- Imagem 1 -->
                        <img src="public/img/03.jpg" alt="" uk-cover>
                        <!-- Mensagem imagem 1 -->
                        <div class="uk-position-center">
                            <div class="uk-transition-slide-top-small">
                                <h1 class="uk-margin-remove">Headline</h1> 
                            </div>
                            <div class="uk-transition-slide-bottom-small">
                                <h1 class="uk-margin-remove">Subheadline</h1>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-top-right">
                        <!-- Imagem 2 -->
                        <img src="public/img/01.jpg" alt="" uk-cover>
                        <!-- Mensagem imagem 2 -->
                        <div class="uk-position-center">
                            <div class="uk-transition-slide-top-small">
                                <h1 class="uk-margin-remove">Headline</h1>
                            </div>
                            <div class="uk-transition-slide-bottom-small">
                                <h1 class="uk-margin-remove">Subheadline</h1>
                            </div>
                            <div class="uk-transition-slide-top-small">
                                <h1 class="uk-margin-remove">Headline</h1>
                            </div>
                            <div class="uk-transition-slide-bottom-small">
                                <h1 class="uk-margin-remove">Subheadline</h1>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-bottom-left">
                        <!-- Imagem 3 -->
                        <img src="public/img/04.jpg" alt="" uk-cover>
                        <!-- Mensagem imagem 3 -->
                        <div class="uk-position-center">
                            <div class="uk-transition-slide-top-small">
                                <h1 class="uk-margin-remove">Headline</h1>
                            </div>
                            <div class="uk-transition-slide-bottom-small">
                                <h1 class="uk-margin-remove">Subheadline</h1>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- Icone de avancar -->
            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
        </div>
        <div class="uk-grid d-uk-grid">
            <div class="uk-position-top">
                <!-- Menu Adesivo --> 
                <div class="uk-overlay-default uk-dark" style="margin-bottom: 200px; z-index: 980;" uk-sticky="show-on-up: true; animation: uk-animation-slide-top; bottom: #bottom">
                    <!-- Nav menu -->
                    <nav class="uk-navbar-container d-nav-back-transparente" uk-navbar>
                        <div class="uk-position-left uk-margin-left">
                            <a href=""><img src="public/img/logo.png" alt="Logo" width="155px"></a>
                        </div>
                        <div class="uk-navbar-right uk-margin-right ">
                            <ul class="d-uk-navbar-nav uk-navbar-nav uk-light">
                                <li class="uk-active uk-button uk-button-text"><a href="#">Home</a></li>
                                <li><a class="uk-button uk-button-text" href="#">Blog</a></li>
                                <!-- Sub menu -->
                                <li> 
                                    <a class="uk-button uk-button-text" href="#">Portfólio</a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav  uk-navbar-dropdown-nav">
                                            <li class="uk-active"><a href="#">Active</a></li>
                                            <li><a href="#">Item</a></li>
                                            <li class="uk-nav-header">Header</li>
                                            <li><a href="#">Item</a></li>
                                            <li><a href="#">Item</a></li>
                                            <li class="uk-nav-divider"></li>
                                            <li><a href="#">Item</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- Fim sub menu -->
                                <li><a class="uk-button uk-button-text" href="#">Contatos</a></li>
                                <li><a class="uk-button uk-button-text" href="#">SCM - Tools</a></li>
                                <li> <!-- Redirecionamento para pagina de login -->
                                    <a href="app/view/login.php" class="uk-button uk-button-text"><b>LOGIN</b></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- Fim NAV-->
                </div>
                <!-- fim adesivo -->
            </div>
        </div>
    </div>
    <!-- Fim Nav Desktop -->
</header>
<!-- Fim cabecalho -->
<!--  require_once"footer.php"  chamar a footer-->