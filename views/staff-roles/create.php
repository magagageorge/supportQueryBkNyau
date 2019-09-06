<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StaffRoles */

$this->title = 'Create Staff Roles';
$this->params['breadcrumbs'][] = ['label' => 'Staff Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
