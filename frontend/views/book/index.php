<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Book;
use yii\bootstrap\modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
$status='status';

?>
<div class="box box-info">
            <div class="box-header with-border">
            <?php if(Yii::$app->user->can('librarian')) {?>
          <?= Html::a('Add Book', ['create'], ['class' => 'btn btn-success']) ?> <?php }?>
              <div style="text-align: center;">
                  <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
              </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

        <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'bookId',
            'bookName',
            'referenceNo',
            'publisher',
    
           /* [
              'label'=>'Book Status',
              'format' => 'raw',
              'value' => function ($dataProvider) {
                $status='status';
                $bookstatus = Book::find()->where(['bookId'=>$dataProvider->bookId])->one();
                if($bookstatus->status == 0){
                  $status = 'Available';
                  return '<span class="btn btn-info">'.$status.'</span>';
                }elseif ($bookstatus->status == 1) {
                  $status = 'Issued';
                  return '<span class="btn btn-success">'.$status.'</span>';
                }elseif ($bookstatus->status == 2) {
                  $status = 'Pending';
                  return '<span class="btn btn-danger">'.$status.'</span>';
                }
              // return '<span class="btn btn-info">'.$status.'</span>';
                },
            ],*/

           [
              'label'=>'Status',
              'format' => 'raw',
              'value' => function ($dataProvider) {
                  $status='status';
                  $bookStatus = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                  if($bookStatus->status == 0){
                      $status = 'Borrow';
                      return '<span class="btn btn-primary borrowbook">'.$status.'</span>';
                  }elseif ($bookStatus->status == 1){
                      $status = 'Issued';
                      return '<span class="btn btn-success disabled ">'.$status.'</span>';
                  }elseif ($bookStatus->status == 2){
                      $status = 'Pending';
                  }
                  return '<span class="btn btn-info">'.$status.'</span>';
              },
              
          ],

            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]);?>
    <?php
        Modal::begin([
            'header'=>'<h4> ADD AUTHOR </h4>',
            'id'=>'addauthor',
            'size'=>'modal-lg'
            ]);
        echo "<div id='addauthorContent'></div>";
        Modal::end();
      ?>
     
     <?php
 Modal::begin([
            'header'=>'<h4>Borrow A Book</h4>',
            'id'=>'borrowbook',
            'size'=>'modal-lg'
            ]);
        echo "<div id='borrowbookContent'></div>";
        Modal::end();
 ?>
