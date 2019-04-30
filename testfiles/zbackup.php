<?php
    // A simple PHP script demonstrating how to connect to MySQL.
    // Provides a form for adding, deleting, and editing a student record 
    
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "grizzodb252";
    $database = "c9";
    $dbport = 3306;
    
    /*
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "cit252";
    $database = "c9";
    $dbport = 3306;
    */

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
        
    } 
    
    
    $thisPHP = $_SERVER['PHP_SELF'];
    
     echo <<<EOT

        <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color:#38393b;
      height: 100%;
      border-color:#b69d4c;
    }
      body{
          
          background-color:#38393b;
      }
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
    li{
        background-color:#b69d4c;
       
    }
    li:active{
        background-color:black;
    }
  </style>
  
    
  
</head>
<body>

<div class="container-fluid">
  <div class="row content" >
  
    <div class="col-sm-3 sidenav" >
      <h2 style="color:white;">GrizzODB</h2>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="#section1">Home</a></li>
        <li><a href="#section2">Organizations</a></li>
        <!--<li><a href="#section3">Family</a></li>
        <li><a href="#section3">Photos</a></li>-->
      </ul><br>
     
    </div>
    
  
        
       
        
        <div class="col-md-8" id="studinfo">
        
        
        
   
        
  
 
        <div class="well well-sm" style="background-color:#38393b;">
        
        <h3 style="color:white;">Register Your Organization</h3>
 
        <form action="$thisPHP" class="form-group" method="POST">
        
        <div class="well well-sm" style="background-color:#b69d4c;">
        
        Organization Name: <br><input type="text" class="form-control" name="name"><hr>
        Description: <br> <input type="text" class="form-control" name="description" title="Please Enter a Valid Name." > <hr>
        Category: <br><input type="text" class="form-control" name="category" title="Please Enter a Valid Phone Number." ><hr>
        Website: <br><input type="text" class="form-control" name="website" title="Please Enter a Valid Email." ><br>
         Meeting Time: <br><br>
         
          <div class="form-group">
From:
  <select class="form-control" name="from">
  <option></option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
    
  </select>
</div>
 <div class="radio">
  <label><input type="radio" name="ampmfrom" value="AM">AM</label>
</div>
<div class="radio">
  <label><input type="radio" name="ampmfrom" value="PM">PM</label>
</div>

          <div class="form-group">
To:
  <select class="form-control" name="to">
  <option></option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
    
  </select>
</div>

 <div class="radio">
  <label><input type="radio" name="ampmto" value="AM">AM</label>
</div>
<div class="radio">
  <label><input type="radio" name="ampmto" value="PM">PM</label>
</div>


         
         <br>
         Logo URL: <br><input type="text" class="form-control" name="url" " ><br>
        
        <hr>
        <input type="submit" name="submit" class="btn" value="Register"> <br>
        <hr>
        
        </div>
        
        </form>  
        
        </div>
        
     
        
        
        
        </div>
        
        </div>
    </div>

<footer class="container-fluid">
  <p><b>For CIT-252 by Kyndall, Bart, Taylor, Zeyad and Donovan</b></p>
</footer>

</body>



</html>
EOT;
    
    $name = $_POST["name"];
    $desc = $_POST["description"];
    $category = $_POST["category"];
    $website = $_POST["website"];
    $from = $_POST["from"];
    $ampmfrom=$_POST["ampmfrom"];
    $to = $_POST["to"];
    $ampmto = $_POST["ampmto"];
   
    $meeting = $from.$ampmfrom." - ".$to.$ampmto;
    $url = $_POST["url"];
     
     
     // SQL query that adds org info to Organizations table
     
      $sql = "INSERT INTO Organizations(oName, oDescription, oCategory, oWebsite, oMeetingTime,logoURL) VALUES ('$name','$desc','$category','$website','$meeting','$url')";
      
       if (isset($_POST['submit'])) {
           
           
            if ($db->query ($sql) == TRUE)
        {
           
    alert("thank you");

           
           
        
        }
        else{
            echo"Registration Failed";
           
        }
       }
    
    
    
 ?>