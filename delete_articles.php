<?php
require_once 'init.php';

header('Content-Type', 'application/json');

$response = ['success' => false, 'message' => ''];

if(isPostRequest()){

    $data = json_decode(file_get_contents('php://input'), true);

    if(isset($data['article_ids']) && is_array($data['article_ids'])){

        $articleIds = $data['article_ids'];

        try{

            $article = new Article();
            $article -> deleteMultiple($articleIds);
            $response['success'] = true;

        } catch (Exception $exception){
        
        $response ['message'] = 'ERROR'.  $exception->getMessage();
        
    }
}
}

echo json_encode($response);

?>