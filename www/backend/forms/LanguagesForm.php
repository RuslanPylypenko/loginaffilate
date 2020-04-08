<?php


namespace backend\forms;


use common\models\Casino;
use common\models\Currency;
use common\models\Language;
use common\models\License;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class LanguagesForm extends Model
{
    public $existing = [];
    public $textNew;

    public function __construct(Casino $casino = null, $config = [])
    {
        if ($casino) {
            $this->existing = ArrayHelper::getColumn($casino->languagesAssignments, 'language_id');
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['textNew', 'string'],
        ];
    }

    public function languagesList(): array
    {
        return ArrayHelper::map(Language::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function getNewNames(): array
    {
        return array_map('trim', preg_split('#\r\n#i', $this->textNew));
    }

    public function beforeValidate(): bool
    {
        $this->existing = array_filter((array)$this->existing);
        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'existing' => 'Cписок',
            'textNew' => 'Создать новую',
        ];
    }
}