<?php

use yii\helpers\Html;

?>

<div class="panel panel-primary panel-small m-b-0">
    <div class="panel-body panel-body-selected">

        <div class="row row-no-gutters">
            <div class="h4">Download Chunks (By: <?=$chunk_size?>)</div>
            <?php foreach(range(1, $chunks) as $i) { ?>
                <div class="pull-left">
                <?= Html::a(Yii::t('app', "CSV " . (($i - 1) * $chunk_size + 1) . " - " . (($i) * $chunk_size) . ""), $chunkLinkF($i),
                        [
                            'class' => 'btn btn-success',
                            'data-pjax' => 0
                        ]
                    ) ?>
                </div>
            <?php } ?>
        </div>

        <div class="row row-no-gutters">
            <div class="h4">Download All (Total: <?=$total?>)</div>
            <div class="pull-left">
                <?= Html::a(Yii::t('app', "CSV 1 - {$total}"), $fullLink,
                        [
                            'class' => 'btn btn-success',
                            'data-pjax' => 0
                        ]
                    ) ?>
            </div>
        </div>

        <div class="row row-no-gutters">
            <div class="h4">Schedule Download All (Total: <?=$total?>)</div>
            <div class="pull-left">
                <?= Html::a(Yii::t('app', "CSV 1 - {$total}"), $queueLink,
                        [
                            'class' => 'btn btn-success',
                            'data-pjax' => 0
                        ]
                    ) ?>
            </div>
        </div>

    </div>
</div>