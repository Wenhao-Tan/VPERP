<?php
use yii\bootstrap\Tabs;
use frontend\modules\frame\Module;
use yii\bootstrap\Html;
use frontend\modules\frame\assets\FrameAsset;

// FrameAsset::register($this);

$this->title = Yii::t('frame', 'Eyeglass Frames');

echo $this->render('../parameter/grid');