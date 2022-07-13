<?php
session_start();
date_default_timezone_set('Asia/Taipei');

$dsn = "mysql:host=localhost;charset=utf8;dbname=hejie_vote";
$pdo = new PDO($dsn, 'root', 'root');

// $dsn="mysql:host=localhost;charset=utf8;dbname=s1110222";
// $pdo=new PDO($dsn,'s1110222','s1110222');

function pdo()
{

    $dsn = "mysql:host=localhost;charset=utf8;dbname=hejie_vote";
    return new PDO($dsn, 'root', 'root');

    // $dsn="mysql:host=localhost;charset=utf8;dbname=s1110222";
    // return new PDO($dsn,'s1110222','s1110222');
}
function all($table, ...$arg)
{
    $pdo = pdo();

    //建立共有的基本SQL語法
    $sql = "SELECT * FROM $table ";

    //依參數數量來決定進行的動作因此使用switch...case
    switch (count($arg)) {
        case 1:

            //判斷參數是否為陣列
            if (is_array($arg[0]) && !empty($arg[0])) {

                //使用迴圈來建立條件語句的字串型式，並暫存在陣列中
                foreach ($arg[0] as $key => $value) {

                    $tmp[] = "`$key`='$value'";
                }

                //使用implode()來轉換陣列為字串並和原本的$sql字串再結合
                $sql .= " WHERE " . implode(" AND ", $tmp);
            } elseif (empty($arg[0])) {
            } else {
                //如果參數不是陣列，那應該是SQL語句字串，因此直接接在原本的$sql字串之後即可
                $sql .= $arg[0];
            }
            break;
        case 2:

            if (!empty($arg[0])) {
                //第一個參數必須為陣列，使用迴圈來建立條件語句的陣列
                foreach ($arg[0] as $key => $value) {

                    $tmp[] = "`$key`='$value'";
                }

                //將條件語句的陣列使用implode()來轉成字串，最後再接上第二個參數(必須為字串)
                $sql .= " WHERE " . implode(" AND ", $tmp) . $arg[1];
            } else {
                $sql .= $arg[1];
            }
            break;

            //執行連線資料庫查詢並回傳sql語句執行的結果
    }

    //fetchAll()加上常數參數FETCH_ASSOC是為了讓取回的資料陣列中
    //只有欄位名稱,而沒有數字的索引值
    // echo $sql;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function show_table_contents($table, ...$arg)
{
    $pdo = pdo();

    //建立共有的基本SQL語法
    $sql = "SELECT * FROM $table ";

    //依參數數量來決定進行的動作因此使用switch...case
    switch (count($arg)) {
        case 1:

            //判斷參數是否為陣列
            if (is_array($arg[0]) && !empty($arg[0])) {

                //使用迴圈來建立條件語句的字串型式，並暫存在陣列中
                foreach ($arg[0] as $key => $value) {

                    $tmp[] = "`$key`='$value'";
                }

                //使用implode()來轉換陣列為字串並和原本的$sql字串再結合
                $sql .= " WHERE " . implode(" AND ", $tmp);
            } elseif (empty($arg[0])) {
            } else {
                //如果參數不是陣列，那應該是SQL語句字串，因此直接接在原本的$sql字串之後即可
                $sql .= $arg[0];
            }
            break;
        case 2:

            if (!empty($arg[0])) {
                //第一個參數必須為陣列，使用迴圈來建立條件語句的陣列
                foreach ($arg[0] as $key => $value) {

                    $tmp[] = "`$key`='$value'";
                }

                //將條件語句的陣列使用implode()來轉成字串，最後再接上第二個參數(必須為字串)
                $sql .= " WHERE " . implode(" AND ", $tmp) . $arg[1];
            } else {
                $sql .= $arg[1];
            }
            break;

            //執行連線資料庫查詢並回傳sql語句執行的結果
    }

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


function find($table, $arg)
{
    $pdo = pdo();

    $sql = "SELECT * FROM $table WHERE ";
    if (is_array($arg)) {

        foreach ($arg as $key => $value) {

            $tmp[] = "`$key`='$value'";
        }

        $sql .= implode(" AND ", $tmp);
    } else {

        $sql .= " `id`='$arg'";
    }

    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

function find_something_in_table($table, $arg)
{
    $pdo = pdo();

    $sql = "SELECT * FROM $table WHERE ";
    if (is_array($arg)) {

        foreach ($arg as $key => $value) {

            $tmp[] = "`$key`='$value'";
        }

        $sql .= implode(" AND ", $tmp);
    } else {

        $sql .= " `id`='$arg'";
    }

    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}



function del($table, $arg)
{
    $pdo = pdo();

    $sql = "DELETE FROM $table WHERE ";
    if (is_array($arg)) {

        foreach ($arg as $key => $value) {

            $tmp[] = "`$key`='$value'";
        }

        $sql .= implode(" AND ", $tmp);
    } else {

        $sql .= " `id`='$arg'";
    }

    return $pdo->exec($sql);
}

function delete($table, $arg)
{
    $pdo = pdo();

    $sql = "DELETE FROM $table WHERE ";
    if (is_array($arg)) {

        foreach ($arg as $key => $value) {

            $tmp[] = "`$key`='$value'";
        }

        $sql .= implode(" AND ", $tmp);
    } else {

        $sql .= " `id`='$arg'";
    }

    return $pdo->exec($sql);
}

function math($table, $math, $col, ...$arg)
{
    $pdo = pdo();

    $sql = "SELECT $math(`$col`) FROM $table ";

    if (!empty($arg[0])) {

        foreach ($arg[0] as $key => $value) {

            $tmp[] = "`$key`='$value'";
        }

        $sql .= " WHERE " . implode(" AND ", $tmp);
    }

    //使用fetchColumn()來取回第一欄位的資料，因為這個SQL語法
    //只有select 一個欄位的資料，因此這個函式會直接回傳計算的結果出來
    return $pdo->query($sql)->fetchColumn();
}

function count_avg_min_max($table, $math, $col, ...$arg)
{
    $pdo = pdo();

    $sql = "SELECT $math(`$col`) FROM $table ";

    if (!empty($arg[0])) {

        foreach ($arg[0] as $key => $value) {

            $tmp[] = "`$key`='$value'";
        }

        $sql .= " WHERE " . implode(" AND ", $tmp);
    }

    //使用fetchColumn()來取回第一欄位的資料，因為這個SQL語法
    //只有select 一個欄位的資料，因此這個函式會直接回傳計算的結果出來
    return $pdo->query($sql)->fetchColumn();
}

/**
 * $url - 要導向的檔案路徑及檔名
 */
function  to($url)
{

    header("location:" . $url);
}

function  header_to($url)
{

    header("location:" . $url);
}


function  q($sql)
{
    $pdo = pdo();

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function  query_something($sql)
{
    $pdo = pdo();

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function  update_or_insert_contents_in_table($table, $arg)
{
    $pdo = pdo();
    $sql = '';
    if (isset($arg['id'])) {
        //update

        foreach ($arg as $key => $value) {

            if ($key != 'id') {

                $tmp[] = "`$key`='$value'";
            }
        }
        //建立更新的sql語法
        $sql .= "UPDATE $table SET " . implode(" , ", $tmp) . " WHERE `id`='{$arg['id']}'";
    } else {
        //insert
        $cols = implode("`,`", array_keys($arg));
        $values = implode("','", $arg);

        //建立新增的sql語法
        $sql = "INSERT INTO $table (`$cols`) VALUES('$values')";
    }
    return $pdo->exec($sql);
}

function  save($table, $arg)
{
    $pdo = pdo();
    $sql = '';
    if (isset($arg['id'])) {
        //update

        foreach ($arg as $key => $value) {

            if ($key != 'id') {

                $tmp[] = "`$key`='$value'";
            }
        }
        //建立更新的sql語法
        $sql .= "UPDATE $table SET " . implode(" , ", $tmp) . " WHERE `id`='{$arg['id']}'";
    } else {
        //insert
        $cols = implode("`,`", array_keys($arg));
        $values = implode("','", $arg);

        //建立新增的sql語法
        $sql = "INSERT INTO $table (`$cols`) VALUES('$values')";
    }
    //echo $sql;
    return $pdo->exec($sql);
}


function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function printarray($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
