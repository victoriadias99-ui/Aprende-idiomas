<?php
{
	function OpenCon()
	{
		
		/*$cnx = new PDO('mysql:host=localhost;dbname=aprendee_idiomas;charset=utf8mb4', 'aprendee_idiomas_admin', 'aprendee_idiomas_admin');*/
		
		$cnx = new PDO('mysql:host=localhost;dbname=aprendee_neuro_couch;charset=utf8mb4', 'aprendee_neuro_couch_admin', 'juHy?Lc5(2ju');
		return $cnx;
	}
 }
?>