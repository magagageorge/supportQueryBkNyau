<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property int $ticket_no
 * @property string $status
 * @property int $category_id
 * @property int $customer_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $deleted
 * @property int $deleted_by
 * @property string $deleted_at
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'category_id', 'customer_id'], 'required'],
            [['ticket_no', 'category_id', 'customer_id', 'created_by', 'updated_by', 'deleted', 'deleted_by'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title'], 'string', 'max' => 200],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_no' => 'Ticket No',
            'status' => 'Status',
            'title' => 'Title',
            'category_id' => 'Category ID',
            'customer_id' => 'Customer ID',
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
            'ticket_no',
            'status',
            'title',
        ];
    }
}
