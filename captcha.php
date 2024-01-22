<?php
    session_start();
    header('Content-type:image/svg+xml');
    $text = str_pad(rand(0,9999),4,"0",STR_PAD_LEFT);
    $_SESSION['captcha'] = $text;
?>
<svg xmlns="http://www.w3.org/2000/svg" width="120" height="30">
    <text x="0" y="23" style="font-size:30px;"><?=$text?></text>
</svg>