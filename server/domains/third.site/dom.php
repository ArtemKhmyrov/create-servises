<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dom</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <?php 

        $dom = new DOMDocument('1.0','UTF-8');
        $dom->formatOutput = true;
        $dom->preserveWhiteSpace = false;

        $dom->load('catalog.xml');




        $newBook = $dom->createElement('book');

        $idbook = $dom->createElement('idbook', 23);
        $title = $dom->createElement('title', 'PHP8');
        $author = $dom->createElement('author', 'Ноунейм');
        $price = $dom->createElement('price', 2000);

        $newBook->appendChild($idbook);
        $newBook->appendChild($title);
        $newBook->appendChild($author);
        $newBook->appendChild($price);

        $dom->documentElement->appendChild($newBook);

        $books = $dom->getElementsByTagName('book');

        echo "<table class='table-dom'>
            <thead>
                <th>idbook</th>
                <th>title</th>
                <th>author</th>
                <th>price</th>
            </thead>
        ";


        for ($i = 0; $i < $books->length; $i++){
            echo "<tr>";
            $book = $books->item($i);

            $childNodes = $book->childNodes;

            /* read */
   /*          echo "<td>", $idbook = $childNodes->item(1)->nodeValue;
            echo "<td>",$title = $childNodes->item(3)->nodeValue;
            echo "<td>",$author = $childNodes->item(5)->nodeValue;
            echo "<td>",$price = $childNodes->item(7)->nodeValue; */

            /* put */
            echo "<td>", $idbook = $childNodes->item(0)->nodeValue;
            echo "<td>",$title = $childNodes->item(1)->nodeValue;
            echo "<td>",$author = $childNodes->item(2)->nodeValue;
            echo "<td>",$price = $childNodes->item(3)->nodeValue;
        }

        echo "</table>";

        $dom->save('catalog.xml');

    ?>


</body>
</html>