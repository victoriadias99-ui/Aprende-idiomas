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

		// NO fallback con credenciales hardcodeadas.
		// Si faltan variables de entorno, fallamos con error claro.
		if (!$host || !$user || !$db) {
			http_response_code(503);
			error_log('[conexion] Missing DB env vars (MYSQLHOST/USER/DB or MYSQL_URL)');
			throw new RuntimeException('Database configuration missing. Set MYSQLHOST/MYSQLUSER/MYSQLPASSWORD/MYSQLDATABASE or MYSQL_URL env vars.');
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
