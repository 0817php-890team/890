<?php
define( "ROOT", $_SERVER["DOCUMENT_ROOT"]."/project1");
define( "FILE_HEADER", ROOT ."/header.php" );
define( "FILE_FOOTER", ROOT ."/footer.php" );
define( "ERROR_MSG_PARAM", "오류입니다~" );
require_once( ROOT ."/lib_db.php" );


// var_dump();


$http_method = $_SERVER["REQUEST_METHOD"];
if($http_method === "POST") {
		
		$conn = null; // DB Connection 변수

		//파라미터 획득
		$item_name = $_POST["item_name"];
		//$item_name = isset($_POST["item_name"]) ? trim($_POST["item_name"]) : ""; // item_name 셋팅
		$tag_id = isset($_POST["tag_id"]) ? trim($_POST["tag_id"]) : ""; // tag_id 셋팅
		$d_day = isset($_POST["d_day"]) ? trim($_POST["d_day"]) : ""; // finished_at 셋팅
		$img = isset($_POST["img"]) ? trim($_POST["img"]) : ""; // img 셋팅
		$memo = isset($_POST["memo"]) ? trim($_POST["memo"]) : ""; // img 셋팅
		$amount = isset($_POST["amount"]) ? trim($_POST["amount"]) : ""; // img 셋팅
		// var_dump($item_name);
			PDO_set($conn);
			$conn->beginTransaction(); // 트랜잭션 시작

			// 글 작성을 위해 파라미터 셋팅
			$arr_param = [
				"item_name" => $item_name
				,"memo" => $memo
				,"tag_id" => $tag_id
				,"d_day" => $d_day
				,"img" => $img
				,"amount" => $amount
			];

			// insert
			db_insert_boards($conn, $arr_param);

			$conn->commit(); //모든 처리 완료 시 커밋

			// 리스트 페이지로 이동
			header("Location: list.php");
			exit;


		}


?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/project1/project_890.css">
	<title>작성 페이지</title>
</head>
<body>
	<?php
		require_once(FILE_HEADER);
	?>
	<main>
		<form action="/project1/insert.php" method="post">
			<div class="insert_ma">
					<div class="insert_div">
					<div class="insert_tit">제품명</div>
					<input class="insert_in2" type="text" name="item_name" maxlength="50" required>
					<div class="insert_te"></div>
				</div>
				<textarea class="insert_me" name="memo" id="memo" cols="25" rows="30" placeholder="메모"></textarea>
				<div class="insert_div">
					<div class="insert_tit">수량</div>
					<input class="insert_in2" type="number" min="0" max="50" required>
					<div class="insert_te"></div>
				</div>
				<div class="insert_div">
					<div class="insert_tit">태그</div>
					<select class="insert_in2" name="tag_id" id="tag">
						<option value="" selected disabled hidden>선택해주세요</option>
						<option value="clothes">패션/뷰티</option>
						<option value="food">식품/생활</option>
						<option value="closet">가구/홈/데코</option>
						<option value="degital">가전/디지털</option>
						<option value="pet">반려동물/취미</option>
					</select>
					<div class="insert_te"></div>
				</div>
				<div class="insert_div">
					<div class="insert_tit">기한</div>
					<input class="insert_in2" type="date" name="d_day" required>
					<div class="insert_te"></div>
				</div>
				<div class="insert_div">
					<label for="file">
						<div class="insert_tit">파일첨부</div>
					</label>
					<div class="insert_te"><input class="input_f" type="file" name="file" id="file"></div>
				</div>
			</div>
			<section class="insert_set">
				<button class="insert_se" type="submit">작성</button>
				<a class="insert_se" href="/project1/list.php">취소</a>
			</section>
		</form>
	</main>
	<?php require_once(FILE_FOOTER); ?>
</body>
</html>