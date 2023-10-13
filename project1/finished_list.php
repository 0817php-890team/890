<?php
define( "ROOT", $_SERVER["DOCUMENT_ROOT"] ."/project1");
define( "FILE_HEADER", ROOT ."/header.php" );
define( "FILE_FOOTER", ROOT ."/footer.php" );
require_once( ROOT ."/lib_db.php" );

$http_method = $_SERVER["REQUEST_METHOD"];
$conn=null;
$nowTime = new DateTime(date("Y-m-d"));

PDO_set($conn);

$result = finished_list_select($conn);
// var_dump($result);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project1/project_890.css">
    <title>리스트 페이지</title>
</head>
<body>
    <?php
        require_once(FILE_HEADER);
    ?>
    <main id="container" class="list_m">
        <form action="list.php" method="post">
            <table>

                <colgroup>
                    <col width=16%>
                    <col width=48%>
                    <col width=16%>
                    <col width=20%>
                </colgroup>

            <?php foreach($result as $item) { ?>
                <tr class="finished">
                    <td><div class="L">🌭<?php //echo $item["tag_img"]; ?></div></td>
                    <td><a class="item_name" href="/project1/detail.php/?id=<?php echo $item["id"]; ?>">
                        <?php echo $item["item_name"]; ?></a>
                    </td>
                    <td><div><?php echo $item["amount"] ." 개"; ?></div></td>
                    <td><div class="R" id="finished_day"><?php echo  substr(str_replace("-", "", $item["d_day"]),2,6); ?></div></td>
                </tr>
            <?php } ?>
            </table>
        </form>
    </main>
    <?php
        require_once(FILE_FOOTER);
    ?> 
</body>
</html>

