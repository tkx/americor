<?php

namespace app\commands;

class DbController extends \yii\console\Controller
{
    public function actionX(){
        $queries = file_get_contents(__DIR__ . '/../migrations/big/history.sql'); // 20
        $connection = \Yii::$app->getDb();

        $i = 0;
        foreach(range(0, 10000) as $j) {
            $command = $connection->createCommand($queries);
            $result = $command->execute();
            $i++;
            echo $i . " " . $result . "\n";
            flush();
        }
    }

    public function actionZ(){
        $connection = \Yii::$app->getDb();

        $command = $connection->createCommand("delete from history order by rand() limit 5000");
        $result = $command->execute();
        flush();
    }

    public function actionC(){
        $connection = \Yii::$app->getDb();

        $command = $connection->createCommand("select count(*) from history");
        print_r($command->queryAll());
        flush();
    }
}