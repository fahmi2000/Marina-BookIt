<?php

//fetch.php

include('databaseConnect.php');

if(isset($_POST["year"]))
{
 $query = "
 SELECT * FROM booking 
 WHERE year = '".$_POST["year"]."' 
 ORDER BY id ASC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'month'   => $row["month"],
   'total'  => floatval($row["total"])
  );
 }
 echo json_encode($output);
}

?>