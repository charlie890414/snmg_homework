<?php

$name = $_POST["name"];
if ($name != "") {
    $content = $_POST["content"];

    $addtime = date("Y-m-d h:i:s");//得到日期
    $link = mysqli_connect("127.0.0.1", "root", "chen8888");

    if ($link)
        echo "ok!<br>";
    else {
        echo "bad!<br>";
    }

    mysqli_select_db($link, "test");

    $insert = "insert into message(author,addtime,content) values('$name','$addtime','$content')";
    mysqli_query($link, $insert);
    mysqli_close($link);

    echo "<script language=javascript>alert('留言成功!');location.href='index.php';</script>";
}
mysqli_close($link);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
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
        <form onsubmit="getFilter();return false;">
            <label for="filter">Filter(留言人/訊息內容): </label>
            <input id="filter" type="text" name="filter" class="round">
            <button type="submit" class="btn small-btn">Apply</button>
            <button onclick=clearFilter() class="btn small-btn">Clear</button>
        </form>
        <br>
        <form onsubmit="change_sort('time');getList(1);return false;" class="row">
            <button id="time_btn" class="small-btn">以時間排序</button>
        </form>
        <form onsubmit="change_sort('user');getList(1);return false;" class="row">
            <button id="user_btn" class="small-btn">以留言人排序</button>
        </form>
        <form onsubmit="change_sort('len');getList(1);return false;" class="row">
            <button id="len_btn" class="small-btn">以留言長短排序</button>
        </form>
        <div id="page_num" style="float:right;">第 1 頁</div>

        <ol id="messageList">

            <?php
            $link = mysqli_connect("127.0.0.1", "root", "chen8888");

            mysqli_select_db($link, "test");

            $sql = "select author, addtime, content from message";

            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <li class="message"> <span>
                        <span style="float:right;" >
                            <a class="close" href="javascript:Delete(<?php echo $row[1]?>);">×</a>
                        </span>
                        <div class="content">
                            <p id="from">From: <?php echo $row[0]?></p>
                            <p><?php echo $row[2]?></p>
                        </div>
                        <br>
                        <div class="rightbottom">
                        <?php echo $row[1]?>
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
        <div class="rightbottom">
            <form onsubmit="getPageRel(-1);return false;" class="row">
                <button class="small-btn">上一頁</button>
            </form>
            <form onsubmit="getPageDir(event);return false;" class="row">
                跳至第<input id="page" type="text" size="3">頁
            </form>
            <form onsubmit="getPageRel(1);return false;" class="row">
                <button class="small-btn">下一頁</button>
            </form>
        </div>
    </div>
    <div class="container section">
        <h2><span style="color: grey;letter-spacing:8px;">#</span>新增留言</h2>
        <form action="index.php" method="post">
            <label for="user" style="display:inline-block;">From: </label>
            <div>
                <input id="user" type="text" name="name" class="round">
            </div>

            <label for="new_message" style="display:inline-block;">訊息: </label>
            <div>
                <textarea id="new_message" name="content" class="round" cols="70" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn">提交</button>
        </form>
    </div>

</body>

</html>