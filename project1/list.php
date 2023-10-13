<?php
define( "ROOT", $_SERVER["DOCUMENT_ROOT"] ."/project1");
define( "FILE_HEADER", ROOT ."/header.php" );
define( "FILE_FOOTER", ROOT ."/footer.php" );
require_once( ROOT ."/lib_db.php" );

$http_method = $_SERVER["REQUEST_METHOD"];
$conn=null;
$id="";
$nowTime = new DateTime(date("Y-m-d"));
$boo_tran=false;
PDO_set($conn);

try {
    $boo_tran = $conn->beginTransaction();

    if($http_method === "POST") {
        var_dump($_POST);
        $id = $_POST["check"];

        if(update_finished($conn, $id) === false){
            throw new Exception("Check error");
        }
    }

    if(list_select($conn) === false){
        throw new Exception("List error");
    }
    $result = list_select($conn);
    foreach ($result as $key => $value) {
        if($value["d_day"] <= date("Y-m-d")){
            if(auto_update_finished($conn) === false){
                throw new Exception("Auto check error");
            }
        }
    }

    // var_dump($result);
    // $auto = auto_update_finished($conn);
    // var_dump($auto);
    
    $conn->commit();
    

} catch (Exception $e) {
    if($boo_tran === true){
        $conn->rollBack();
    }
    echo $e->getMessage();
    exit;
} finally {
    PDO_del($conn);
}

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
    <main id="container">
    
        <form action="/project1/list.php" method="post">
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
                    <td><a class="item_name" href="/project1/detail.php/?id=<?php echo $item["id"]; ?>">
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

