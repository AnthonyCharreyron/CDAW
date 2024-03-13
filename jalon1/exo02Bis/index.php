<?php

require_once('User.php');
$users = User::query("select * from User");
?>

<!doctype HTML>
<html>

    <head>
        <meta charset="UTF-8">
        <title> Users </title>
    </head>
    <body>
        <h1>Liste des utilisateurs</h1>
        <?php
            if ($users->rowCount() > 0) {
                echo "<table>";
                echo "<tr><th>Nom</th><th>Email</th></tr>";
                foreach($users as $user) {
                    echo "<tr>";
                    if($user->isAdmin()){
                        echo "<td style='color: red'>{$user->name}</td>";
                    }else{
                        echo "<td>{$user->name}</td>";
                    }
                   
                    echo "<td>{$user->email}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Aucun utilisateur trouvé.";
            }
        ?>

    </body>


</html>