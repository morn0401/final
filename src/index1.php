<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <table>
            <tr>
                <th>選手名</th>
                <th>チーム</th>
                <th>ポジション</th>
            </tr>
            <?php
            $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1516798-final;charset=utf8', 'LAA1516798', 'Pass0401');
            $sql = $pdo->query('SELECT * FROM player');

            foreach ($sql as $row) {
                echo '<tr>';
                echo '<td>', $row['name'], '</td>';
                echo '<td>';
                $sql1 = $pdo->prepare('SELECT team_name FROM team WHERE team_id=?');
                $sql1->execute([$row['team_id']]);
                $result1 = $sql1->fetch(PDO::FETCH_ASSOC);
                echo $result1['team_name'];
                echo '</td>';
                echo '<td>';
                $sql2 = $pdo->prepare('SELECT position_name FROM position WHERE position_id=?');
                $sql2->execute([$row['position_id']]);
                $result2 = $sql2->fetch(PDO::FETCH_ASSOC);
                echo $result2['position_name'];
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </table>

        <a href="insert.php">選手追加</a>
        <a href="delete.php">選手変更削除</a>

        <h3>絞り込み</h3>
        <form action="search.php" method="post">
            <table>
                <td>
                    <?php
                    echo '<select name="team">';
                    echo ' <option hidden>チーム</option>';
                    foreach ($pdo->query('SELECT * FROM team') as $row) {
                        echo '<option value=', $row['team_id'], '>', $row['team_name'], '</option>';
                    }
                    echo  ' </select>';
                    ?>
                </td>
                <td>
                    <?php
                    echo '<select name="position">';
                    echo ' <option hidden>ポジション</option>';
                    foreach ($pdo->query('SELECT * FROM position') as $row) {
                        echo '<option value=', $row['position_id'], '>', $row['position_name'], '</option>';
                    }
                    echo  ' </select>';
                    ?>
                </td>
                <td>
                    <button class="sort" type="submit">検索</button>
                </td>
            </table>
        </form>

    </div>

</body>

</html>