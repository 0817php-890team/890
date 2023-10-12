<?php
define( "ROOT", $_SERVER["DOCUMENT_ROOT"]);
define( "FILE_HEADER", ROOT ."/Project1_ysj/header.php" );
define( "FILE_FOOTER", ROOT ."/project1_yhh/footer.php" );
require_once( ROOT ."/project1/lib_db_kkh.php" );

$http_method = $_SERVER["REQUEST_METHOD"];
$conn=null;
$nowTime = new DateTime(date("Y-m-d"));

PDO_set($conn);

if($http_method === "POST") {
    // var_dump($_POST);
    $id = $_POST["check"];

    $conn->beginTransaction();
    update_finished($conn, $id);
    $conn->commit();

}
$result = list_select($conn);
// var_dump($result);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../project_890.css">
    <title>리스트 페이지</title>
</head>
<body>
    <?php
        require_once(FILE_HEADER);
    ?>
    <main id="container">
    
        <form action="list.php" method="post">
            <table>
            <?php foreach($result as $item) { ?>
                <?php 
                    $diffTime = new DateTime($item["d_day"]);
                    $interval = $nowTime->diff($diffTime);
                    $inter_day = $interval->days;
                    if($inter_day === 0){ $inter_day = "day"; }
                ?>
                <tr>
                    <td><div class="L">🌭<?php //echo $item["tag_img"]; ?></div></td>
                    <td><a class="item_name" href="/project1_yhh/890_detail.php/?id=<?php echo $item["id"]; ?>">
                        <?php echo $item["item_name"]; ?></a>
                    </td>
                    <td><div><?php echo $item["amount"] ." 개"; ?></div></td>
                    <td><div><?php 
                        echo "D-{$inter_day}"; 
                    ?></div></td>
                    <td><button type="submit" name="check" value="<?php echo $item["id"] ?>" class="R"><div class="arrow"></div></button></td>
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

