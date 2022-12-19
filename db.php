<?php
class connectToDB {

private $conn;

public function __construct()
{
  $config = include 'konek.php';
  $this->conn = new mysqli( $config['db']['server'], $config['db']['user'], $config['db']['pass'], $config['db']['dbname']);
}

function __destruct()
{
  $this->conn->close();
}

public function addCompany( $company, $details, $latitude, $longitude, $telephone){
    $statement = $this->conn->prepare("Insert INTO companies( company, details, latitude, longitude, telephone) VALUES(?, ?, ?, ?, ?)");

$statement->bind_param('sssss', $company, $details, $latitude, $longitude, $telephone);

$statement->execute();

$statement->close();
}

public function getCompaniesList()
{
    $query = "select * from companies";
    $data = mysqli_query($this->conn, $query);
    while ($row = mysqli_fetch_array($data)){
        $hasil[] = $row;
    }
        return $hasil;
    
}
 
/*public function getStreetsList(){
  $query_mysql = mysqli_query($this->conn, "SELECT * FROM streets");
  while ($row = mysqli_fetch_array($query_mysql)){
    $hasil[] = $row;
  }
  return $hasil;
}

public function getAreasList(){
  $query_mysql = mysqli_query($this->conn, "SELECT * FROM areas");
  while ($row = mysqli_fetch_array($query_mysql)){
    $hasil[] = $row;
  }
  return $hasil;
}
*/
}
?>