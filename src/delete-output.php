<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Deletion</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <?php
        $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1516798-final;charset=utf8', 'LAA1516798', 'Pass0401');
        $sql = $pdo->prepare('delete from player where id=?');
        $sql->execute([$_POST['id']]);
        echo '<p class="success-message">選手を削除しました</p>';
        ?>

        <a href="index1.php" class="back-link">一覧へ戻る</a>

    </div>

</body>

</html>