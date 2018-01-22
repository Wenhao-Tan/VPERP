<?php
use kartik\grid\GridView;
?>

<div class="staffJobInfo">
    <?php
    echo GridView::widget([
        'dataProvider' => $jobInfoProvider,
    ])
    ?>
</div>
