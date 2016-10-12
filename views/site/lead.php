<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use yii\widgets\Menu;
use kartik\export\ExportMenu;


$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
    [
        'attribute' => 'salutation',
        'format' => 'raw',
    ],
    [
        'attribute' => 'firstname',
        'format' => 'raw',
    ],
    [
        'attribute' => 'middlename',
        'format' => 'raw',
    ],
    [
        'attribute' => 'lastname',
        'format' => 'raw',
    ],
    [
        'attribute' => 'account_provider',
        'format' => 'raw',
    ],
    [
        'attribute' => 'monthly_account_charge',
        'format' => 'raw',
    ],
];



?>

<div class="site-index">
    <div class="body-content">

        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Lead Panel</h3>
                </div>
                <div class="panel-body">
                    <?php
                    echo Menu::widget([
                        'items' => [
                            ['label' => 'Create New Lead', 'url' => ['site/index']],
                            ['label' => 'Manage Leads', 'url' => ['site/lead']],
                        ],
                        'options' => [
                            'class' => 'nav  nav-stacked nav-pills'
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            <h3 class="">Lead Data</h3>
            <?=
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' =>$gridColumns
            ]);
            ?>
            <?=
            \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => \yii\helpers\ArrayHelper::merge($gridColumns, [
                        [
                            'format' => 'raw',
                            'value' => function ($model) {
                                    return Html::a("pdf",['/pdf/'.$model->id]);
                                }
                        ]
                    ]),
            ]);
            ?>

        </div>
    </div>
</div>