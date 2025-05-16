<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM quizzes ORDER BY id");
$quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$edit_quiz = null;

if (isset($_POST['load_id'])) {
    $load_id = (int)$_POST['load_id'];
    if ($load_id > 0) {
        $stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
        $stmt->execute([$load_id]);
        $edit_quiz = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>クイズ編集</title>
</head>
<body>
    <h1>クイズ編集・削除</h1>

    <h2>登録済みクイズ一覧</h2>
    <?php if ($quizzes): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr><th>ID</th><th>問題</th><th>答え</th></tr>
            </thead>
            <tbody>
                <?php foreach ($quizzes as $q): ?>
                    <tr>
                        <td><?= htmlspecialchars($q['id']) ?></td>
                        <td><?= htmlspecialchars($q['question'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($q['answer'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>問題は登録されていません。</p>
    <?php endif; ?>

    <hr>

    <h2>編集・削除</h2>

    <form action="edit.php" method="post">
        <label>IDを入力して読込：</label>
        <input type="number" name="load_id" required>
        <input type="submit" value="読込">
    </form>

    <?php if ($edit_quiz): ?>
        <form action="update.php" method="post" style="margin-top:20px;">
            <label>ID：</label><br>
            <input type="number" name="id" value="<?= htmlspecialchars($edit_quiz['id']) ?>" readonly><br><br>

            <label>問題：</label><br>
            <input type="text" name="question" value="<?= htmlspecialchars($edit_quiz['question'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

            <label>答え：</label><br>
            <input type="text" name="answer" value="<?= htmlspecialchars($edit_quiz['answer'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

            <input type="submit" name="action" value="修正">
            <input type="submit" name="action" value="削除" onclick="return confirm('本当に削除しますか？');">
        </form>
    <?php elseif (isset($_POST['load_id'])): ?>

        <p>指定したIDの問題は見つかりませんでした。</p>
    <?php endif; ?>

    <p><a href="index.php">トップに戻る</a></p>
</body>
</html>