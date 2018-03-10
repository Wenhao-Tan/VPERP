<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

use common\assets\CommonAsset;

AppAsset::register($this);
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

    $navItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        // ['label' => 'About', 'url' => ['/site/about']],
        // ['label' => 'Contact', 'url' => ['/site/contact']],
        /*
        Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>'
        )
        */
    ];

    if (Yii::$app->user->isGuest) {
        $navItems[] = ['label' => 'Sign In', 'url' => ['/site/login']];
    } else {
        $navItems[] = [
            'label' => 'Frame',
            'items' => [
                ['label' => 'Parameter', 'url' => ['/frame/parameter']],
                ['label' => 'Price', 'url' => ['/frame/price']],
                ['label' => 'Attributes', 'url' => ['/frame/attribute']],
            ],
        ];
        $navItems[] = [
            'label' => 'Lens',
            'items' => [
                ['label' => 'Customize', 'url' => ['/lens/customize/index']],
                ['label' => 'Parameters', 'url' => ['/lens/customize/params']],
            ],
        ];
        $navItems[] = ['label' => 'Order', 'url' => ['/order/index/index']];

        if (Yii::$app->user->can('sales')) {
            $navItems[] = ['label' => 'Customer', 'url' => ['/customer/index/index']];
        }

        $navItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
             'url' => ['/site/logout'],
             'linkOptions' => ['data-method' => 'post']];
    }

    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $navItems,

    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
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
