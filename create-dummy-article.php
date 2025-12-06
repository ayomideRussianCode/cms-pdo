<?php

require __DIR__ .'/init.php';

if (isPostRequest()){

    $article = new Article();

    if($article->generateDummyData()){
        redirect('admin.php');
    }
}
?>