<?php

namespace frontend\controllers;

use Yii;

class AssignController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAssignbook()
{
    $model = new \frontend\models\Borrowedbook();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
             // if ($model->validate()) {
            // form inputs are valid, do something here
            return $this->redirect(['site/index']);
        }

    return $this->renderAjax('assignbook', [
        'model' => $model,
    ]);
}
}
