<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $account_type
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 *
 * @property Customers[] $customers
 * @property Customers[] $customers0
 * @property Customers[] $customers1
 * @property Customers[] $customers2
 * @property Staffs[] $staffs
 * @property Staffs[] $staffs0
 * @property Staffs[] $staffs1
 * @property Staffs[] $staffs2
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['account_type'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['access_token'], 'string', 'max' => 1000],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'account_type' => 'Account Type',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }


        public function fields()
    {
        return [
            'id',
            'username',
            'account_type',
            'email',
            'status',
            'profile'=>function($model){
                return $model->profile;
            }
        ];
    }




   public function getProfile(){
         if($this->account_type=='Admin' || $this->account_type=='Staff'){
            return $this->hasMany(Staffs::className(), ['user_id' => 'id']);
         }else{
             return $this->hasMany(Customers::className(), ['user_id' => 'id']);
         }
   }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customers::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers0()
    {
        return $this->hasMany(Customers::className(), ['deleted_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers1()
    {
        return $this->hasMany(Customers::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers2()
    {
        return $this->hasMany(Customers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffs()
    {
        return $this->hasMany(Staffs::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffs0()
    {
        return $this->hasMany(Staffs::className(), ['deleted_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffs1()
    {
        return $this->hasMany(Staffs::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffs2()
    {
        return $this->hasMany(Staffs::className(), ['user_id' => 'id']);
    }
}
