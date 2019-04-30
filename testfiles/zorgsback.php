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


echo <<<EOE

<!DOCTYPE html>
<html lang="en">
<head>
  <title>GrizzODB</title>
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
      
      .jumbotron {
   width:75%;
   
    }
.Row
{
    display: table;
    width: 100%; 
    table-layout: fixed; 
    border-spacing: 10px; 
}
.Column
{
    display: table-cell;
    background-color:#38393b; 
    color:white;
    padding: 3px 3px 3px 3px;
}
      
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content" >
  
    <div class="col-sm-3 sidenav" >
      <img src="godbb.png" class="img-fluid" width="250px">
      <ul class="nav nav-pills nav-stacked">
        <li><a href="index.html">Home</a></li>
        <li><a href="orgs.php">Organizations</a></li>
        <li><a href="aboutus.html">About Us</a></li>
       
      </ul><br>
     
    </div>
    
    <div class="col-md-9" style="background-color:#b69d4c;border:0px 0px" height="2000px">
        
        <div class="well-sm" style="background-color:grey;">
 
        <div class="well-sm" style="background-color:#38393b;">
        
            
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-12">
 
     <img src="godbb.png" class="img-fluid" style="float:left;margin-right:200px" >
     
     </div>
     <div class="row">
       <div class="col-xs-12">
       <div class="panel-warning">
    <h1 class="panel-heading">Organizations</h1>
    </div>
    </div>
    </div>
</div>
        </div>
   
 
        </div>
        
        </div>
        <br>
      
      <a href="orgrg.php">
      <button type="button" class="btn text-info" style="font-size:24px">Register Your Organization</button>
      </a>
        
        <br>
        <hr>
EOE;
        
        
    $sql = "SELECT * FROM organizations";
    $result = $db->query($sql);
    

    if ($result->num_rows > 0) {
        // output data of each row
        
        while($row = $result->fetch_assoc()) 
        {
            $oid = $row["oID"];
            
            echo<<<Org
            
            <head>
  <title>GrizzODB</title>
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
      
      .jumbotron {
   width:75%;
   
    }
.Row
{
    display: table;
    width: 100%; 
    table-layout: fixed; 
    border-spacing: 10px; 
}
.Column
{
    display: table-cell;
    background-color:#38393b; 
    color:white;
    padding: 3px 3px 3px 3px;
}
      
  </style>
</head>

<div class="col-sm-12">
<div class="panel panel-warning">
<div class="panel-heading"><h4>{$row["oName"]}</h4></div>
<div class="panel-body" style="color:#38393b">{$row["oDescription"]}
<hr>
<a href="memreg.php">
<button type="btn">Add a Member</button>
</a>
<hr>

Org;

 $sql = "SELECT * FROM members, organizations WHERE members.oFK - organizations.oID =0";
    $resultm = $db->query($sql);
    

    if ($resultm->num_rows > 0) {
        // output data of each row
echo "<br><b>Members:</b><hr>";
        
        while($row = $resultm->fetch_assoc()) 
        {
            

echo <<<members

<b>Member Name:</b> {$row["lName"]}, {$row["fName"]}

members;

 }
      
       echo "</div></div>";
      
    }
      
        }
       
        echo "</body>";
        echo "</html>";
       
    } else 
    {
        echo "0 results";
    }
    $db->close();
    
 


?>