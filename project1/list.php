<?php
define( "ROOT", $_SERVER["DOCUMENT_ROOT"] ."/project1");
define( "FILE_HEADER", ROOT ."/header.php" );
define( "FILE_FOOTER", ROOT ."/footer.php" );
require_once( ROOT ."/lib_db.php" );

$http_method = $_SERVER["REQUEST_METHOD"];
$conn=null;
$id="";
$nowTime = new DateTime(date("Y-m-d"));
isset($_GET["page"]) && $_GET["page"] == 1 ? $page = 1 : $page = 0;

$boo_tran=false;
PDO_set($conn);

try {
    $boo_tran = $conn->beginTransaction();

    if($page == 1){
        $result = finished_list_select($conn);        
    } else {
        if($http_method === "POST") {
            // var_dump($_POST);
            $id = $_POST["check"];
    
            if(update_finished($conn, $id) === false){
                throw new Exception("Check error");
            }
            unset($_POST);
        }
    
        if(list_select($conn) === false){
            throw new Exception("List error");
        }
        $result = list_select($conn);
        foreach ($result as $value) {
            if($value["d_day"] < date("Y-m-d")){
                if(auto_update_finished($conn) === false){
                    throw new Exception("Auto check error");
                }
            }
        }
    
        // var_dump($result);
        // $auto = auto_update_finished($conn);
        // var_dump($auto);
    }
    
    $conn->commit();
    

} catch (Exception $e) {
    if($boo_tran === true){
        $conn->rollBack();
    }
    echo $e->getMessage();
    exit;
} finally {
    // var_dump(basename($_SERVER['PHP_SELF']));
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
    <main id="container" class="list_m">
    
        <form action="/project1/list.php" method="post">
            <table>
            <?php if($page == 1){ ?>
                <colgroup>
                    <col width=16%>
                    <col width=48%>
                    <col width=16%>
                    <col width=20%>
                </colgroup>
                <?php foreach($result as $item) { ?>
                <tr class="finished">
                    <td><div class="L"><img class="tag_img" src="/project1/img/<?php echo $item["tag_img"]; ?>" alt=""></div></td>
                    <td><a class="item_name" href="/project1/detail.php/?id=<?php echo $item["id"]; ?>&page=<?php echo $page; ?>">
                        <?php echo $item["item_name"]; ?></a>
                    </td>
                    <td><div><?php echo $item["amount"] ." 개"; ?></div></td>
                    <td><div class="R" id="finished_day"><?php echo  substr(str_replace("-", "", $item["d_day"]),2,6); ?></div></td>
                </tr>
            <?php } ?>
            <?php } else { ?>
                <?php foreach($result as $item) { ?>
                    <?php 
                        $diffTime = new DateTime($item["d_day"]);
                        $interval = $nowTime->diff($diffTime);
                        $inter_day = $interval->days;
                        if($inter_day === 0){ $inter_day = "day"; }
                    ?>
                    <tr>
                        <td><div class="L"><img class="tag_img" src="/project1/img/<?php echo $item["tag_img"]; ?>" alt=""></div></td>
                        <td><a class="item_name" href="/project1/detail.php/?id=<?php echo $item["id"]; ?>&page=<?php echo $page; ?>">
                            <?php echo $item["item_name"]; ?></a>
                        </td>
                        <td><div><?php echo $item["amount"] ." 개"; ?></div></td>
                        <td><div><?php 
                            echo "D-{$inter_day}"; 
                        ?></div></td>
                        <td><button type="submit" name="check" value="<?php echo $item["id"] ?>" class="R"><div class="arrow"></div></button></td>
                    </tr>
                <?php } ?>
            <?php }?>
            
            </table>
        </form>
    </main>
    <?php
        require_once(FILE_FOOTER);
    ?> 
</body>
</html>

