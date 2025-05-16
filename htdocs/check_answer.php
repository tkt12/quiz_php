<?php
require_once 'db.php';

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$user_answer = isset($_POST['user_answer']) ? trim($_POST['user_answer']) : '';

if ($id <= 0 || $user_answer === '') {
    die('不正なアクセスです。<br><a href="quiz.php">戻る</a>');
}

$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
$stmt->execute([$id]);
$quiz = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$quiz) {
    die('問題が見つかりませんでした。<br><a href="quiz.php">戻る</a>');
}

$is_correct = ($user_answer === $quiz['answer']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>解答結果</title>
</head>
<body>
    <h1>解答結果</h1>

    <p><strong>問題: </strong><?= htmlspecialchars($quiz['question'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>あなたの答え: </strong><?= htmlspecialchars($user_answer, ENT_QUOTES, 'UTF-8') ?></p>

    <?php if ($is_correct): ?>
        <p style="color:green;"><strong>正解！</strong></p>
    <?php else: ?>
        <p style="color:red;"><strong>不正解！</strong></p>
        <p>正解は：<strong><?= htmlspecialchars($quiz['answer'], ENT_QUOTES, 'UTF-8') ?></strong></p>
    <?php endif; ?>

    <p><a href="quiz.php">次の問題へ</a></p>
    <p><a href="index.php">トップに戻る</a></p>
</body>
</html>