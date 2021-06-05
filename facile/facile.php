<?php
    include "conn.php";
    
/////function to create a table... it's not for the users, users will have to create tables manually on the server control panel
    function createTable($tbname,$firstRow,$secondRow,$thirdRow,$fourthRow,$fifthRow){
        
        include "conn.php";
        //$tbattributes = array($tbname,$firstRow,$secondRow,$thirdRow,$fourthRow,$fifthRow);
        $sql = "CREATE TABLE $tbname (
        $firstRow INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        $secondRow VARCHAR(30) NOT NULL,
        $thirdRow VARCHAR(30) NOT NULL,
        $fourthRow VARCHAR(50),
        $fifthRow TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    if($conn->query($sql)===TRUE){
        echo "Table $tbname created successfully";
    }
    else{
        echo "Error creating table: " . $conn->error;
    }
}
/*if(! createTable($tbname,$firstRow,$secondRow,$thirdRow,$fourthRow,$fifthRow)){
    echo "Failed";
}*/

////createTable("myexample2","Sn","fname","mname","email","birthdate"); //.....................................................................................

///function to drop a table
function dropTable($tbname){
    include "conn.php";
    $sql = "DROP TABLE $tbname";
    if($conn->query($sql)===TRUE){
        echo "<div class='majibu'><img src='img/tick.png'>Table $tbname deleted successfully</div> <br>";
    }
    else{
        echo "<div class='majibu'><img src='img/cross.png'>Error on deleting Table $tbname from Database</div> <br>" . $conn->error;
    }
}



////dropTable("myexample2"); //................................................................................................................................

///function to Alter Table

//rename table
function renameTable($tbname,$newname){
    include "conn.php";
    $sql ="RENAME TABLE $tbname TO $newname";
    if($conn->query($sql)===TRUE){
        echo "<div class='majibu'><img src='img/tick.png'>Table $tbname Renamed to $newname Successfully</div> <br>";
    }
    else{
        echo "<div class='majibu'><img src='img/cross.png'>Error on Renaming Table $tbname</div> <br>" . $conn->error;
    }

}
////renameTable("myexample1","myexample2"); //........................................................................................................
//add column
function addColumn($tbname,$colname,$dtype,$limit){
    include "conn.php";
    $sql = "ALTER TABLE $tbname ADD $colname $dtype($limit)";
    if($conn->query($sql)===TRUE){
        echo "<div class='majibu'><img src='img/tick.png'>Column $colname added to Table $tbname Successfuly</div> <br>";
    }
    else{
        echo "<div class='majibu'><img src='img/cross.png'>Error on adding column $colname</div> <br>" . $conn->error;
    }


}
////addColumn("example","Lucky_number","INT",30); //......................................................................................

//drop column
function dropColumn($tbname,$colname){
    include "conn.php";
    $sql = "ALTER TABLE $tbname DROP COLUMN $colname";
    if($conn->query($sql)===TRUE){
        echo "<div class='majibu'><img src='img/tick.png'>Column $colname removed from Table $tbname Successfuly</div> <br>";
    }
    else{
        echo "<div class='majibu'><img src='img/cross.png'>Error on removing column $colname</div> <br>" . $conn->error;
    }


}
////dropColumn("myexample2","Lucky_number"); //............................................................................................

//modify column name..... ///Needs reworking..................................................................
function renameColumn($tbname,$colname,$newname){
    include "conn.php";
    $sql = "ALTER TABLE $tbname RENAME COLUMN $colname TO $newname";
    if($conn->query($sql)===TRUE){
        echo "<div class='majibu'><img src='img/tick.png'>Column $colname Renamed to $newname Successfuly</div> <br>";
    }
    else{
        echo "<div class='majibu'><img src='img/cross.png'>Error on renaming column $colname</div> <br>" . $conn->error;
    }
}

////renameColumn("myexample2","fname","Firstname"); //.........................................................................................................



///function to delete data...... Goes together with the refreshing auto increment
function deleteData($tbname,$col,$data){
    include "conn.php";
    $sql = "DELETE FROM $tbname WHERE $col = $data";
    ///$sql = "ALTER TABLE $tbname AUTO_INCREMENT=1";
    $sql = "ALTER TABLE $tbname AUTO_INCREMENT=1";
    if($conn -> multi_query($sql)===TRUE){
        echo "<div class='majibu'><img src='img/tick.png'>Row deleted successfully</div> <br>";
    }
    else{
        echo "<div class='majibu'><img src='img/cross.png'>Error on deleting the row</div> <br>" . $conn->error;
    } 

    
    
}

////deleteData("myexample2","Sn",3); //......................................................................................................

//truncate table(delete all from table)
function truncateTable($tbname){
    include "conn.php";
    $sql = "TRUNCATE TABLE $tbname";
    //$sql = "ALTER TABLE $tbname AUTO_INCREMENT=1";
    if($conn -> query($sql)===TRUE){
        echo "<div class='majibu'><img src='img/tick.png'>Table cleared successfully</div> <br>";
    }
    else{
        echo "<div class='majibu'><img src='img/cross.png'>Error on truncating the Table</div> <br>" . $conn->error;
    } 

}
////truncateTable("myexample2"); //...........................................................................................................

