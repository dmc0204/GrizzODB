<?php

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "grizzodb252";
    $database = "c9";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    echo "Connected successfully (".$db->host_info.")";

    $sql = "SELECT * FROM organizations";
    $result = $db->query($sql);
    

    if ($result->num_rows > 0) {
        // output data of each row
        echo "<select>";
        while($row = $result->fetch_assoc()) 
        {
            $oid = $row["oID"];
            echo "<option value=$oid>{$row["oName"]}</option>";
        }
        echo "</select>";
    } else 
    {
        echo "0 results";
    }
    $db->close();
?>