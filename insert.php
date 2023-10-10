<?php

?>


<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>작성 페이지</title>
</head>
<body>
	<head><h1>장보자</h1></head>
	<main>
		<form action="#">
			<div>제품명</div>
			<input placeholder="수량" type="number" min="0" max="50">
			<textarea name="memo" id="memo" cols="25" rows="5" placeholder="메모"></textarea>
			<div>태그</div>
			<table>
				<td>
					<tr>
						<th>패션/뷰티</th>
						<th>식품/생활</th>
					</tr>
					<tr>
						<th>가구/홈/데코</th>
						<th>가전/디지털</th>
					</tr>
					<tr>
						<th>반려동물/취미</th>
						<th></th>
					</tr>
				</td>
			</table>
			<div></div>
			<div>기한</div>
			<input type="date" name="date">
			<div></div>
		</form>
		<br><br>
		<section>
			<button type="submit">작성</button>
			<a href="#">취소</a>
		</section>

	</main>
</body>
</html>