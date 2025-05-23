<?php
class CreateDb
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public$tablename;
    public $con;
//class constructor

    public function __construct(
        $dbname = "moyoshop",
        $tablename = "productdb",
        $username = "root",
        $password = "",
        $servername = "localhost"
    ) {
        $this->dbname = $dbname;
        $this->username = $username;
        $this->tablename = $tablename;
        $this->password = $password;
        $this->servername = $servername;

        // Create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // Check connection
        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Create database query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        // Execute query
        if(mysqli_query($this->con, $sql)) {
            // Database created successfully
            $this->con = mysqli_connect($servername, $username, $password, $dbname);
            // Create table query
             $sql = "CREATE TABLE IF NOT EXISTS $tablename(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(25) NOT NULL,
    product_price FLOAT NOT NULL,
    product_image VARCHAR(100) NOT NULL
)";

            // Execute query
            if (!mysqli_query($this->con, $sql)) {
                echo "Error creating table: " . mysqli_error($this->con);
            }
        } else {
            echo "Error creating database: " . mysqli_error($this->con);
        }

    } 
    // get products from database
    public function getData()
    {
        $sql = "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }    
}



?>