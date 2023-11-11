<?php 
define('BOOKS_JSON', 'books.json');

$counter = 12;

$books = [
    12 => [
        "title" => "Название книги 12",
        "price" => 345.56
    ]
];

if( !file_exists(BOOKS_JSON)){
    file_put_contents(BOOKS_JSON, json_encode($books));
}

$books = json_decode(file_get_contents(BOOKS_JSON), true);

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
header('Content-Type: application/json');

//echo json_encode(["status" => "ok"]);

//Работаем с выборкой - GET
if($_SERVER['REQUES_METHOD'] == 'GET'){
    if($id = (int) $_GET['id']){
        if(array_key_exists($id, $books)){
            http_response_code(200);
            echo json_encode($books[$id]);
            die;
        }
        else{
            http_response_code(404);
            echo json_encode([
                "error" => "Книги с номером id нет",
                "id" => $id
            ]);
            die;
        }
    }
    else{
        http_response_code(200);
        echo json_encode($books);
        die;
    }
}


// Работаем с выборкой - POST

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $method = $input['_method'];
    if( !$method || $method == 'post'){
        $title = strip_tags($input['title']);
        $price = (double) $input['price'];
        
        if ($title && $price){
            $counter = array_key_last($books);
            $books[++$counter] = [
                "title" => $title,
                "price" => $price,
            ];

            file_put_contents(BOOKS_JSON, json_encode($books));

            http_response_code(200);
            echo json_encode([
                'message' => 'Создана новая книга!', 
                'id' => $counter
            ]);
            die;
        }else{
            http_response_code(200);
            echo json_encode([
                "error" => "Указаны не все параметры",
                "id" => $id
            ]);
            die;
        }
    }
}

// Разобраться опчему не работает GET запрос и POST