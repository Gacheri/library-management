<?php

namespace frontend\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Borrowedbook;
use frontend\models\Student;
use Yii;

/**
 * BorrowedbookSearch represents the model behind the search form of `frontend\models\Borrowedbook`.
 */

class BorrowedbookSearch extends Borrowedbook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bbId', 'studentId', 'bookId'], 'integer'],
            [['borrowDate', 'expectedReturnDate', 'actualReturnDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    
    public function search($params)
    {

        if (Yii::$app->user->can('student')){
            $studentsId = Student::find()->where(['userId'=>Yii::$app->user->id])->one();
            $query = BorrowedBook::find()->where(['actualReturnDate'=>NULL])->andWhere(['studentId'=>$studentsId->studentsId]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
    
        if (Yii::$app->user->can('librarian')){
            $query = BorrowedBook::find()->where(['actualReturnDate'=>NULL]);
        
        
        // add conditions that should always apply here
        
            $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);}
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'bbId' => $this->bbId,
            'studentId' => $this->studentId,
            'bookId' => $this->bookId,
            'borrowDate' => $this->borrowDate,
            'expectedReturnDate' => $this->expectedReturnDate,
            'actualReturnDate' => $this->actualReturnDate,
        ]);

        return $dataProvider;
    }
}
}

