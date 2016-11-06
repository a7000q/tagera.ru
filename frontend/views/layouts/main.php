<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use frontend\components\UserPanel\UserPanelWidget;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="theme/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="theme/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="theme/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="theme/assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="theme/assets/ico/favicon.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Just for debugging purposes. -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- include pace script for automatic web page progress bar  -->

    <script>
        paceOptions = {
            elements: true
        };
    </script>
    <script src="/theme/assets/js/pace.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<div id="wrapper">
    <div class="header">
        <nav class="navbar   navbar-site navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                    <a href="/" class="navbar-brand logo logo-title">
                        <!-- Original Logo will be placed here  -->
                        <span class="logo-icon"><i class="icon icon-search-1 ln-shadow-logo shape-0"></i> </span>
                        VSE<b style="color:#16a085">HALAL</b><span>.RU</span>
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <?=UserPanelWidget::widget()?>
                </div>
                <!--/.nav-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </div>
    <!-- /.header -->

    <div class="main-container">
        <div class="container">
            <?=$content?>
        </div>
    </div>
    <!-- /.main-container -->

    <div class="footer" id="footer">
        <div class="container">
            <ul class=" pull-left navbar-link footer-nav">
                <li><a href="index.html"> Home </a> <a href="about-us.html"> About us </a> <a href="terms-conditions.html"> Terms and
                    Conditions </a> <a href="#"> Privacy Policy </a> <a href="contact.html"> Contact us </a> <a
                        href="faq.html"> FAQ </a>
            </ul>
            <ul class=" pull-right navbar-link footer-nav">
                <li> &copy; 2015 BootClassified</li>
            </ul>
        </div>

    </div>
    <!-- /.footer -->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
