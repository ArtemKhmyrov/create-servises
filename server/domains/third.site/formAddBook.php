<?php
ob_start(); //старт буферизации вывода

session_start();
include "config.php";
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php
function myfn( $className ){
  include "classes/$className.php";
}
spl_autoload_register('myfn');

$bookDB = new BookDB;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $title = strip_tags(trim( $_POST['title']));
  $author = strip_tags( trim( $_POST['author']));
  $price = (int) $_POST['price'];

  if($bookDB->insert($title, $author, $price)){
    echo 'Вери гуд';
  }
}

?>


<div class="container">
<a href="?download" class="btn btn-lg btn-primary " >Скачать все книги</a>
<h2>Добавление книги</h2>
      <form  method="POST">
      
      <?php if( $change ){ ?>
        <input type="hidden" name="change" value="<?= $change  ?>">
      <?php } ?>

        <div class="form-group">
		  <label for="title">Название книги</label>
          <input type="text" value="<?= $change ? $changeBook->title : ''  ?>" id="title" class="form-control" name="title" placeholder="title" required autofocus autocomplete="off" >
          
        </div>
        
        <div class="form-group">
		<label for="author">Имя автора</label>
          <input type="text" value="<?= $change ? $changeBook->author : ''  ?>" id="author" class="form-control" name="author" placeholder="author" required autofocus autocomplete="off" >
          
       </div>  

       <div class="form-group">
		<label for="price">Цена</label>
        <input type="text" value="<?= $change ? $changeBook->price : ''  ?>" id="price" class="form-control" name="price" placeholder="price" required autofocus autocomplete="off" >
        
      </div>    
      
      <div class="form-group">
		<label for="description">Описание книги</label>
        <textarea id="description" value="<?= $change ? $changeBook->description : ''  ?>" class="form-control" name="description" placeholder="description" required autofocus autocomplete="off" ></textarea>
        
      </div>  

      <div class="form-group">
		<label for="category">Категория</label>
        <select  id="category" class="form-control" name="category" required >
          <option >классика
          <option >компьютерная
          <option >детектив
          <option >художественная
        </select>
        
      </div>  
  
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?= $change ? 'Обновить' : 'Добавить'?></button>
      
      </form>
      </div>
<div class="container">

<form  method="GET">
    <h2>Найти книгу</h2>
    <div class="form-group">
    <label for="title">Название книги</label>
        <input type="text" 
        value=""
        id="title" class="form-control" name="title" placeholder="title" required autofocus autocomplete="off" >
    </div>
</form>

<table class="table table-border">
  <tr>
    <th>№п/п</th>
    <th>Название</th>
    <th>Автор</th>
    <th>Цена</th>
    <th>Операция</th>
  </tr>
<?php 

  if( $rows = $bookDB->select() ){


    /* Выбрать значения */
    foreach ($rows as $row) {
      list($idbook, $title, $author, $price) = $row;
?>
   <tr>
    <td><?= ++$i ?>
    <td><?= $title ?>
    <td><?= $author ?>
    <td><?= $price ?>
    <td>
     <a class='btn btn-primary' href="?title=$idbook ?>">Удалить</a>
     <a class='btn btn-primary' href="?title=$idbook ?>">Изменить</a>
<?php
    }
  }


?>
</table>
</div>

 