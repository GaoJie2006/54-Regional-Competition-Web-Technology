<?php
if (!isset($_SESSION)) {
    session_start();
}
// date_default_timezone_set('Asia/Taipei');
$db = mysqli_connect("127.0.0.1", "admin", "1234", "web54");

if (!$db) {
    die(mysqli_connect_error());
}

$db->query("SET NAMES UTF8");

function ex($data, $s = ",", $c = "=")
{
    global $db;
    $arrar = [];
    if (is_array($data)) {
        foreach ($data as $k => $v) {
            $v = htmlspecialchars($db->real_escape_string("$v"));
            $array[] = "`$k` $c '$v'";
        }
    } else {
        $array[] = $data;
    }
    $array = join($s, $array);
    return $array;
}

function sel($table, $where = 1)
{
    global $db;
    $w = ex($where, "AND");
    $sql = "SELECT * FROM `$table` WHERE $w";
    $result = $db->query($sql);
    return $result->fetch_assoc();
}

function sels($table, $where = 1, $other = "")
{
    global $db;
    $w = ex($where);
    $sql = "SELECT * FROM `$table` WHERE $w $other";
    $result = $db->query($sql);
    $array = [];
    while ($r = $result->fetch_assoc()) {
        $array[] = $r;
    }
    return $array;
}

function ins($table, $data)
{
    global $db;
    $d = ex($data);
    $sql = "INSERT INTO `$table` SET $d";
    $db->query($sql);
    return $db->insert_id;
}

function upd($table, $data, $where)
{
    global $db;
    $d = ex($data);
    $w = ex($where, "AND");
    $sql = "UPDATE `$table` SET $d WHERE $w";
    $db->query($sql);
}

function del($table, $where)
{
    global $db;
    $w = ex($where, "AND");
    $sql = "DELETE FROM `$table` WHERE $w";
    $db->query($sql);
}

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}
function backPage($count = -1){
    echo "<script>history.go($count)</script>";
    die();
}
function redirect($href = '')
{
    echo "<script>location.href='$href'</script>";
    die();
}

function alert($mess, $href)
{
    echo "<script>alert('$mess');location.href='$href'</script>";
    die();
}
