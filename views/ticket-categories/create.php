<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TicketCategories */

$this->title = 'Create Ticket Categories';
$this->params['breadcrumbs'][] = ['label' => 'Ticket Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
