<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;

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
    <?php $this->head() ?>
    <style type="text/css">
	body > div.wrap > div > div > div > div > div.panel-body > ul > li.list-group-item.active > a {
		color: white;
	}
</style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/dashboard/index'],'visible'=>!Yii::$app->user->isGuest],
            ['label' => 'PBA Form', 'url' => ['/site/index'],'visible'=>!Yii::$app->user->isGuest],
            ['label' => 'PPI Form', 'url' => ['/ppi-lead/form'],'visible'=>!Yii::$app->user->isGuest],
            ['label' => 'PBA Leads', 'url' => ['/lead-esign'],'visible'=>!Yii::$app->user->isGuest],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login'],'visible'=>!Yii::$app->user->isGuest] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard</h3>
					</div>
					<div class="panel-body">
					<?=
						Menu::widget([
							'itemOptions'=>[
								'class'=>'list-group-item',
							],
							'options'=>[
								'class'=>'list-group'
							],					
						    'items' => [
							        ['label' => 'Home', 'url' => ['/dashboard/index']],
                                    ['label' => 'PBA', 'url' => ['/lead-esign/index']],
							        ['label' => 'PPI', 'url' => ['/ppi-lead']],
							        ['label' => 'Users', 'url' => ['/system-account/index'] ],
							    ],
							]
						);
					?>
					</div>
				</div>
			</div>
			<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 well">
        		<?= $content ?>
				</div>
		</div>


    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
