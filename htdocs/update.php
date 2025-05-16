<?php
require_once 'db.php';

// 入力値取得
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$action = $_POST['action'] ?? '';

if ($id <= 0) {
    die("IDが不正です。<br><a href='edit.php'>戻る</a>");
}

if ($action === '修正') {
    $question = trim($_POST['question'] ?? '');
    $answer = trim($_POST['answer'] ?? '');

    if ($question === '' || $answer === '') {
        die("問題と答えは必ず入力してください。<br><a href='edit.php'>戻る</a>");
    }
    
    try {
        $stmt = $pdo->prepare("UPDATE quizzes SET question = ?, answer = ? WHERE id = ?");
        $stmt->execute([$question, $answer, $id]);
        echo "修正が完了しました。<br>";
    } catch (PDOException $e) {
        die("修正エラー: " . htmlspecialchars($e->getMessage()));
    }

} elseif ($action === '削除') {
    try {
        $stmt = $pdo->prepare("DELETE FROM quizzes WHERE id = ?");
        $stmt->execute([$id]);
        echo "削除が完了しました。<br>";
    } catch (PDOException $e) {
        die("削除エラー: " . htmlspecialchars($e->getMessage()));
    }

} else {
    die("不正な操作です。<br><a href='edit.php'>戻る</a>");
}
?>

<a href="edit.php">編集画面に戻る</a><br>
<a href="index.php">トップに戻る</a>
