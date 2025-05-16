<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM quizzes ORDER BY RANDOM() LIMIT 1");
$quiz = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>クイズ出題</title>
</head>
<body>
    <h1>クイズ出題</h1>

    <?php if ($quiz): ?>
        <form action="check_answer.php" method="post">
            <p><strong>問題: </strong><?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></p>

            <input type="hidden" name="id" value="<?= $quiz['id'] ?>">

            <label>答え: </label><br>
            <input type="text" name="user_answer" required><br><br>

            <input type="submit" value="解答">
        </form>

        <form action="quiz.php" method="get" style="margin-top: 10px;">
            <button type="submit">次の問題</button>
        </form>
    <?php else: ?>
        <p>問題がありません。</p>
    <?php endif; ?>

    <p><a href="index.php">トップに戻る</a></p>
</body>
</html>