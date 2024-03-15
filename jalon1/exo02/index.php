<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Affichage des utilisateurs</title>
    </head>
    <body>

        <div class="container">
            <h1>Liste des utilisateurs</h1>
            <?php
                require_once("Person.php");
                $users= User::query("select * from user");

                if ($users->rowCount() > 0) {
                    echo "<table>";
                    echo "<tr><th>Nom</th><th>Email</th></tr>";
                    foreach($users as $user) {
                        echo "<tr>";
                        if($user->isAdmin()){
                            echo "<td style='color: red'>{$user->NAME}</td>";
                        } else {
                            echo "<td>{$user->NAME}</td>";
                        }
                        echo "<td>{$user->MAIL}</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Aucun utilisateur trouvé.euryfdhvijokpldôlkjh";
                }
            ?>
        </div>

    </body>
</html>
