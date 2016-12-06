<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);


$this->registerCssFile('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <style type="text/css">
        #banner-top {
            background: #C9E4AF;
            color: #1d1d17;
            padding: 43px 32px;
            font-size: 24px;
            border-radius: 18px;
            font-weight: 600;
            text-align: center;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                <h3 id="banner-top">
                    Mis-sold Packaged Bank Account Claim Pack
                </h3>
            </div>
            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                <?= Html::img("/images/moneyactive.jpg", ['class' => 'img-responsive']); ?>
            </div>

        </div>

        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
