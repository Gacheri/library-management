<?php

namespace frontend\controllers;
use frontend\models\BorrowedBook;
use frontend\models\BorrowedBookSearch;


use Yii;

class AssignController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAssignbook()
    {
        $model = new \frontend\models\BorrowedBook();

        if ($model->load(Yii::$app->request->post())&& $model->save()) {
        return $this->redirect(['borrowedbook/index']);


};

        return $this->renderAjax('assignhbook', [
            'model' => $model,
        ]);
    }
}
    

