<?php
    // A simple PHP script demonstrating how to connect to MySQL.
    // Provides a form for adding, deleting, and editing a student record 
    
    //using my login and password -dc
    $servername = getenv('IP');
    $username = "dcummins";
    $password = "a1b2c3d4e5";
    $database = "c9";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    echo "Connected successfully (".$db->host_info.")";
    
    $thisPHP = $_SERVER['PHP_SELF'];
    if (!isset($_POST['btnEdit'])) {
        echo <<<EOT
        <form action="$thisPHP" method="POST">
        GID: <input type="text" name="gid"> Name: <input type="text" name="name"> <br>
        Phone: <input type="text" name="phone"> Email: <input type="text" name="email"><br>
        <input type="submit" name="Add" value="Add"> <br>
        <hr>
        </form>  
EOT;
    }
    //this is where we listen for the Update button event and run a similar method to add but using UPDATE instead of INSERT -dc
    if(isset($_POST['Update'])) {
        $gid = $_POST['gid'];
        $name = $_POST['name'];
        $phone= $_POST['phone'];
        $email = $_POST['email'];
        
        $sql = "UPDATE Student SET name = '$name', email = '$email', phone = '$phone' WHERE gid = '$gid' ";
        
        if($db->query($sql) == TRUE)
        
        {
            echo "Record Udpated  <br>";
    }
    
    else 
    
    {
        echo "Error Updating Record:" .$db->error;
    }
    }
    // Start executing the script
    
    $gid = $_POST["gid"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    
    // At least name must be specified
    
    if (!empty($name)){
        // Form sql string
        $sql = "insert into Student (GID, Name, Phone, Email) values ('$gid', '$name', '$phone', '$email')";
        if ($db->query ($sql) == TRUE)
        {
            echo "Record added <br>";
        }
    }
    
    // Check if delete is selected
    
    if (isset($_POST['btnDelete'])) {
        $gid = $_POST['gid'];
        $sql = "delete from Student where gid='$gid'";
        if ($db->query ($sql) == TRUE)
        {
            echo "Record deleted <br>";
        }
    } 
    else  if (isset($_POST['btnEdit'])) {
        $sql = "select * from Student where gid='$gid'";
        if (($result = $db->query ($sql)) == TRUE)
        {
            while($row = $result->fetch_assoc()) {
                $gid = $row["GID"];
                $name = $row["Name"];
                $email = $row["Email"];
                $phone = $row["Phone"];
            }
        }
        
        
        //I removed the input for GID if they are just editing a record and not adding -dc
        echo <<<EOE
        <form action="$thisPHP" method="POST">
        Name: <input type="text" name="name" value='$name'> <br>
        Phone: <input type="text" name="phone" value='$phone'> Email: <input type="text" name="email" value='$email'><br>
        <input type="submit" name="Update" value="Update"> <br>
        <hr>
        </form>  
EOE;
}

    
    // Show rows
    $sql = "SELECT * FROM Student";
    $result = $db->query($sql);
    

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
            $gid = $row["GID"];
            echo "id: " . $gid . "  - Name: " . $row["Name"] . 
                " - Email: " . $row["Email"] . 
    		" - Phone: " . $row["Phone"] ; 
		
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