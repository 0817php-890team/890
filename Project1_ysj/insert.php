<?php
define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/890/Project1_ysj"); // 웹서버
define("FILE_HEADER", ROOT."/header.php"); // 헤더 패스
define("FILE_FOOTER", ROOT."/footer.php"); // 푸터 패스
require_once(ROOT."/lib_db.php"); // DB관련 라이브러리

// var_dump();

$title="";
$content="";

$http_method = $_SERVER["REQUEST_METHOD"];
if($http_method === "POST") {
	try {
		$arr_post = $_POST;
		$conn = null; // DB Connection 변수

		//파라미터 획득
		$item_name = isset($_POST["item_name"]) ? trim($_POST["item_name"]) : ""; // item_name 셋팅
		$tag_id = isset($_POST["tag_id"]) ? trim($_POST["tag_id"]) : ""; // tag_id 셋팅
		$finished_at = isset($_POST["finished_at"]) ? trim($_POST["finished_at"]) : ""; // finished_at 셋팅
		$img = isset($_POST["img"]) ? trim($_POST["img"]) : ""; // img 셋팅

		if($title === "") {
			$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "제목");
		}
		if($title === "") {
			$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "내용");
		}

		if(count($arr_err_msg) === 0) {
			// DB 접속
			if(!my_db_conn($conn)) {
				// DB Instance 에러
				throw new Exception("DB Error : PDO Instance");
			}
			$conn->beginTransaction(); // 트랜잭션 시작

			// 글 작성을 위해 파라미터 셋팅
			$arr_param = [
				"item_name" => $_POST["item_name"]
				,"tag_id" => $_POST["tag_id"]
				,"finished_at" => $_POST["finished_at"]
				,"img" => $_POST["img"]
			];

			// insert
			if(db_insert_boards($conn, $arr_post)) {
				// DB Insert 에러
				throw new Exception("DB Error : Insert Boards");
			}
			
			$conn->commit(); //모든 처리 완료 시 커밋

			// 리스트 페이지로 이동
			header("Location: list.php");
			exit;
		}
	} catch(Exception $e) {
		// echo $e->getMessage(); // Exception 메세지 출력
		header("Location: error.php/?err_msg={$e->getMessage()}");
		exit;
	} finally {
		db_destroy_conn($conn); // DB 파기
	}
}



?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./insert.css">
	<title>작성 페이지</title>
</head>
<body>
	<?php
		require_once(FILE_HEADER);
	?>
	<main>
		<form action="#">
			<div class="insert_div">
				<div class="insert_tit">제품명</div>
				<input class="insert_in2" type="text" maxlength="50" required>
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
				<select class="insert_in2" name="tag" id="tag">
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
				<input class="insert_in2" type="date" name="date" required>
				<div class="insert_te"></div>
			</div>
			<div class="insert_div">
				<label for="file">
					<div class="insert_tit">파일첨부</div>
				</label>
				<div class="insert_te"><input class="input_f" type="file" name="file" id="file"></div>
			</div>
		</form>
		<section>
			<button class="insert_se" type="submit">작성</button>
			<a class="insert_se" href="#">취소</a>
		</section>
	</main>
	<?php require_once(FILE_FOOTER); ?>
</body>
</html>