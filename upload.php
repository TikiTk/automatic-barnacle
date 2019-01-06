<?php
/**
 * Created by PhpStorm.
 * User: kratos
 * Date: 2019/01/04
 * Time: 7:08 PM
 */

if (isset($_FILES['uploaded_file'])){
    if($_FILES['uploaded_file']['errors'] == 0){
        $DBCONNECTION =  new mysqli('127.0.0.1','user','pwd',myTable);
        if(mysqli_connect_errno()){
            die("Connection to database failed ".mysqli_connect_error());

        }
        $filename = $dbLink->real_escape_string($_FILES['uploaded_file']['filename']);
        $mime = $dbLink->real_escape_string($_FILES['uploaded_file']['type']);
        $size = intval($_FILES['uploaded_file']['size']);
        $data = $dbLink->real_escape_string(file_get_contents(['uploaded_file']['tmp_name']));

        $query = "INSERT INTO `file` (`name`,`mime`,`data`,`created`) values (
            '{$name}','{$mime}',{$size}, '{$data}', NOW() )";

        $result = $dbLink->query($query);

        if($result){
            echo 'File successfully uploaded';
        }else{
            echo 'Error uploading file'. "<pre>{$dbLink->error}</pre>";
        }


    }else{
        echo 'An error accured while the file was being uploaded. '
            . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
    $dbLink->close();

}else{
    echo "Error file was not uploaded";
}
echo '<p>Click <a href="home.php">here</a> to go back</p>';

?>