<?php
	require_once('config/config.php');

	if ($db=@mysql_connect($db_host, $db_user, $db_password)) {
		mysql_select_db('news_parser', $db);
	} else {
		die('Conected failed </br>' .mysql_error());
	}

	function addNews($title, $link, $date, $content) {
		$q = "INSERT INTO news (news_id, title ,link ,date_pub , content) VALUES (NULL, '".$title ."', '" .$link ."', '" .$date ."', '" .$content ."');";
		$res = mysql_query($q);
		return $res;
	}

	function getNews() {
		$q = "SELECT * FROM news";
		$res = mysql_query($q);
		while ($result_row = mysql_fetch_row(($res))) {
			echo $result_row[0] . "||" .$result_row[1] . "||" .$result_row[2] . "||" .$result_row[3] . "||" .$result_row[4] . "##";
		}
	}

	function deleteNews($news_id) {
		$q = 'DELETE FROM news WHERE news_id = "' .$news_id .'"';
		$res = mysql_query($q);
		return $res;
	}
	// Если не установлен параметр action значит запрашивается каталог архивированных новостей
	if (!isset($_GET['action']) && !isset($_POST['action'])) {
		getNews();
	} else if (isset($_GET['action'])) {
		deleteNews($_GET['news_id']);
		getNews();
	} else if(isset($_POST['action'])) {
		addNews($_POST['title'], $_POST['link'], $_POST['date'], $_POST['content']);
		getNews();	
	}	
	
	mysql_close($db);
?>

