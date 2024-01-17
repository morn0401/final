<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Added</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #3498db;
        }

        p {
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
            color: #217dbb;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php

        $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1516798-final;charset=utf8', 'LAA1516798', 'Pass0401');
        $sqlInsert = $pdo->prepare('INSERT INTO `player` (`name`, `position_id`, `team_id`) VALUES (?, ?, ?)');
        $sqlInsert->execute([
            $_POST['name'],
            $_POST['position'],
            $_POST['team']
        ]);

        echo '<h2>選手が追加されました</h2>';
        echo '<p>選手名: ' . $_POST['name'] . '</p>';

        $sql1 = $pdo->prepare('SELECT team_name FROM team WHERE team_id=?');
        $sql1->execute([$_POST['team']]);
        $result1 = $sql1->fetch(PDO::FETCH_ASSOC);
        echo '<p>チーム: ' . $result1['team_name'] . '</p>';

        $sql2 = $pdo->prepare('SELECT position_name FROM position WHERE position_id=?');
        $sql2->execute([$_POST['position']]);
        $result2 = $sql2->fetch(PDO::FETCH_ASSOC);
        echo '<p>ポジション: ' . $result2['position_name'] . '</p>';
        ?>
        <p><a href="index.php">一覧に戻る</a></p>
    </div>

</body>

</html>