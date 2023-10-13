<?php
define( "ROOT", $_SERVER["DOCUMENT_ROOT"] ."/project1");
define( "FILE_HEADER", ROOT ."/header.php" );
define( "FILE_FOOTER", ROOT ."/footer.php" );
require_once( ROOT ."/lib_db.php" );

$id = $_GET["id"];
$conn = null;

// var_dump($id);
PDO_set($conn);
$result[0] = detail_select( $conn, $id );
$item = $result[0][0];



?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=tk, initial-scale=1.0">
	<link rel="stylesheet" href="/project1/project_890.css">
	<title>상세페이지</title>
</head>
<body>
	<?php
		require_once(FILE_HEADER);
	?>
		
	
	<main class="container">
	
		<div class="detail_ma"><img src="../img/aircon.png" alt="">
		<?php
			//if($item["img"]=== null){
				//echo null ;
			//}else{

			?>
			
			<div >
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
					<?php echo $item["amount"];?>
			</div>
			</div>
			<div>
				<div class="div_ylw">
					태그
				</div>
				<div class="div_wt">
					<?php echo $item["tag_name"];?>
				</div>
			</div>
			<div>
				<div class="div_ylw">
					기한
				</div>
				<div class="div_wt">
				<?php echo $item["d_day"];?>
				</div>
			</div>
		</div>
		
	
	
		
		<section class="insert_set">
			<a class="insert_se" href="">삭제</a>
			<a class="insert_se" href="/project1/list.php">취소</a>
		</section>
	</main>
	
	<?php
		require_once(FILE_FOOTER);
	?>
</body>
</html>