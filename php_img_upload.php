<?php
var_dump($_FILES);




// 셋팅


// mkdir(img,777); << img파일 안만들어놓으면 한번만 실행
$target_dir = "img/"; // 아무것도 안적으면 htdocs에 바로 저장됨
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]); 
// 번외(필요x) : 우리 코드랑 서버가 UTF-8, 연결하는 쪽이 EUC-KR인 경우 변환하는 코드 : urlencode(iconv("UTF-8", "EUC-KR", basename($_FILES["fileToUpload"]["name"])))(나중에 if문으로 걸러서 사용가능)
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
echo "target_file : ".$target_file."<br><br>";







// 이 밑으로 오류검출



// 이미지 파일인지 아닌지 체크
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  print_r($check);
  echo "<br>↑check<br><br>";
  if($check !== false) {
    echo "Type : " . $check["mime"] . "."."<br><br>";
    $uploadOk = 1;
  } else {
    echo "Type : Not image"."<br><br>";
    $uploadOk = 0;
  }
}

// 이미 있는 파일인지
if (file_exists($target_file)) {
  echo "-중복"."<br><br>";
  $uploadOk = 0;
}

// 파일 너무 큰지 체크
// if ($_FILES["fileToUpload"]["size"] > 500000) { // 500kb이상이면 안됨
//   echo "파일이 너무 커요";
//   $uploadOk = 0;
// }

// 특정 파일 형식을 허용합니다
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Only : JPG, JPEG, PNG & GIF"."<br><br>";
  $uploadOk = 0;
}

// uploadOk이 1이면 출력, 아니면 에러
if ($uploadOk == 0) {
  echo "업로드 실행 - X"."<br><br>";







// ******** 출력과정 *******
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { // $_FILES에 올린 데이터를 $target_file로 이동
    echo "파일 - ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " 이 업로드 - O"."<br><br>"; // htmlspecialchars(문자열)가 (문자열)이 html로 표시될 때 나오는 태그 표시해주는건데 왜있는거지    
  } else {
    echo "파일이동 실행 - X"."<br><br>";
  }
}
// echo "한글 -> url코드변환 : ".urlencode($_FILES["fileToUpload"]["name"])."<br>";






?>
<!DOCTYPE html>
<html>
<body>

<form action="test.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
  <!-- 현재 $_FILES에 담긴 그림을 출력 -->
  <img src="<?php echo "img/".$_FILES["fileToUpload"]["name"]; ?>" width="500" height="500">
</body>
</html>

