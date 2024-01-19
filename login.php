<?php
    require_once('db.php');
    if(isset($_POST['login'])){
        // 驗證碼
        if($_SESSION['captcha'] != $_POST['captcha']){
            alert('驗證碼有誤','');
        }

        // 帳號是否存在
        $user = sel('users',['account'=>$_POST['account'],'password'=>$_POST['password']]);
        if(empty($user)){
            alert('帳號或密碼有誤','');
        }

        $_SESSION['user'] = $user;
        alert('登入成功','index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('header.php') ?>
</head>
<body class="login">
    <div class="card bg-white shadow rounded m-auto">
        <div class="card-header">
            <h3 class="text-center">網站管理 -- 登入</h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group row">
                    <label for="" class="col-4">帳號</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="account">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-4">密碼</label>
                    <div class="col-8">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-4">圖形驗證碼</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="captcha">
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <img src="./captcha.php" id="captcha">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-outline-secondary w-100" onclick="newCaptcha()">驗證碼重新產生</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <button type="reset" class="btn w-100">重設</button>
                    </div>
                    <div class="col">
                        <button name="login" class="btn btn-secondary w-100">送出</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function newCaptcha(){
            $('#captcha')[0].src = './captcha.php'
        }
    </script>
</body>
</html>