<?php


namespace backend\forms;


use common\models\Casino;
use common\models\TopCasino;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class TopCasinoForm extends Model
{
    public $casinoIds;

    public function rules()
    {
        return [
            ['casinoIds', 'required'],
            ['casinoIds', 'checkCountElements'],
        ];
    }

    public function checkCountElements($attribute, $params)
    {
        $countNewCasinos = count($this->casinoIds);
        $currentTopListCount = TopCasino::find()->count();
        if(($countNewCasinos + $currentTopListCount) > Yii::$app->params['maxTopCasinoCount']){
            $this->addError($attribute, "Превышен лимит топ казино");
        }

    }

    public function attributeLabels()
    {
        return [
            'casinoIds' => 'Казино'
        ];
    }

    public function loadCasinos()
    {
        $topCasinoQuery = TopCasino::find()->select('casino_id');
        return ArrayHelper::map(
            Casino::find()->where(['not in', 'id', $topCasinoQuery])->orderBy('title')->asArray()->all(),
            'id',
            'title'
        );
    }
}