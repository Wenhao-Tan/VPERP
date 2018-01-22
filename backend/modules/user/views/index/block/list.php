<?php
use kartik\grid\GridView;
use yii\bootstrap\Html;
?>

<h2>Users</h2>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        'id',
        'username',
        'auth_key',
        'password_hash',
        'email',
        'status',
        'created_at',
        'updated_at',
        [
            'class'    => 'yii\grid\ActionColumn',
            'template' => '{set-password}{delete}',
            'buttons'  => [
                'set-password' => function ($url) {
                    return Html::a(
                        'Set Password',
                        $url,
                        [
                            'title' => 'Set Password',
                            'class' => 'a-set-password',
                        ]
                    );
                },
            ],
        ]
    ],
]);
?>

<script type="text/javascript">
    var setPassword = $('.a-set-password');
    setPassword.on('click', function (e) {
        e.preventDefault();

        $.colorbox({
            href: this.href
        });
    })
</script>