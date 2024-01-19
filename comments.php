<?php
require_once('db.php');

$comments = sels('comments', 1, "ORDER BY `id` DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('header.php') ?>
</head>

<body>
    <?php require_once('nav.php') ?>
    <div class="container">
        <button class="btn btn-secondary float-right" data-toggle="modal" data-target="#insert">新增留言</button>
        <h2>訪客留言列表</h2>
        <hr>
        <?php foreach ($comments as $comment) { ?>
            <div class="row my-2 border rounded p-1">
                <div class="col-10">
                    <h5><?= $comment['visitor'] ?></h5>
                    <article class="mb-1" style="white-space: pre-line;"><span><?= !($comment['delete_time']) ? $comment['content'] : '' ?></span></article>
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
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <input name="number" type="text" class="form-control" maxlength="4" required>
                                </div>
                                <div class="col-6">
                                    <button number="upd" class="btn btn-success">編輯</button>
                                </div>
                                <div class="col-6">
                                    <button name="del" class="btn btn-outline-danger">刪除</button>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>
                        <div class="h-100 d-flex justify-content-center align-items-center">已刪除</div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div id="insert" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">訪客留言 - 新增</h5>
                    <button class="btn btn-secondary" data-dismiss="modal">回留言列表</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group row">
                            <label for="" class="col-4">姓名</label>
                            <div class="col-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-4">Email</label>
                            <div class="col-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-4">電話</label>
                            <div class="col-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-4">內容</label>
                            <div class="col-8">
                                <textarea name="" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-4">留言序號</label>
                            <div class="col-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary">重設</button>
                    <button type="submit" name="insert" class="btn btn-primary">送出</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>