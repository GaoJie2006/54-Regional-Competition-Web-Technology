<?php
require_once('db.php');
$comments = sels('comments', 1, "ORDER BY `top` DESC, `id` DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('header.php') ?>
</head>

<body>
    <?php require_once('nav.php') ?>
    <div class="container">
        <a class="btn btn-secondary float-right" href="./comments_edit.php">新增留言</a>
        <h2>訪客留言列表</h2>
        <hr>
        <?php foreach ($comments as $comment) { ?>
            <div class="border rounded mt-4 mb-2 shadow">
                <div class="row m-2">
                    <div class="col-10">
                        <h5><?= $comment['visitor'] ?></h5>
                        <article class="mb-2" style="white-space: pre-line;"><span><?= !($comment['delete_time']) ? $comment['content'] : '' ?></span></article>
                        <h6 class="m-0">
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
                        </h6>
                        <?php if (!$comment['delete_time']) { ?>
                            <h6>
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
                            </h6>
                        <?php } ?>
                    </div>
                    <div class="col-2">
                        <?php if (!$comment['delete_time']) { ?>
                            <div>
                                <h5 class="text-center m-1">留言序號</h5>
                            </div>
                            <form action="./comments_edit.php" method="get">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <input name="number" type="number" class="form-control" maxlength="4">
                                    </div>
                                    <div class="col-6">
                                        <button name="upd" value="<?= $comment['id'] ?>" class="btn btn-success w-100">編輯</button>
                                    </div>
                                    <div class="col-6">
                                        <button name="del" value="<?= $comment['id'] ?>" class="btn btn-outline-danger w-100" onclick="return confirm('是否刪除留言?')">刪除</button>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="h-100 d-flex justify-content-center align-items-center">已刪除</div>
                        <?php } ?>
                    </div>
                    <?php if (trim($comment['reply']) != '') { ?>
                        <div class="col-12">
                            管理員留言：<?= $comment['reply'] ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>