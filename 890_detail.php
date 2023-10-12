<?php
define("ROOT",$_SERVER["DOCUMENT_ROOT"]."/project1/");
define("FILE_HEADER", ROOT."header.php");
define("FILE_FOOTER", ROOT."footer.php");
require_once(ROOT."lib_db_kkh.php");

$id='';
$conn=null;

try{
	
	
	if(!isset($_GET["id"]) || $_GET["id"]===""){
		throw new Exception("parameter ERROR : No id");
	}
		$id= $_GET["id"];
		$page = $_GET["page"];
		if(!my_db_conn($conn)){
			throw new Exception("DB ERROR : PDO Instance");

		}
	

	$arr_param=[
		"id"=>$id
	];
	$result = list_select($conn,$arr_param);

	
	if($result===false){
		
		throw new Exception("DB ERROR : PDO select_id");
	
	} else if(!(count($result)=== 1)){
		throw new Exception("DB ERROR : PDO select_id count,".count($result));
	}
	$item = $result[0];

}catch(Exception $e) {
	
	
	exit;
} finally {
	db_destroy_conn($conn);
}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=tk, initial-scale=1.0">
	<link rel="stylesheet" href="./890_detail.css">
	<title>상세페이지</title>
</head>
<body>
	<?php
		require_once(FILE_HEADER);
	?>
		<h1><img class=img_cart src="./cart.png" alt="">장보자</h1>
	
	<main class="container">
		<div>
			<img class=img_dt src="./ecnc0cbcf71-706c-43bd-8744-1bc239cb2b19.jpg" alt="">
			<div>
				<div class="div_ylw">
					제목명
				</div>
				<div class="div_wt">
					<?php echo $item["item_name"];?>
				</div>
			</div>
			<div class="div_memo">
				<?php echo $item["memo"];?>
			</div>
			<div>
				<div class="div_ylw">
					수량
				</div>
				<div class="div_wt">
					<?php echo $item["amount"]?>
			</div>
			</div>
			<div>
				<div class="div_ylw">
					태그
				</div>
				<div class="div_wt">
					<?php echo $item["tag_id"]?>
				</div>
			</div>
			<div>
				<div class="div_ylw">
					기한
				</div>
				<div class="div_wt">
				<?php echo $item["d_day"]?>
				</div>
			</div>
		</div>
		

	</main>
	<section>
		<a href="">삭제</a>
		<a href="">취소</a>
	</section>
	<?php
		require_once(FILE_FOOTER);
	?>
</body>
</html>