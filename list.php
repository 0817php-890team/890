<?php
define( "ROOT", $_SERVER["DOCUMENT_ROOT"] ."/project1/" );
define( "FILE_HEADER", "header.php" );
define( "FILE_FOOTER", "footer.php" );
require_once( ROOT ."lib_db_kkh.php" );

$http_method = $_SERVER["REQUEST_METHOD"];
$conn=null;


PDO_set($conn);

$result = list_select($conn);
var_dump($result);
$diff = date_diff( date("Y-m-d"), date_create( $result[0]["d_day"] ) );
var_dump($diff);

if($http_method === "POST") {
    
    var_dump($_POST);
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="project1/common.css">
    <title>리스트 페이지</title>
</head>
<body>
    <?php
        // require_once(FILE_HEADER);
    ?>
    <main class="container">
        <form action="list.php" method="post">
            <table>
            <?php foreach($result as $item) { ?>
                <tr>
                    <td><div class="L">🍔<?php //echo $item["tag_img"]; ?></div></td>
                    <td><a class="item_name" href="/detail.php/?id=<?php echo $item["id"]; ?>">
                        <?php echo $item["item_name"]; ?></a>
                    </td>
                    <td><div><?php echo $item["amount"]; ?></div></td>
                    <td><div><?php //echo "D-" .date("Y-m-d") - $item["d_day"]; ?></div></td>
                    <td><button type="submit" name="check" value="chk_val" class="R"><div class="arrow"></div></button></td>
                </tr>
            <?php } ?>
            </table>
        </form>
    </main>
    <?php
        // require_once(FILE_FOOTER);
    ?> 
</body>
</html>

