<?php
include ROOT."/models/News.php";
class NewsController{
    public function actionIndex(){
        $newsList = News::getNewsList();
        echo '<pre>';
        print_r($newsList);
        echo '</pre>';
        return true;
    }
    public function actionView($id){
        if ($id){
            $newsItem = News::getNewsItemById($id);
            echo '<pre>';
            print_r($newsItem);
            echo '</pre>';
        }

        return true;
    }
}