///function to update table data
function editData($tbname,$colx,$datax,$coly,$datay){
    include "conn.php";
    $sql = "UPDATE $tbname SET $colx = '$datax' WHERE $coly = '$datay'";
    if($conn -> query($sql)===TRUE){
        echo "<div class='majibu'><img src='img/tick.png'>Data Updated successfully</div> <br>";
    }
    else{
        echo "<div class='majibu'><img src='img/cross.png'>Error on Updating Data</div> <br>" . $conn->error;
    } 
}
////editData("myexample2","fname","Raymond","Sn",3); //....................................................................................


///function to perform authentication from the database
function authenticate($tbname,$colx,$datax){
    include "conn.php";
    $result = mysqli_query($conn, "SELECT * FROM $tbname WHERE $colx='$datax'");
    $count = mysqli_num_rows($result);
    if($count==0){
        echo  "<div class='majibu'><img src='img/tick.png'>Query succeed <img src='img/warning.png'>User not Found </div> <br>";
    }else{
        echo "<div class='majibu'><img src='img/tick.png'>Query Succeed <img src='img/good.png'>User Found </div> <br>";
    }
}
////authenticate("myexample2","fname","Raymond") //;....................................................................................................


///BACKUP DATABASE function;............................Trouble arranging the syntax;
function backupDB($table_name,$backup_file){
    include "conn.php";

    //$table_name = "example";
    //$backup_file  = "D:/Projects/backup2.sql";
    $sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";
    if($conn -> query($sql)===TRUE){
        echo "<div class='majibu'><img src='img/tick.png'>Database Backup successfully</div> <br>";
    }
    else{
        echo "<div class='majibu'><img src='img/cross.png'>Error on Creating Backup</div> <br>" . $conn->error;
    } 
}
//backupDB("example","D:/Projects/backup2.sql");
//backupDB();
// ..............................................................................................................................

///RETRIEVE BETWEEN function;
function viewBetween(){
    include "conn.php";
    $sql = "SELECT * FROM myexample2 WHERE Sn BETWEEN 1 AND 2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
while($row = $result->fetch_assoc()) {
    echo "<div class='majibu'> id: " . $row["Sn"]. " - Name: " . $row["fname"]. " " . $row["lname"]. "<br></div>";
}
} else {
echo " <div class='majibu'>0 results </div>";
}
}
////viewBetween();

///RETRIEVE NOT BETWEEN function;

///CHECK function;

///DROP CHECK function;

///ADD CONSTRAINT function;

///CREATE DATABASE;

////CREATE PROCEDURE function;

///SELECT DISTINCT function;

///EXISTS function;

///HAVING function;

///IN function;

///IS NULL function;

///IS NOT NULL function;

///LIKE function;

///LIMIT function;

///NOT function;

///OR function;

///ORDER BY (asc and desc)function;

///SELECT INTO (create a backup for a table) function;

///UNION function;

///UNION ALL function;

///UNIQUE function;
?>
<html>
<head>
<title>Facile Control Panel</title>
<meta charset="utf-8">
<style type="text/css">
body{
    background-color: #d4d4d4;
    padding: 0;
    margin: 0;
    overflow: hidden;
}

::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    border: none;
    
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #4A525A,#9CAEA9,#4A525A);
    border-radius: 3px;
}
.header{
    margin-top: 0;
    top: 0;
    height: 80px;
    width: 100%;
    position: absolute;
    background-color: #ececec;
    /*box-shadow: 0 4px 4px rgba(0, 0, 0, .5);*/
}
.header .navbar{
    position: relative;
    float: right;
    width: 200px;
    height: auto;
    
    top: 50px;
}
#icons{
    margin-right: 30px;
}
.left-container{
    height: 600px;
    width: 300px;
    position: absolute;
    top: 70px;
    background-color: #ececec;
    overflow:auto;
    
    /*box-shadow: 0 4px 3px rgba(0, 0, 0, .5);*/
}
.queries{
    height: 90px;
    width: 75%;
    position: absolute;
    top: 90px;
    left: 310px;
    background-color: white;
    border: 1px solid grey;
    
}
#query{
    margin-top: 0px;
    font-family: Arial, Helvetica, sans-serif;
}
.facile-container{
    height: 50%;
    width: 75%;
    position: absolute;
    top: 340px;
    left: 310px;
    
    background-color: #040F0F;
    border: 1px dashed grey;
    color: #ffffff;
}

