<?php
define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/project1/");
define("FILE_HEADER", ROOT."header.php");
define("FILE_FOOTER", ROOT."footer.php");
require_once(ROOT."lib_db_kkh.php");


$http_method=$_SERVER["REQUEST_METHOD"];


try{
    $conn=null;
    // 디비 접속
    if(!PDO_set($conn) === false){ // 재워놓음
        throw new Exception("DB error : PDO instance"); // 강제 예외
    }

    // DB 조회시 사용할 데이터 배열
    $arr_param=[
    ];

    // 미완료 리스트 조회
    $result = list_select($conn);
    if(!$result === false){ // 재워놓음
        throw new Exception("DB error : 리스트셀렉트");
    }

    if($http_method === "POST"){

    }
    
} catch(Exception $e) {
    echo $e->getMessage(); // 예외발생 메세지 출력
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
    <link rel="stylesheet" href="common.css">
    <title>리스트 페이지</title>
</head>
<body>
    <?php
        require_once(FILE_HEADER);
    ?>

    <main>

        <table>

            <colgroup>
                <col width=15%>
                <col width=40%>
                <col width=15%>
                <col width=15%>
                <col width=15%>
            </colgroup>

            <?php
                // foreach($result as $item){ ?>

                    <tr>
                        <td>아이콘<?php // echo $item[""]; ?></td>
                        <td id="title">
                            제품명
                            <a href="/mini_board/src/detail.php/?id=<?php // echo $item["id"]; ?>&page=<?php // echo $page_num; ?>">
                            <?php // echo $item["title"]; ?></a>
                        </td>
                        <td>수량<?php // echo $item["ip"]; ?></td>
                        <td>
                            기한
                            <?php
                                // if(date("Y-m-d") == substr($item["create_at"],0,10)){
                                //     echo substr($item["create_at"],10,6);
                                // }
                                // else {echo substr($item["create_at"],0,10);}
                            ?>
                        </td>
                        <td>
                            버튼
                            <?php
                                // echo $item["view_cnt"] ;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>아이콘</td>
                        <td>제품명</td>
                        <td>수량</td>
                        <td>기한</td>
                        <td>버튼</td>
                    </tr>
                    <tr>
                        <td>아이콘</td>
                        <td>제품명</td>
                        <td>수량</td>
                        <td>기한</td>
                        <td>버튼</td>
                    </tr>
                    <tr>
                        <td>아이콘</td>
                        <td>제품명</td>
                        <td>수량</td>
                        <td>기한</td>
                        <td>버튼</td>
                    </tr>
                    <tr>
                        <td>아이콘</td>
                        <td>제품명</td>
                        <td>수량</td>
                        <td>기한</td>
                        <td>버튼</td>
                    </tr>
                    <tr>
                        <td>아이콘</td>
                        <td>제품명</td>
                        <td>수량</td>
                        <td>기한</td>
                        <td>버튼</td>
                    </tr>

            <?php 
                // }
            ?>

        </table>
           
    </main>

    <?php
        require_once(FILE_FOOTER);
    ?> 
</body>
</html>

