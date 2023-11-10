<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xnlReader</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>



<?php 

    $xmlReader = new XMLReader();
    $xmlReader->open('catalog.xml');
    echo "<table class='table-xmlreader'>
        <thead>
            <th>idbook</th>
            <th>title</th>
            <th>author</th>
            <th>price</th>
        </thead>
    ";
    while ($xmlReader->read()){
        if( $xmlReader->name == "book"){
            echo "<tr>";
        }
        switch($xmlReader->name){
            case 'idbook': 
            case 'title':  
            case 'author':  
            case 'price':   echo '<td>';
            $node = $xmlReader->expand();
         /*    echo $node->nodeName; */
            echo $node->nodeValue;
            $xmlReader->read();
            $xmlReader->read(); // делаем шаг шоб не читать закрывающий тег и табуляцию
            
        }
    }
    echo '</table>';


?>

</body>
</html>