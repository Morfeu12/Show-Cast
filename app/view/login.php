<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.6/css/uikit.min.css" />
    <style type="text/css">
        html{
            background-image: url(https://abrilsuperinteressante.files.wordpress.com/2018/07/estrelas.png);
        }
    </style>
</head>
<body>
    <div class="uk-position-large uk-position-center uk-overlay">
        <div class=" uk-card-default uk-card-hover uk-card-body uk-box-shadow-hover-xlarge uk-padding uk-border-rounded">
            <div class="uk-margin">
                <a href=""><img class="uk-align-center" src="http://www.logomarcasonline.com.br/logo_logomarcasonline.png"></a>
            </div>

            <form method="GET" action="validar_login.php">
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                        <input class="uk-input uk-form-width-large" type="text" name="user" placeholder="E-mail or user">
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                        <input class="uk-input uk-form-width-large" type="password" name="password" placeholder="Your password">
                        <a class="uk-form-icon uk-form-icon-flip" uk-icon="icon: camera"></a>
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-grid-collapse uk-grid-small uk-text-center" uk-grid>
                        <div class="uk-width-1-2@m">
                            <input class="uk-button uk-button-primary uk-width-expand" type="submit" name="enviar" value="LOGIN">
                        </div>
                        <div class="uk-width-1-2@m">
                          <a class="uk-button uk-button-default uk-width-expand">Cadastre-se</a>
                      </div>
                  </div>
              </div>
            </form>

            <a href="" class="uk-align-right uk-link-muted uk-button uk-button-text">Forgot password?</a></br>

            <hr class="uk-divider-icon">
            <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom uk-button-secondary">
                <span uk-icon="google"></span>&nbsp;&nbsp;&nbsp;Sign in with Google
            </button>
            <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom">
                <span uk-icon="facebook"></span>&nbsp;&nbsp;&nbsp;Sign in with Facebook
            </button>
        </div>
    </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.6/js/uikit.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.6/js/uikit-icons.min.js"></script>
</body>
</html>