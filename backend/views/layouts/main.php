<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

use common\assets\CommonAsset;

AppAsset::register($this);
CommonAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Order',
            'items' => [
                [
                    'label' => 'Report', 'url' => ['/order/report/index']
                ]
            ],
        ];
        $menuItems[] = [
            'label' => 'Human Resources',
            'items' => [
                [
                    'label' => 'Staff Info', 'url' => ['/staff/index/index'],
                ],
                [
                    'label' => 'Salary', 'url' => ['/staff/salary/index'],
                ],
                [
                    'label' => 'Social Security', 'url' => ['/resource/social-security'],
                ],
            ],
        ];
        $menuItems[] = ['label' => 'User', 'url' => ['/user/index/index']];
        $menuItems[] = [
            'label' => 'Permission',
            'items' => [
                [
                    'label' => 'Site', 'url' => ['/permission/index/index'],
                ],
                [
                    'label' => 'Retail', 'url' => ['/retail/permission/index'],
                ],
            ],
        ];
        $menuItems[] = [
            'label' => 'Setting',
            'items' => [
                [
                    'label' => 'Translation', 'url' => ['/translation/message'],
                ],
            ],
        ];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
