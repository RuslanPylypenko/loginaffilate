<?php


namespace frontend\components;



use yii\base\BaseObject;
use yii\web\UrlRuleInterface;

class PageUrlRules extends BaseObject implements UrlRuleInterface
{
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
    }

    public function createUrl($manager, $route, $params)
    {
       return false;
    }
}