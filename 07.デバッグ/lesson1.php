<?php
// デバック練習
// 氏名入力時に入力内容が表示されるようにプログラムを完成させてください。
// プログラム内にバグが含まれているので正常に動くように修正してください。

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>デバック練習</title>
</head>
<body>
    <section>
    <form action='./debug.php' method="post">
        <label>姓</label>
        <input type="text" name="last_name"/>
        <label>名</label>
        <input type="text" name="first_name" />
        <input type="submit" value="送信する"/>
    </form>
    </section>
</body>
</html>
