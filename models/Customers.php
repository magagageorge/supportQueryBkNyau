<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $mobile
 * @property string $phone
 * @property int $category_id
 * @property int $user_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $deleted
 * @property int $deleted_by
 * @property string $deleted_at
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'user_id'], 'required'],
            [['category_id', 'user_id', 'created_by', 'updated_by', 'deleted', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 30],
            [['address'], 'string', 'max' => 255],
            [['mobile', 'phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'address' => 'Address',
            'mobile' => 'Mobile',
            'phone' => 'Phone',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'deleted' => 'Deleted',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
        ];
    }

        public function fields()
    {
        return [
            'id',
            'name',
            'email',
            'address',
            'mobile',
            'phone',
        ];
    }
}
