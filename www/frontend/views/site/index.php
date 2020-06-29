<?php

/* @var $this yii\web\View */

use frontend\widgets\bestCasinos\BestCasinosWidget;

$this->title = 'Главная';
?>

<?php $this->beginBlock('sidebar_left'); ?>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('sidebar_right'); ?>
<div class="well" style="height: 100vh">Реклама справа</div>
<?php $this->endBlock(); ?>


<div class="site-index">

    <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-4"></div>
        <div class="col-sm-3">
            <?= BestCasinosWidget::widget() ?>
        </div>
    </div>

</div>
