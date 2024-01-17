<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Player Information</title>
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

        .update-form {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #217dbb;
        }
    </style>
</head>

<body>

    <?php
    $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1516798-final;charset=utf8', 'LAA1516798', 'Pass0401');
    $sql = $pdo->prepare('select * from player where id=?');
    $sql->execute([$_POST['id']]);

    foreach ($sql as $row) {
        echo '<form action="update-output.php" method="post" class="update-form">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';

        // Input for Player Name
        echo '<div class="input-group">';
        echo '<label for="name">選手名</label>';
        echo '<input type="text" name="name" id="name" value="' . $row['name'] . '">';
        echo '</div>';

        // Dropdown for Team
        echo '<div class="input-group">';
        echo '<label for="team">チーム</label>';
        echo '<select name="team" id="team">';

        foreach ($pdo->query('select * from team') as $row2) {
            $selected = ($row['team_id'] === $row2['team_id']) ? 'selected' : '';
            echo '<option value=', $row2['team_id'], ' ', $selected, '>', $row2['team_name'], '</option>';
        }

        echo '</select>';
        echo '</div>';

        // Dropdown for Position
        echo '<div class="input-group">';
        echo '<label for="position">ポジション</label>';
        echo '<select name="position" id="position">';

        foreach ($pdo->query('select * from position') as $row2) {
            $selected = ($row['position_id'] === $row2['position_id']) ? 'selected' : '';
            echo '<option value=', $row2['position_id'], ' ', $selected, '>', $row2['position_name'], '</option>';
        }

        echo '</select>';
        echo '</div>';

        // Submit Button
        echo '<input type="submit" value="確定">';
        echo '</form>';
    }
    echo '<p><a href="index1.php">一覧に戻る</a></p>';
    ?>

</body>

</html>