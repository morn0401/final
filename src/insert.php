<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <?php
        $name = $team = $position = '';

        echo '<form action="insert-output.php" method="post">';
        echo '<table>';
        echo '<tr><td>選手名</td><td>';
        echo '<input type="text" name="name" value="', $name, '" required>';
        echo '</td></tr>';
        echo '<tr><td>チーム</td><td>';
        echo '<select name="team">';
        $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1516798-final;charset=utf8', 'LAA1516798', 'Pass0401');
        foreach ($pdo->query('select * from team') as $row) {
            echo '<option value=', $row['team_id'], '>', $row['team_name'], '</option>';
        }
        echo  ' </select>';
        echo '</td></tr>';
        echo '<tr><td>ポジション</td><td>';
        echo '<select name="position">';
        $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1516798-final;charset=utf8', 'LAA1516798', 'Pass0401');
        foreach ($pdo->query('select * from position') as $row) {
            echo '<option value=', $row['position_id'], '>', $row['position_name'], '</option>';
        }
        echo  ' </select>';
        echo '</td></tr>';
        echo '</table>';
        echo '<input type="submit" value="確定">';
        echo '</form>';
        ?>

        <a href="index.php">一覧に戻る</a>
    </div>

</body>

</html>