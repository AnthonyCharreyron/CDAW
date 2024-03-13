<?php
public $users = User::query("select * from User");
?>

<!doctype HTML>
<html>

    <head>
        <meta charset="UTF-8">
        <title> Users </title>
    </head>
    <body>
        <?php
            if ($users->rowCount() > 0) {
                echo "<table>";
                echo "<tr><th>Nom</th><th>Email</th><th>Admin</th></tr>";
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