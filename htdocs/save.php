<?php
require_once 'db.php';

$question = isset($_POST['question']) ? trim($_POST['question']) : '';
$answer = isset($_POST['answer']) ? trim($_POST['answer']) : '';

if ($question === '' || $answer === '') {
    die('問題と答えの両方を入力してください。<br><a href="create.php">戻る</a>');
}

try {
    $stmt = $pdo->prepare("INSERT INTO quizzes (question, answer) VALUES (?, ?)");
    $stmt->execute([$question, $answer]);

    echo "保存しました！<br>";
    echo '<a href="create.php">別のクイズを作成する</a><br>';
    echo '<a href="index.php">トップに戻る</a>';
} catch (PDOException $e) {
    die("保存エラー: " . htmlspecialchars($e->getMessage()));
}
?>