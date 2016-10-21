<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LeadEsign */

$this->title = 'Create Lead Esign';
$this->params['breadcrumbs'][] = ['label' => 'Lead Esigns', 'url' => ['/lead-esign/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="lead-esign-create">
<?php if (Yii::$app->session->hasFlash('success')): ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= Yii::$app->session->getFlash('success') ?>
			</div>
		</div>
	</div>
<?php endif ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
