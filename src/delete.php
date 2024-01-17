<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player List</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <a href="index1.php">一覧に戻る</a>

        <?php
        echo '<table>';
        echo '<tr><th>選手名</th><th>チーム</th><th>ポジション</th><th></th><th></th></tr>';
        $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1516798-final;charset=utf8', 'LAA1516798', 'Pass0401');
        $sql = $pdo->query('select * from player');

        foreach ($sql as $row) {
            $id = $row['id'];
            echo '<tr>';
            echo '<td>', $row['name'], '</td>';
            echo '<td>';
            $sql1 = $pdo->prepare('select team_name from team where team_id=?');
            $sql1->execute([$row['team_id']]);
            $result1 = $sql1->fetch(PDO::FETCH_ASSOC);
            echo $result1['team_name'];
            echo '</td>';
            echo '<td>';
            $sql2 = $pdo->prepare('select position_name from position where position_id=?');
            $sql2->execute([$row['position_id']]);
            $result2 = $sql2->fetch(PDO::FETCH_ASSOC);
            echo $result2['position_name'];
            echo '</td>';
            echo '<td>';
            echo '<form method="post" action="update.php">';
            echo '<input type="hidden" name="id" value="', $id, '">';
            echo '<input type="submit" value="変更">';
            echo '</form>';
            echo '</td>';
            echo '<td>';
            echo '<form method="post" action="delete-output.php">';
            echo '<input type="hidden" name="id" value="', $id, '">';
            echo '<input type="submit" value="削除">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
        ?>

    </div>

</body>

</html>