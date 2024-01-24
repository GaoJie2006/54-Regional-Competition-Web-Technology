<?php
require_once('db.php');
$comment = null;

// 判斷留言序號是否正確
if ($_GET['upd'] ?? $_GET['del'] ?? $_GET['top'] ?? false) {
    $comment = sel('comments', ['id' => ($_GET['upd'] ?? $_GET['del'] ?? $_GET['top']), 'number' => $_GET['number']]);
    if (empty($comment)) {
        alert('留言序號錯誤', 'comments.php');
    }
}
// 置頂
if (isset($_GET['top'])) {
    upd('comments', ['top' => !$comment['top']], ['id' => $_GET['top']]);
    backPage();
}
// 刪除
if (isset($_GET['del'])) {
    upd('comments', ['delete_time' => date("Y-m-d H:i:s")], ['id' => $_GET['del']]);
    backPage();
}
// 處理資料
if (isset($_POST['submit'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email格式錯誤');history.go(-1);</script>";
        die();
    }
    if (!preg_match("/^[0-9-]+$/", $_POST['phone'])) {
        echo "<script>alert('電話格式錯誤');history.go(-1);</script>";
        die();
    }
    $display = 0;
    if (isset($_POST['display-email'])) {
        unset($_POST['display-email']);
        $display += 1;
    }
    if (isset($_POST['display-phone'])) {
        unset($_POST['display-phone']);
        $display += 2;
    }
    if($_FILES['img']['size'] > 0){
        $path = "./img/".date("YmdHis_").basename($_FILES['img']['name']);
        $upload = move_uploaded_file($_FILES['img']['tmp_name'],$path);
        $_POST['img'] = $path;
    }else{
        $_POST['img'] = $comment['img'] ?? NULL;
    }
    $_POST['user_id'] = $_SESSION['user']['id'] ?? 0;
    $_POST['display'] = $display;
}
// 編輯
if (isset($_GET['upd']) && isset($_POST['submit'])) {
    $_POST['update_time'] = date("Y-m-d H:i:s");
    unset($_POST['submit']);
    upd('comments', $_POST, ['id' => $_GET['upd']]);
    backPage(-2);
}
// 新增
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    ins('comments', $_POST);
    redirect('comments.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('header.php') ?>
</head>

<body>
    <?php require_once('nav.php') ?>
    <div class="container">
        <a class="btn btn-secondary float-right" href="./comments.php">回留言列表</a>
        <h2 class="modal-title">
            訪客留言 -
            <?php
            if (isset($_GET['upd'])) {
                echo "編輯";
            } else {
                echo "新增";
            }
            ?></h2>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="" class="col-4">姓名</label>
                <div class="col-8">
                    <input type="text" name="visitor" class="form-control" required value="<?= $comment['visitor'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-4">Email</label>
                <div class="col-8">
                    <input type="text" name="email" class="form-control" required value="<?= $comment['email'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-4">電話</label>
                <div class="col-8">
                    <input type="text" name="phone" class="form-control" required value="<?= $comment['phone'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-4">內容</label>
                <div class="col-8">
                    <textarea name="content" class="form-control" cols="30" rows="1" required><?= $comment['content'] ?? '' ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-4">圖片</label>
                <div class="col-8">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="img" accept="image/*">
                        <label class="custom-file-label" for="customFile"><?=$comment['img'] ?? 'Choose file'?></label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-4">留言序號</label>
                <div class="col-8">
                    <input type="text" name="number" pattern="\d{4}" class="form-control" required value="<?= $comment['number'] ?? '' ?>">
                </div>
            </div>
            <div class="d-flex">
                <div class="ml-auto">
                    <input type="checkbox" name="display-email" id="display-1" <?= ($comment['display'] ?? 3) % 2 > 0 ? 'checked' : '' ?>>
                    <label for="display-1">顯示Email</label>
                    <input type="checkbox" name="display-phone" id="display-2" <?= intdiv(($comment['display'] ?? 3), 2) > 0 ? 'checked' : '' ?>>
                    <label for="display-2">顯示電話</label>
                </div>
            </div>
            <div class="d-flex">
                <div class="ml-auto">
                    <button type="reset" class="btn btn-secondary">重設</button>
                    <button type="submit" name="submit" class="btn btn-primary">送出</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $('#customFile').change(() => {
            let file = $('#customFile')[0].files[0]
            $('.custom-file-label').text(file.name)
        })
    </script>
</body>

</html>