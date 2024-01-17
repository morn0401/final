<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Your Page Title</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .error-message {
            color: red;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            display: block; /* Make it a block-level element */
            margin-bottom: 20px; /* Adjust the margin as needed */
        }

        a:hover {
            text-decoration: underline;
            color: #217dbb;
        }
    </style>
</head>

<body>

    <a href="index.php">一覧に戻る</a>

    <div class="container">

        <?php
        $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1516798-final;charset=utf8', 'LAA1516798', 'Pass0401');

        if ($_POST['position'] === "ポジション") {
            $posi = "%";
        } else {
            $posi = $_POST['position'];
        }

        if ($_POST['team'] === "チーム") {
            $team = "%";
        } else {
            $team = $_POST['team'];
        }

        $sql = $pdo->prepare('SELECT player.name, team.team_name, position.position_name 
                             FROM player
                             JOIN team ON player.team_id = team.team_id
                             JOIN position ON player.position_id = position.position_id
                             WHERE player.position_id LIKE ? AND player.team_id LIKE ?');
        $sql->execute([$posi, $team]);
        ?>

        <?php
        if ($sql->rowCount() > 0) {
            echo '<table>';
            echo '<tr><th>選手名</th><th>チーム</th><th>ポジション</th></tr>';
            foreach ($sql as $row) {
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['team_name'] . '</td>';
                echo '<td>' . $row['position_name'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="error-message">対象の選手がいません</p>';
        }
        ?>

    </div>

</body>

</html>