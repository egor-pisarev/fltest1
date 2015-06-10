<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property integer $id
 * @property string $title
 * @property string $start_date
 * @property string $end_date
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'start_date', 'end_date'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    public static function getTotalTime()
    {
        $lastWork = null;
        $totalTime = 0;
        foreach(self::find()->orderBy('start_date, end_date')->all() as $work){
            if(is_null($lastWork)){
                $totalTime += $work->getCount();
                $lastWork = $work;
                continue;
            }

            if($work->getEndDateUnixtime() <= $lastWork->getEndDateUnixtime()){
                continue;
            }

            if($work->getStartDateUnixtime() >= $lastWork->getEndDateUnixtime()){
                $totalTime += $work->getCount();
                $lastWork = $work;
                continue;
            }

            $totalTime += ($work->getEndDateUnixtime() - $lastWork->getEndDateUnixtime());

            $lastWork = $work;
        }
        return $totalTime;
    }

    public function getCount()
    {
        return $this->getEndDateUnixtime() - $this->getStartDateUnixtime();
    }

    public function getStartDateUnixtime()
    {
        return strtotime($this->start_date);
    }

    public function getEndDateUnixtime()
    {
        return strtotime($this->end_date);
    }

    public function getDaysCount()
    {
        return floor($this->getCount() / (3600 * 24) );
    }

    public function getMonthsCount()
    {
        return floor($this->getCount() / (3600 * 24 * 30));
    }

}
