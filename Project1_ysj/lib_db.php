<?php

//----------------------------------------
//함수명          : my_db_conn
// 기능           : DB Connect
// 파라미터       : PDO   &$conn
// 리턴           : boolen
//----------------------------------------

function my_db_conn( &$conn ) {
	$db_host    = "localhost"; // host
	$db_user    = "team5"; // user
	$db_pw      = "team5"; // password
	$db_db_name = "jangboja"; // DB name
	$db_charset = "utf8mb4"; // charset
	$db_dns     = "mysql:host=".$db_host.";dbname=".$db_db_name.";charset=".$db_charset;

	try{
		$db_options = [
			PDO::ATTR_EMULATE_PREPARES      => false
			,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION
			,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC
		];

	// PDO Class로 DB 연동
		$conn = new PDO($db_dns, $db_user, $db_pw, $db_options);
		return true;
	} catch (Exception $e) {
		$conn = null;  //DB 파기
		return false;
	}
}

//----------------------------------------
//함수명          : db_destroy_conn
// 기능           : DB Destroy
// 파라미터       : PDO   &$conn
// 리턴           : 없음
//----------------------------------------

function db_destroy_conn(&$conn) {
	$conn = null;
}

//----------------------------------------
//함수명          : db_insert_boards
// 기능           : boards 레코드 작성
// 파라미터       : PDO   &$conn
//				   Array  &$arr_param 쿼리 작성용 배열
// 리턴           : Boolean
//----------------------------------------

function db_insert_boards(&$conn, &$arr_param) {
	$sql = 
		" INSERT INTO jang ( "
		."		item_name "
		."		,amount "
		."		,memo "
		."		,tag_id "
		."		,finished_at "
		."		,img "
		." 
		) "
		." VALUES ( "
		." 		:item_name "
		."		,amount "
		."		,memo "
		."		,:tag_id "
		."		,:finished_at "
		."		,:img "
		." ) "
		;

	$arr_ps = [
		":item_name" => $arr_param["item_name"]
		,":tag_id" => $arr_param["tag_id"]
		,":finished_at" => $arr_param["finished_at"]
		,":img" => $arr_param["img"]
	];

	try {
		$stmt = $conn->prepare($sql);
		$result = $stmt->execute($arr_ps);
		return $result; // 정상 : 쿼리 결과 리턴
	} catch(Exception $e) {
		return false; // 예외발생 : flase 리턴
	}
}

?>