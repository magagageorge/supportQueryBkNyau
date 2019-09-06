<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerCategories */

$this->title = 'Create Customer Categories';
$this->params['breadcrumbs'][] = ['label' => 'Customer Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
