<?php

use frontend\modules\frame\models\Parameter;

$customization = $model->findOne($key);

if ($customization->r_sph > 0) {
    $customization->r_sph = '+' . $customization->r_sph;
}
if ($customization->r_cyl > 0) {
    $customization->r_cyl = '+' . $customization->r_cyl;
}
if ($customization->r_add > 0) {
    $customization->r_add = '+' . $customization->r_add;
}

if ($customization->l_sph > 0) {
    $customization->l_sph = '+' . $customization->l_sph;
}
if ($customization->l_cyl > 0) {
    $customization->l_cyl = '+' . $customization->l_cyl;
}
if ($customization->l_add > 0) {
    $customization->l_add = '+' . $customization->l_add;
}

$frame = Parameter::findOne(['reference' => $customization->frame_model]);

$diameter = '';
if ($customization->diameter != '') {
    $diameter = $customization->diameter . ' mm';
} else {
    $note = '请根据镜架尺寸和瞳距计算所需的镜片直径';
    $diameter = $note;
}

$coatings = '';
if ($customization->coating) {
    $coatings = unserialize($customization->coating);
    if ($coatings && is_array($coatings)) {
        $coatings = implode(', ', $coatings);
    }
}

?>

<div class="col-xs-6">
    <p>
        Ref No.: <?= $customization->ref_number ?>
    </p>
    <p>
        <strong>
            <?= $customization->refractive_index ?>
            <?php
            if ($customization->material != 'Resin') {
                echo $customization->material;
            }
            ?>
            <?= $customization->prescription_lens_type ?>
            <?= $customization->prescription_type ?>

            <?php if ($customization->color_type && $customization->color_type != 'Clear') : ?>
                <?= ' - ' . $customization->color_type . ' - ' . $customization->color ?>
            <?php endif; ?>
        </strong>
    </p>
    <ul>
        <li><?= 'Diameter - ' . $diameter ?></li>
        <li><?= 'Coating - ' . $coatings ?></li>
    </ul>
    <p>
        <strong>Quantity: <?= $customization->quantity; ?> Pair</strong>
    </p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th>SPH</th>
            <th>CYL</th>
            <th>AXS</th>
            <th>ADD</th>
            <th>Prism Diopter</th>
            <th>Prism Direction</th>
            <th>Single PD</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>R (OD)</th>
            <td><?= $customization->r_sph; ?></td>
            <td><?= $customization->r_cyl; ?></td>
            <td><?= $customization->r_axs; ?></td>
            <td><?= $customization->r_add; ?></td>
            <td><?= $customization->r_prism_diopter; ?></td>
            <td><?= $customization->r_prism_direction; ?></td>
            <td><?= $customization->r_pd ?></td>
        </tr>
        <tr>
            <th>L (OS)</th>
            <td><?= $customization->l_sph; ?></td>
            <td><?= $customization->l_cyl; ?></td>
            <td><?= $customization->l_axs; ?></td>
            <td><?= $customization->l_add; ?></td>
            <td><?= $customization->l_prism_diopter; ?></td>
            <td><?= $customization->l_prism_direction; ?></td>
            <td><?= $customization->l_pd ?></td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="7"><span>Remark: </span><?= $customization->remark ?></td>
        </tr>
        </tfoot>
    </table>


    <table id="frame-size" class="table table-bordered">
        <thead>
        <tr>
            <th>Frame Model</th>
            <th>Lens Width (mm)</th>
            <th>Lens Height (mm)</th>
            <th>Bridge Width (mm)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php if ($frame !== null) : ?>
                <td><?= $frame->reference ?></td>
                <td><?= $frame->lens_width ?></td>
                <td><?= $frame->lens_height ?></td>
                <td><?= $frame->bridge_width ?></td>
            <?php else: ?>
                <td colspan="4"><b>The frame model does not exist in the database!</b></td>
            <?php endif; ?>
        </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-xs-12">
            <ul>
                <li>Created at: <?= $customization->created_at ?></li>
                <?php if ($customization->ordered_at): ?>
                    <li>Ordered at: <?= $customization->ordered_at ?></li>
                <?php endif; ?>
                <?php if ($customization->finished_at): ?>
                    <li>Finished at: <?= $customization->finished_at ?></li>
                <?php endif; ?>
            </ul>
            Order Rep: <?php echo $customization->order_rep; ?>
        </div>
    </div>
</div>