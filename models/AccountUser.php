<?php

namespace app\models;

use Yii;
use yii\base\ModelEvent;
use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "account_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $created_at
 * @property string $updated_at
 */
class AccountUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'accessToken'], 'required'],
            [['username', 'password', 'authKey', 'accessToken'], 'required','on' => 'update'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_at', 'updated_at'], 'safe','on' => 'update'],
            [['username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 255,'on' => 'update'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ]; 
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord || $this->scenario == 'update')
        {
            $this->authKey =  isset($this->authKey) ? $this->authKey:uniqid();
            $this->accessToken = isset($this->accessToken) ? $this->accessToken:uniqid();            
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }
        return parent::beforeSave($insert);
    }
    public function afterSave($insert ,$changeAttrs)
    {
        if ($this->isNewRecord ) {
            $authManager = \Yii::$app->authManager;
            $agentRole = $authManager->getRole("agent");
            if (!$agentRole) {
                $agentRole = $authManager->createRole("agent");
                $authManager->add($agentRole);
                $agentRole = $authManager->getRole("agent");
            }
            $authManager->assign($agentRole, $this->id);
        }
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return AccountUser::find()->where([
                'id'=>$id
            ])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return AccountUser::find()->where([
                'accessToken'=>$token
            ])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }    

}
