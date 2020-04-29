<?php
    class Category{
        # DB elements
        private $conn;
        private $table = 'categories';

        # properties
        public $id;
        public $name;
        public $created_at;

        # constructor with DB 
        public function __construct($db)
        {
            $this->conn = $db;
        }

        # get categories
        public function read(){
            # read a category query
            $query = 'SELECT id, name, created_at FROM '.$this->table.' ORDER BY created_at ASC';

            # prepare query statement
            $stmt = $this->conn->prepare($query);

            # execute query
            $stmt->execute();

            return $stmt;
        }

        # get single category
        public function read_single(){
            # read single category query
            $query = 'SELECT id, name, created_at FROM '.$this->table.' WHERE id = ? LIMIT 0,1';

            # prepare query statement
            $stmt = $this->conn->prepare($query);

            # bind id
            $stmt -> bindParam(1, $this->id);

            # execute query
            $stmt->execute();

            # fetch array
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            # set properties
            $this->id = $row['id'];
            $this->name = $row['name'];
        }

        # create a category
        public function create(){
            # create a category query
            $query = 'INSERT INTO '.$this->table.' SET name = :name ';

            # prepare query statement
            $stmt = $this->conn->prepare($query);

            # clean data
            $this->name = htmlspecialchars(strip_tags($this->name));

            # bind data
            $stmt->bindParam(':name', $this->name);

            # execute query
            if ($stmt->execute()) {
                return true;
            }
            
            # print error if something is wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
         
        }

        # update a category
        public function update(){
            # update a category query
            $query = 'UPDATE '.$this->table.' SET name = :name WHERE id = :id';

            # prepare query statement
            $stmt = $this->conn->prepare($query);

            # clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));

            # bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':id', $this->id);

            # execute query
            if ($stmt->execute()) {
                return true;
            }

            # print error if something is wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
        }

        # delete a category
        public function delete(){
            # delete a category query
            $query = 'DELETE FROM '.$this->table.' WHERE id = :id';

            # prepare query statement
            $stmt = $this->conn->prepare($query);

            # clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            # bind data
            $stmt->bindParam(':id', $this->id);

            # execute query
            if ($stmt->execute()) {
                return true;
            }

            # print error if something is wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
        }

    }

?>