<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use frontend\models\Student;
use frontend\models\Book;


/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbook */
/* @var $form ActiveForm */
$students=ArrayHelper::map(student::find()->all(), 'studentsId','studentsId');
$book=ArrayHelper::map(book::find()->all(), 'bookId','bookId');


?>
<div class="assignbook">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'studentId')->dropDownlist($students)?>
        <?= $form->field($model, 'bookId')->dropDownlist($book) ?>
        <?= $form->field($model, 'borrowDate')->widget(
          DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
              'autoclose' => true,
              'format' => 'yyyy-mm-dd'
            ]
          ]); ?>
        <?= $form->field($model, 'returnDate')->widget(
            DatePicker::className(), [
                'inline'=> false,
                'clientOptions'=>[
                    'autoclose'=>true,
                    'format'=>'yyyy-mm-dd'
                ]
            ]

        ) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- assignbook -->
