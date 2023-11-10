<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <?php 

        $sxml = simplexml_load_file('catalog.xml');
        echo "<pre>";
        /* print_r($sxml->book[1]->title); */
        echo '<table class=table-simple>
            <thead>
                <th>idbook</th>
                <th>title</th>
                <th>author</th>
                <th>price</th>
            </thead>
        ';
        
        foreach ($sxml as $book ) {
            echo "<tr>";
            echo '<td>', $book->idbook;
            echo '<td>', $book->title;
            echo '<td>', $book->author;
            echo '<td>', $book->price;
            $book->title .= '@';
            
        }

        echo "</table>";


        $book = $sxml->addChild('book');
        $book ->addchild('idbook', 23423);
        $book ->addchild('title', 'React');
        $book ->addchild('author', 'Anon');
        $book ->addchild('price', 2000);






       $sxml->saveXML('catalog2.xml'); 

    ?>



</body>
</html>