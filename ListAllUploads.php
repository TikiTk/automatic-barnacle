<?php
/**
 * Created by PhpStorm.
 * User: kratos
 * Date: 2019/01/05
 * Time: 6:46 PM
 */
$dbLink = new mysqli('127.0.0.1','user','pwd','myTablle');
if(mysqli_connect_error()){
    die("MySQL connection failed: ". mysqli_connect_error());
}

$sqlListAll = 'Select `id`,`filename`,`mime`,`size`,`created`';
$result = $dbLink->query($sqlListAll);

if($result) {
    if ($result->num_rows == 0) {
        echo '<p> There are no uploaded files</p>';
    } else {

        echo '<table width="100%">
                <tr>
                    <td><b>Filename</b></td>
                    <td><b>Mime</b></td>
                    <td><b>Size (bytes)</b></td>
                    <td><b>Created</b></td>
                    <td><b>&nbsp;</b></td>
                </tr>';

        // Print each file
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['filename']}</td>
                    <td>{$row['mime']}</td>
                    <td>{$row['size']}</td>
                    <td>{$row['created']}</td>
                    <td><a href='download.php?id={$row['id']}'>Download</a></td>
                </tr>";
        }

        // Close table
        echo '</table>';
    }
    $result->free();
}

    else{
        echo 'Error in query';
    }

$dbLink->close();
?>