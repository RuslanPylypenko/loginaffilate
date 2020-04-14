<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\searchModels\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countries-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Countries', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'iso',
            'continent',
            'name',
            'name_en',
            //'name_ru',
            //'name_uk',
            //'name_az',
            //'name_ka',
            //'name_cs',
            //'name_hy',
            //'name_pl',
            //'name_nl',
            //'name_fr',
            //'name_tr',
            //'name_de',
            //'name_et',
            //'name_sk',
            //'name_zh',
            //'name_it',
            //'lat',
            //'lon',
            //'timezone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
