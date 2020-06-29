<?php

/* @var $this \yii\web\View */

use frontend\widgets\advertising\BannerWidget;

/* @var $content string */


?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
    <div class="row">
        <div class="col-sm-9">
            <?= $content ?>
        </div>
        <div class="col-sm-3">
            <?= BannerWidget::widget(['blockName' => '1']) ?>
        </div>
    </div>
<?php $this->endContent(); ?>