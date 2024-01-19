<div class="mb-3">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./comments.php">訪客留言</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./visitors.php">訪客訂房</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./booking.php">訪客訂餐</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./menu.php">交通資訊</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">網站管理</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
        <div class="bg-light">
            <div class="container py-2">
                <div class="row text-center">
                    <div class="col">
                        <a class="sec-nav-link" href="">留言管理</a>
                    </div>
                    <div class="col">
                        <a class="sec-nav-link" href="">訂房管理</a>
                    </div>
                    <div class="col">
                        <a class="sec-nav-link" href="./logout.php">登出</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>