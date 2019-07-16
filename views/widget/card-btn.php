<?php

use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

$url_comment = Url::to(['comment/show', 'id' => $blog->id]);

?>

<div class="card-btn">
    <div class="card-btn-right">
        <?= Html::a(Html::icon('thumbs-up'), 'javascript:void(0)', ['data-id' => $blog->id, 'class' => 'card-btn-like']) ?>
        <?= Html::a(Html::icon('comment'), $url_comment) ?>
        <?= Html::a(Html::icon('retweet'), 'javascript:void(0)', ['data-id' => $blog->id, 'data-target' => '#repostModal', 'data-toggle' => 'modal']) ?>
    </div>
</div>

<?php

Modal::begin([
    'header' => '<h4>转发</h4>',
    'options' => [
        'id' => 'repostModal',
    ]
]);?>
<?= app\widgets\PublishFormWidget::widget(['options' => ['action' => '?r=blog/repost']]) ?>
<?php Modal::end(); ?>
<?php
$js = <<<JS
// 转发
$("#repostModal").on("show.bs.modal",function(e) {
    $(e.target).find("#blog-id").val($(e.relatedTarget).attr("data-id"));
})
JS;
$this->registerJs($js);

?>
