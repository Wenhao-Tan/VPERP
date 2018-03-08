<?php

namespace frontend\modules\frame;

use Yii;
/**
 * frame module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\frame\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/frame/*'] = [
            'class' => 'yii\i18n\DbMessageSource',
            'sourceLanguage' => 'en-US',
            /*
            'basePath' => '@common/modules/frame/messages',
            'fileMap' => [
                'modules/frame/frame' => 'frame.php',
            ],
            */
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        // return Yii::t('modules/frame/' . $category, $message, $params, $language);
        return Yii::t($category, $message, $params, $language);
    }
}
