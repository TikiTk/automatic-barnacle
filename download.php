<?php
/**
 * Created by PhpStorm.
 * User: kratos
 * Date: 2019/01/05
 * Time: 7:00 PM
 */

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($id <= 0) {
        die("Invalid ID");

    }
    else {
        $dbLink = new mysqli('127.0.0.1', 'user', 'pwd', 'myTable');
        if (mysqli_connect_errno()) {
            die("MySQL connection failed: " . mysqli_connect_error());
        }
        $query = "
            SELECT `mime`, `filename`, `size`, `data`
            FROM `file`
            WHERE `id` = {$id}";
        $result = $dbLink->query($query);

        if ($result) {
            if ($result->num_rows == 1) {
                $row = mysqli_fetch_assoc($result);

                header("Content-Type" . $row['mime']);
                header("Content-Length" . $row['size']);
                header("Content-Disposition: attachment; filename=" . $row['filename']);
                echo $row['data'];

            } else {
                echo "Uploaded File not found";
            }

            @mysqli_free_result($result);
        }
        else{
                echo "Error! Query failed: <pre>{$dbLink->error}</pre>";
            }
            $dbLink->close();
        }

    }

else{
        echo "Error! No ID was received";
    }
?>