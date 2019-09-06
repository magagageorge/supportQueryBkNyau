<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffs".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $position
 * @property string $phone
 * @property int $role_id
 * @property int $user_id
 * @property int $department_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $deleted
 * @property int $deleted_by
 * @property string $deleted_at
 */
class Staffs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'role_id', 'user_id', 'department_id'], 'required'],
            [['role_id', 'user_id', 'department_id', 'created_by', 'updated_by', 'deleted', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 30],
            [['position'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
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
            'position' => 'Position',
            'phone' => 'Phone',
            'role_id' => 'Role ID',
            'user_id' => 'User ID',
            'department_id' => 'Department ID',
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
            'position',
            'phone',
            'role_id',
            'user_id',
            'department_id',
        ];
    }

}