.options{
    height: 140px;
    width: 75%;
    position: absolute;
    top: 190px;
    left: 310px;
    background-color: #35a09a;
    
}
.majibu{
    height: 50px;
    width: 65%;
    position: absolute;
    top: 110px;
    left: 420px;
    background-color: white;
    font-family: Arial, Helvetica, sans-serif;
    z-index: 999;
}
#logo{
    
    height: 78px;
    width: auto;
    position: absolute;
    top: -30px;
    left: 2px;
    
    
}
.options .button-group{
    margin-top: -30px;
    
}
.facile-container .facile-header{
    top: -30px;
    position: relative;
    font: 20px Arial, Helvetica, sans-serif;
    background-color: #36a19c;
    
}
button{

background-color: #154f30;
color: whitesmoke;
border: 2px solid #194821; /* Green */
cursor: pointer;
margin-right: 2px;

}
.inner{
    width: auto;
    height: 30px;
    background-color: #00000000;
    margin-bottom: 2px;
    margin-left: 3px;
    margin-top: 5px;
    position: relative;
    align-items: center;
    justify-content: center;
    font-family: Arial, Helvetica, sans-serif;
    color: #330b07;
    cursor: pointer;
    
}
.inner:hover{
    color: white;
    background-color: #d4d4d3;
}
.left-container .inner-container{
    margin-top: 50px;
    margin-left: 5px;
}
.codes-container{
    
    position: absolute;
    top: 20px;
    width: auto;
    height: auto;
    color: #3E8914;
    padding: 0.5rem 0.5rem;
    font-family:monospace;
}
#field{
    padding: 1px 4px;
    margin: 1px 0;
    border: none;
    border-bottom: 1px dashed green;
    background-color:  #040F0F;
    width: 70px;
    color: green;
}
</style>
</head>
<body>
    <div class="header"><div id="logo"><img src="img/logo.png"></div> <div class="navbar"><a href="#"><img src="img/github.png" id="icons" title="link to library"></a><a href="#"><img src="img/connect.png" id="icons" title="Contribute to the Library"></a><a href="#"><img src="img/rate.png" id="icons" title="Rate Us"></a></div></div>
    <div class="left-container">
        <div class="inner-container">
        <div class="inner"><img src="img/sql.png"><b>Drop Table</b></div>
        <div class="inner"><img src="img/sql.png"><b>Truncate Table</b></div>
        <div class="inner"><img src="img/sql.png"><b>Alter Table Name</b></div>
        <div class="inner"><img src="img/sql.png"><b>Rename Table Column</b></div>
        <div class="inner"><img src="img/sql.png"><b>Add Table Column</b></div>
        <div class="inner"><img src="img/sql.png"><b>Drop Table Column</b></div>
        <div class="inner"><img src="img/sql.png"><b>Delete Data</b></div>
        <div class="inner"><img src="img/sql.png"><b>Update Data</b></div>
        <div class="inner"><img src="img/sql.png"><b>Authenticate</b></div>

        <div class="inner"><img src="img/sql.png"><b>Backup DB</b></div>
        <div class="inner"><img src="img/sql.png"><b>Backup Table</b></div>
        <div class="inner"><img src="img/sql.png"><b>Between</b></div>
        <div class="inner"><img src="img/sql.png"><b>Not Between</b></div>
        <div class="inner"><img src="img/sql.png"><b>Check</b></div>
        <div class="inner"><img src="img/sql.png"><b>Drop Check</b></div>
        <div class="inner"><img src="img/sql.png"><b>Add Constraint</b></div>
        <div class="inner"><img src="img/sql.png"><b>Create DB</b></div>
        <div class="inner"><img src="img/sql.png"><b>Distinct</b></div>

        <div class="inner"><img src="img/sql.png"><b>Exists</b></div>
        <div class="inner"><img src="img/sql.png"><b>Having</b></div>
        <div class="inner"><img src="img/sql.png"><b>IN</b></div>
        <div class="inner"><img src="img/sql.png"><b>IS NULL</b></div>
        <div class="inner"><img src="img/sql.png"><b>IS NOT NULL</b></div>
        <div class="inner"><img src="img/sql.png"><b>LIKE</b></div>
        <div class="inner"><img src="img/sql.png"><b>LIMIT</b></div>
        <div class="inner"><img src="img/sql.png"><b>NOT</b></div>
        <div class="inner"><img src="img/sql.png"><b>OR</b></div>
        <div class="inner"><img src="img/sql.png"><b>ORDER BY</b></div>
        <div class="inner"><img src="img/sql.png"><b>UNION</b></div>
        <div class="inner"><img src="img/sql.png"><b>UNION ALL</b></div>
        <div class="inner"><img src="img/sql.png"><b>UNIQUE</b></div>
        

        
        
       
</div>
        

    </div>
    <div class="queries"><h4 id="query">Query Results: </h4></div>

    <div class="facile-container"><div class="facile-header"><h5>Terminal</h5></div>
        <div class="codes-container">
        <p>
            SELECT * FROM <input type="text" name="field" id="field"> WHERE <input type="text" name="field" id="field"> = '<input type="text" name="field" id="field">';
        </p></div>
    </div>

    <div class="options"><h4 id="query">Query Selection:</h4><br>
    <div class="button-group"><button>Drop Table</button><button>Truncate Table</button> <button>Alter Table Name</button><button>Rename Table Column</button> <button>Add Table Column</button><button>Drop Table Column</button><button>Delete Data</button> <button>Update Data</button><button>Authenticate</button><br><br>
</div>
</div>
</body>
</html>