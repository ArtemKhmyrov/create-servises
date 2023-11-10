<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sax</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<?php 
    $sax = xml_parser_create('UTF-8');
    xml_set_element_handler($sax, 'onstart', 'onend');
    xml_set_character_data_handler($sax,'ontext');

    function onstart($parser, $startTag, $attr){
        if ($startTag == 'CATALOG'){
            echo "<table class='table-sax'>
                <thead>
                    <th>idbook</th>
                    <th>title</th>
                    <th>author</th>
                    <th>price</th>
                </thead>
            ";
        }
        if (in_array($startTag, ['IDBOOK','TITLE', 'AUTHOR', 'PRICE'])){
            echo '<td>';
        }
        if ($startTag == 'BOOK'){
            echo '<tr>';
        }
    }

    function onend($parser, $endTag){
        if ($endTag == 'CATALOG'){
            echo '</table>';
        }
    }

    function ontext($parser, $text){
      echo $text;
    }

    xml_parse($sax, file_get_contents('catalog.xml'));

?>

</body>
</html>