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
    
    echo <<<EOT
        <form action="$thisPHP" method="POST">
        Org Name: <input type="text" name="oname"> <br>
        Description: <input type="text" name="odescription"> <br>
        Category: <input type="text" name="ocategory"> <br>
        Website: <input type="text" name="owebsite"> <br>
        Logo URL: <input type="text" name="logourl"> <br>
        <input type="submit" name="Add" value="Add"> <br>
        <hr>
        </form>  
EOT;

        $oid = $_POST['oid'];
        $name = $_POST['oname'];
        $description = $_POST['odescription'];
        $category= $_POST['ocategory'];
        $website = $_POST['owebsite'];
        $logourl = $_POST['logourl'];
        
         if (!empty($name)){
        // Form sql string
        $sql = "INSERT into organizations (oName, oDescription, oCategory, oWebsite, logoURL) values ('$name', '$description', '$category', '$website', '$logourl')";
        if ($db->query ($sql) == TRUE)
        {
            echo "Record added <br>";
        }
    }
    
    // Show rows
    $sql = "SELECT * FROM organizations";
    $result = $db->query($sql);
    

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
            $oid = $row["oID"];
            echo "id: " . $oid . "  - Name: " . $row["oName"] . 
                " - Description: " . $row["oDescription"] . 
    		" - Category: " . $row["oCategory"] . " - Website: " . $row["oWebsite"] . " - logoURL: " . $row["logoURL"]; 
		
    		echo " <form action=\"$thisPHP\" method='post' style=\"display:inline\" >";
        	echo "<input type='hidden' name='gid' value='$gid'>";
    		echo "<input type='submit' name='btnEdit' value='Edit'> ";
    		echo "<input type='submit' name='btnDelete' value='Delete'>  </form>" . "<br>";
        }
    } else 
    {
        echo "0 results";
    }
    $db->close();

?>