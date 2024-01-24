<?php
require_once('db.php');
$comments = sels('comments', 1, "ORDER BY `top` DESC,`id` DESC");
// 評論
if (isset($_POST['reply'])) {
    upd('comments', ['reply' => $_POST['content']], ['id' => $_POST['reply']]);
    redirect();
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
        <h2>訪客留言版後台管理</h2>
        <hr>
        <?php foreach ($comments as $comment) { ?>
            <div>
                <div class="border rounded mt-4 mb-2 shadow">
                    <div class="row m-2">
                        <div class="col-8">
                            <h5><?= $comment['visitor'] ?></h5>
                            <article class="mb-2" style="white-space: pre-line;"><span><?= !($comment['delete_time']) ? $comment['content'] : '' ?></span></article>
                            <?php
                            if ($comment['img']) {
                                echo '<img class="comment_img" src="' . $comment['img'] . '" />';
                            }
                            ?>
                            <p class="m-0">
                                <?php
                                $message = [];
                                $message[] = "發表於 " . $comment['post_time'];
                                if ($comment['update_time']) {
                                    $message[] = "修改於 " . $comment['update_time'];
                                }
                                if ($comment['delete_time']) {
                                    $message[] = "刪除於 " . $comment['delete_time'];
                                }
                                echo join(' , ', $message);
                                ?>
                            </p>
                            <?php if (!$comment['delete_time']) { ?>
                                <p class="m-0">
                                    <?php if ($comment['display'] % 2 > 0) { ?>
                                        <span>
                                            Email: <?= $comment['email'] ?>
                                        </span>
                                    <?php }
                                    if (intdiv($comment['display'], 2) > 0) { ?>
                                        <span>
                                            Phone: <?= $comment['phone'] ?>
                                        </span>
                                    <?php } ?>
                                </p>
                            <?php } ?>
                        </div>
                        <div class="col-4">
                            <?php if (!$comment['delete_time']) { ?>
                                <form class="h-100" action="./comments_edit.php" method="get">
                                    <div class="row">
                                        <div class="d-none">
                                            <input name="number" type="number" class="form-control" maxlength="4" value="<?= $comment['number'] ?>">
                                        </div>
                                        <div class="col-4 my-1">
                                            <button name="top" value="<?= $comment['id'] ?>" class="btn btn-outline-primary w-100"><?= $comment['top'] ? '取消置頂' : '置頂' ?></button>
                                        </div>
                                        <div class="col-4 my-1">
                                            <button name="upd" value="<?= $comment['id'] ?>" class="btn btn-outline-secondary w-100">編輯</button>
                                        </div>
                                        <div class="col-4 my-1">
                                            <button name="del" value="<?= $comment['id'] ?>" class="btn btn-outline-danger w-100" onclick="return confirm('是否刪除留言?')">刪除</button>
                                        </div>
                                    </div>
                                </form>
                            <?php } else { ?>
                                <div class="h-100 d-flex justify-content-center align-items-center">已刪除</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <form action="" method="post" class="row">
                    <div class="col-10">
                        <input type="text" name="content" class="form-control" placeholder="寫下你的評論" value="<?= $comment['reply'] ?>">
                    </div>
                    <div class="col-2">
                        <button name="reply" value="<?= $comment['id'] ?>" class="btn btn-dark w-100">留言</button>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>