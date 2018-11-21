<?php

$edit = $_POST["edit"];
$name = $_POST["name"];
$delete_id = $_GET["delete_id"];

if ($edit != "") {
    $content = $_POST["content"];

    $addtime = date("Y-m-d h:i:s");
    $link = mysqli_connect("127.0.0.1", "root", "chen8888");

    // if ($link)
    //     echo "ok!<br>";
    // else {
    //     echo "bad!<br>";
    // }

    mysqli_select_db($link, "test");

    $update = "update test set author='$name',addtime='$addtime',content='$content' where id = '$edit'";
    mysqli_query($link, $update);
    mysqli_close($link);

    echo "<script language=javascript>alert('編輯成功!');location.href='index.php';</script>";
} else if ($name != "") {
    $content = $_POST["content"];

    $addtime = date("Y-m-d h:i:s");
    $link = mysqli_connect("127.0.0.1", "root", "chen8888");

    // if ($link)
    //     echo "ok!<br>";
    // else {
    //     echo "bad!<br>";
    // }

    mysqli_select_db($link, "test");

    $insert = "insert into message(author,addtime,content) values('$name','$addtime','$content')";
    mysqli_query($link, $insert);
    mysqli_close($link);

    echo "<script language=javascript>alert('留言成功!');location.href='index.php';</script>";
} else if ($delete_id != "") {
    $link = mysqli_connect("127.0.0.1", "root", "chen8888");

    // if ($link)
    //     echo "ok!<br>";
    // else {
    //     echo "bad!<br>";
    // }

    mysqli_select_db($link, "test");

    $insert = "delete from message where id = '$delete_id'";
    mysqli_query($link, $insert);
    mysqli_close($link);

    echo "<script language=javascript>alert('刪除成功!');location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>留言板</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/base.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400|Quattrocento+Sans|Crimson+Text|Tangerine|Alex+Brush"
        rel="stylesheet">
    <link href="/base.css" rel="stylesheet">
</head>

<body>
    <header class="page-header" id="header">
        <h1>
            <span style="color: grey">#</span>留言板
        </h1>
    </header>
    <div id="board" class="container section">
        <h2><span style="color: grey;letter-spacing:8px;">#</span>留言</h2>
        <div id="page_num" style="float:right;">第 1 頁</div>
        <br>
        <ol id="messageList">

            <?php
            $link = mysqli_connect("127.0.0.1", "root", "chen8888");

            mysqli_select_db($link, "test");

            $sql = "select author, addtime, content, id from message";

            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <li class="message"> <span>
                        <span style="float:right;" >
                            <a class="close" href="index.php?delete_id=<?php echo $row[3] ?>">×</a>
                            <a class="close" href="javascript:edit(<?php echo $row[3] ?>)">!</a>
                        </span>
                        <div class="content">
                            <p id="from">From: <?php echo $row[0] ?></p>
                            <p><?php echo $row[2] ?></p>
                        </div>
                        <br>
                        <div class="rightbottom">
                        <?php echo $row[1] ?>
                        </div> 
                    </span></li>
                    <br>
                    <?php
                }
            } else {
                echo "0 结果";
            }

            mysqli_close($link);
            ?>

        </ol>
        
    </div>
    <div class="container section">
        <h2><span style="color: grey;letter-spacing:8px;">#</span>新增留言</h2>
        <form action="index.php" method="post" id="form">
            <label for="user" style="display:inline-block;">來自: </label>
            <div>
                <input id="user" type="text" name="name" class="round">
            </div>

            <label for="new_message" style="display:inline-block;">訊息: </label>
            <div>
                <textarea id="new_message" name="content" class="round" cols="70" rows="5" required></textarea>
            </div>
            <button type="submit" id="submit" class="btn">提交</button>
        </form>
    </div>

</body>

</html>