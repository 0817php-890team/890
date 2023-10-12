<?php

function PDO_set(&$conn){
	$db_host="192.168.0.91";
	$db_user="team5";
	$db_port="3306";
	$db_pw="team5";
	$db_name="jangboja";
	$db_charset="utf8mb4";
	$db_dns="mysql:host=".$db_host.";port=".$db_port.";dbname=".$db_name.";charset=".$db_charset;


    try {
        $db_option=[
            PDO::ATTR_EMULATE_PREPARES => false // Preppared Statement 를 데이터베이스가 지원 하지 않을 경우 에뮬레이션 하는 기능
            ,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION			
            ,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC		
        ];

        $conn = new PDO($db_dns,$db_user,$db_pw,$db_option);
        return true;
    }
    catch (Exception $e){
        $conn = null;
        return false;
    }
}

function PDO_del(&$conn){
	$conn=null;
}

// -----------------------------------------------------------
// 함수명 : finished_list_select
// 기능 : list 완료 항목 조회
// 파라미터 : PDO   &$conn
// 리턴 : array / false
// -----------------------------------------------------------
function finished_list_select(&$conn){

	try{
		$sql=
		" select "
		."	j.id "
		."	.j.item_name "
		."	.j.amount "
		."	.j.d_day "
		."	.j.finished_at "
		."	.t.tag_img "
		." from "
		."	 jang j "
		." 	join "
		."	  tag_type t "
		."   on "
		."     j.tag_id = t.tag_id "
		." where "
		."     j.finished = 1 "
		." order by "
		."     j.d_day desc "
		."     .j.id desc "
		;
		$arr_ps=[
		];

		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$result=$stmt->fetchAll();

		return $result;

	} catch(Exception $e){
		return false;
	}
}

// -----------------------------------------------------------
// 함수명 : list_select
// 기능 : list 미완료 항목 조회
// 파라미터 : PDO   &$conn
// 리턴 : array / false
// -----------------------------------------------------------
function list_select(&$conn){

	try{
		$sql=
		" select "
		."	j.id "
		."	,j.item_name "
		."	,j.amount "
		."	,j.d_day "
		."	,t.tag_img "
		." from "
		."	 jang j "
		." 	join "
		."	  tag_type t "
		."   on "
		."     j.tag_id = t.tag_id "
		." where "
		."     j.finished = 0 "
		." order by "
		."     j.d_day desc "
		."     ,j.id desc "
		;
		$arr_ps=[
		];

		$stmt=$conn->prepare($sql);
		$stmt->execute();
		$result=$stmt->fetchAll();

		return $result;

	} catch(Exception $e){
		return false;
	}
}

// -----------------------------------------------------------
// 함수명 : update_finished
// 기능 : finished 0에서 1로
// 파라미터 : PDO   &$conn
//			  id	item["id"]
// 리턴 : bool / false
// -----------------------------------------------------------
function update_finished(&$conn, $id){

	try{
		$sql=
		" update "
		."	jang "
		." set "
		."  	finished = '1' "
		." where "
		."  	id = :id "
		;
		$arr_ps=[
			":id" => $id
		];

		$stmt=$conn->prepare($sql);
		$result=$stmt->execute($arr_ps);

		return $result;

	} catch(Exception $e){
		return false;
	}
}
function detail_select(&$conn,&$arr_param){
	try{
		$sql= " SELECT "
		  ." id "
		  ." ,item_name "
		  ." ,amount "
		  ." ,d_day "
		  ." ,finished "
		  ." ,finished_at "
		  ." ,tag_id "
		  ." ,img "
		  ." ,memo "
		  ." FROM "
		  ." jang "
		  ." WHERE "
		  ." id= :id " 
		  ;


	 $arr_ps =[
				":id"=>$arr_param
			  ];
	
		$stmt=$conn->prepare($sql);
		$stmt->execute($arr_ps);
		$result=$stmt->fetchAll();
		return $result;
	}catch(Exception $e)
	{
		echo $e->getMessage();
		return false;
	}		  
}
	
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