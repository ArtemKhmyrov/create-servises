<?php 

class  BookDB{
    const DB_NAME = 'C:/Users/Root/Desktop/create-servises/server/domains/third.site/book.sq3';
    
    private $db;

    public function __construct(){
        $this->db = new SQLite3(self::DB_NAME);
        if(filesize(self::DB_NAME) == 0){
            $this->db->exec('CREATE TABLE book(
                idbook INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT,
                author TEXT,
                price REAL
            )');
        }
    }

    public function insert ($title, $author,  $price){
        $sql = 'INSERT INTO book(title, author, price) VALUES(:title, :author, :price)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $title, SQLITE3_TEXT);
        $stmt->bindParam(':author', $author, SQLITE3_TEXT);
        $stmt->bindParam(':price', $price, SQLITE3_FLOAT);
        $result = $stmt->execute();
        return $result;
    }

    public function count (  ){
        $sql = 'SELECT count(*) FROM book';
        $result = $this->db->querySingle($sql);
        if(!$result){
            return false;
        }
        return $result;
    }


    public function select ( $id = 0 ){
        $sql = 'SELECT idbook, title, author, price FROM book';

        if ( $id ){
            $sql .= ' WHERE idbook=:idbook';
        }

        $stmt = $this->db->prepare( $sql );

        if ($id){
            $stmt->bindParam(':idbook', $id, SQLITE3_INTEGER);
        }

        $result = $stmt->execute();

        $rows = [];

        while($rows[] = $result->fetchArray(SQLITE3_NUM)){ }
        array_pop($rows);
        return $rows;
    }
}