<?php

use yii\db\Schema;
use yii\db\Migration;

class m150610_121021_init extends Migration
{
    public function up()
    {
        $this->createTable('work', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'start_date' => Schema::TYPE_DATE. ' NOT NULL',
            'end_date' => Schema::TYPE_DATE. ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('work');
    }
    

}
