<?php
{
	function OpenCon()
	{
		/**
		 * Preferencia de credenciales:
		 *   1. Variables de entorno de Railway (MYSQLHOST, MYSQLUSER, MYSQLPASSWORD, MYSQLDATABASE, MYSQLPORT)
		 *   2. MYSQL_URL (mysql://user:pass@host:port/db) tambien provisto por Railway
		 *   3. Fallback a localhost (entorno local / cPanel legacy)
		 */
		$host = getenv('MYSQLHOST');
		$user = getenv('MYSQLUSER');
		$pass = getenv('MYSQLPASSWORD');
		$db   = getenv('MYSQLDATABASE');
		$port = getenv('MYSQLPORT') ?: '3306';

		if (!$host || !$user || !$db) {
			$url = getenv('MYSQL_URL');
			if ($url) {
				$parts = parse_url($url);
				$host = $parts['host'] ?? $host;
				$user = $parts['user'] ?? $user;
				$pass = $parts['pass'] ?? $pass;
				$port = isset($parts['port']) ? (string)$parts['port'] : $port;
				$db   = isset($parts['path']) ? ltrim($parts['path'], '/') : $db;
			}
		}

		if (!$host || !$user || !$db) {
			$host = 'localhost';
			$user = 'aprendee_neuro_couch_admin';
			$pass = 'juHy?Lc5(2ju';
			$db   = 'aprendee_neuro_couch';
			$port = '3306';
		}

		$dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";
		$cnx = new PDO($dsn, $user, $pass, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_TIMEOUT => 5,
		]);
		return $cnx;
	}
 }
?>
