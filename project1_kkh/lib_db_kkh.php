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

        $conn=new PDO($db_dns,$db_user,$db_pw,$db_option);
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
?>