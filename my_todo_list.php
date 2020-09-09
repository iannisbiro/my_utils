<!DOCTYPE HTML>
<html>
<head>
    <style>
    html {
        font:13px Arial;
    }
    input[type="submit"] {
        padding:3px 0 3px 0;
        font:bold 13px Arial;
        color:#fff;
        width:auto;
        border:none;
        cursor:pointer;
        margin-left: 7px;
        margin-top: 7px;
    }
    .boutonVert{
        background:#00FF00;
    }
    .boutonRouge{
        background:#FF0000;
    }
    .boutonBleu{
        background:#87CEFA;
    }
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    li {
        font:16px Arial;
    }
    h2{
        margin-left:5px;
    }
    </style>
    <div style="padding:3%;text-align:center"><title>My_Todo_List</title>
    <h1>My_Todo_List</h1>
    
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "My_Todo_List";

try {


 
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['ajouterTache'] )) {
      $sql = "INSERT INTO tache (contenu, etat) VALUES ('". $_POST['ajouterTache'] ."', 'af')";
      $conn->exec($sql);
  }
  if (isset($_POST['idTacheFait'] )) {
      $sql = "UPDATE tache SET etat = 'f' WHERE id =".$_POST['idTacheFait'];
      $conn->exec($sql);
  }
  if (isset($_POST['idTacheSupprimer'] )) {
      $sql = "DELETE FROM tache WHERE id =".$_POST['idTacheSupprimer'];
      $conn->exec($sql);
  }

  $sql =  'SELECT id,contenu,etat FROM tache';

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

  ?>
  <div style="background-color:#ffffd6;float:left;width:40%;margin-left:10%;margin-top:10px"><br><h2>A faire : </h2><ul><?php
foreach  ($conn->query($sql) as $row) {
    if ($row['etat'] == 'af')
    {
        ?>
        <span style="display:inline-block">
        <li>
            <?php print  $row['contenu'] . "\t";?>
        </li>
        </span>
        <span style="display:inline-block">
            <form action="My_Todo_List.php" method="post">
                <input type="hidden" id="idTacheSupprimer" name="idTacheSupprimer" value="<?php echo $row['id']?>">
                <input class="boutonRouge" type="submit" value=" Supprimer ">
            </form>
        </span>
        <span style="display:inline-block">
        <form action="My_Todo_List.php" method="post">
            <input type="hidden" id="idTacheFait" name="idTacheFait" value="<?php echo $row['id']?>">
            <input class="boutonBleu" type="submit" value=" Finie ">
            </form>
        </span>
        <br>
        <br>
        <?php
    }  
}
?>
</ul>
</div>
<?php

?><div style="background-color:#fffff0;margin-left:51%;margin-right:10%;margin-top:10px"><br><h2>Finie : </h2><ul><?php
foreach  ($conn->query($sql) as $row) {
    if ($row['etat'] == 'f')
    {
        ?>
        <span style="display:inline-block">
            <li><?php print  $row['contenu'] . "\t";?></li>
        </span>
        <span style="display:inline-block">
            <form action="My_Todo_List.php" method="post">
                <input type="hidden" id="idTacheSupprimer" name="idTacheSupprimer" value="<?php echo $row['id']?>">
                <input class="boutonRouge" type="submit" value=" Supprimer ">
            </form>
        </span>
        <br>
        <br>
        <?php
    }  
}
?>
</ul>
</div>
<?php

  /*
  // sql to create table
  $sql = "CREATE TABLE tache (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  contenu VARCHAR(140) NOT NULL,
  etat VARCHAR(30) NOT NULL
  )";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table tache created successfully";*/


$conn = null;
?>
<div style="margin-left: 10%;margin-top: 20px;margin-right: 10%;">
    <form action="My_Todo_List.php" method="post">
    <h2>Nouvelle tache : </h2>
    <input type="text" id="ajouterTache" name="ajouterTache" maxlength="140" style="margin-bottom:10px" placeholder="ajouter une tâche"><br>
    <input class="boutonVert" type="submit" value=" Ajouter">
    </form>
    </div>
</div></body>
</html>




