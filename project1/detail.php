<?php
define( "ROOT", $_SERVER["DOCUMENT_ROOT"] ."/project1");
define( "FILE_HEADER", ROOT ."/header.php" );
define( "FILE_FOOTER", ROOT ."/footer.php" );
require_once( ROOT ."/lib_db.php" );

$id = '';
$conn = null;
$id = $_GET["id"];
// var_dump($id);
PDO_set($conn);
$result = detail_select( $conn, $id );
// var_dump($result);
auto_update_finished($conn);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=tk, initial-scale=1.0">
	<link rel="stylesheet" href="../project_890.css">
	<title>상세페이지</title>
</head>
<body>
	<?php
		require_once(FILE_HEADER);
	?>
		<!-- <h1><img class=img_cart src="./cart.png" alt="">장보자</h1> -->
	
	<main class="container">
		<div>
			<img class=img_dt src="./ecnc0cbcf71-706c-43bd-8744-1bc239cb2b19.jpg" alt="">
			<div>
				<div class="div_ylw">
					제목명
				</div>
				<div class="div_wt">
					<?php echo $result["item_name"];?>
				</div>
			</div>
			<div class="div_memo">
				<?php echo $result["memo"];?>
			</div>
			<div>
				<div class="div_ylw">
					수량
				</div>
				<div class="div_wt">
					<?php echo $result["amount"]?>
			</div>
			</div>
			<div>
				<div class="div_ylw">
					태그
				</div>
				<div class="div_wt">
					<?php echo $result["tag_id"]?>
				</div>
			</div>
			<div>
				<div class="div_ylw">
					기한
				</div>
				<div class="div_wt">
				<?php echo $result["d_day"]?>
				</div>
			</div>
		</div>
		
		<section>
			<a class="detail" href="">삭제</a>
			<a class="detail" href="">취소</a>
		</section>
	</main>
	
	<?php
		require_once(FILE_FOOTER);
	?>
</body>
</html>