<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontedn\models\Borrowedbook;
use yii\helpers\ArrayHelper;
use frontend\models\Student;
use frontend\models\Book;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Borrowedbook */
/* @var $form ActiveForm */
$students = ArrayHelper::map(Student::find()->all(), 'studentsId', 'fullName');
$books = ArrayHelper::map(Book::find()->where(['status'=>0])->all(), 'bookId', 'bookName');
?>
<div class="borrowbook">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'studentId')->dropDownList($students,['disabled' => false]) ?>
    <?= $form->field($model, 'bookId')->dropDownList($books,['disabled' => false]) ?>
        <?= $form->field($model, 'borrowDate')->hiddenInput(['value'=>date('yy/m/d')])->label(false) ?>
        <?= $form->field($model, 'expectedReturnDate')->widget(
          DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
              'autoclose' => true,
              'format' => 'yyyy-mm-dd'
            ]
          ]);?>
        <div class="form-group">
            <?= Html::submitButton('Confirm', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- borrowbook -->
