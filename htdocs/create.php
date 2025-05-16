<?php require_once 'db.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>クイズ作成</title>
</head>
<body>
    <h1>クイズ作成</h1>

    <form action="save.php" method="post">
        <label>問題:</lavel><br>
        <input type="text" name="question" required><br><br>

        <label>答え:</label><br>
        <input type="text" name="answer" required><br><br>

        <input type="submit" value="保存">
    </form>

    <p><a href="index.php">トップに戻る</a></p>
</body>
</html>