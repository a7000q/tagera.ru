<?php

namespace frontend\components\UserPanel;


use yii\bootstrap\Widget;

class UserPanelWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        parent::run();
        return $this->render('auth');
    }
}