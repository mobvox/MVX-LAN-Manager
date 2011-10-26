<?php

	/*
	 *	class name: Connection
	 *	class creator: Jonas Trevisan
	 *	class date: 10/13/20111
	 *	class description: Handle the MySQL connection.
	*/
	
	class Connection {

		// config constants
		private $conn = null;

		// open and return the connection
		public function getConnection(){
			require("config.php");
			$conn = mysql_connect($HOST, $USERNAME, $PASSWD);
			if (!$conn) {

				// TODO: ERROR PAGE
    			die('Something went wrong when openning MySQL connection.');
	    	}else{
	    		mysql_select_db($DB); 
	    		return $conn;
	    	}
		}
		public function getMultiQueryConnection(){
			require("config.php");
			$db = new mysqli($HOST, $USERNAME, $PASSWD, $DB);
			if($db){
				return $db;
			}else{
				die('Something went wrong when openning MySQL connection.');
			}
			
		}

		// executes the sql query
		public function query($sql){
			$this->conn = $this->getConnection();
			if($this->conn){
				$query = mysql_query($sql, $this->conn) OR die("Something went wrong when executing the query");
                return $query;
			}else{
				die('Something went wrong when openning MySQL connection.');
			}
		}
	}

	/*
	 *	class name: DBManager
	 *	class creator: Jonas Trevisan
	 *	class date: 10/14/20111
	 *	class description: Handle the database, (update, select, insert and etc)
	*/
	class DBManager {


		// TODO: REESTRUTURAR BANCO DE DADOS
		
		private $conn = null;

		// inser a new computer register
		public function insert($macaddress, $user, $comments, $ipaddress, $active){
			if($this->conn == null){
				$this->conn = new Connection();
			}
			$this->conn->query(sprintf("INSERT INTO computers VALUES('%s', '%s', '%s', '%s', '%s');",
								mysql_real_escape_string($macaddress), mysql_real_escape_string($ipaddress), mysql_real_escape_string($user),
								mysql_real_escape_string($comments), mysql_real_escape_string($active)));

		}

		// edit a computer
		public function edit($macaddress, $newmacaddress, $newuser, $newcomments, $newipaddress, $active){
			if($this->conn == null){
				$this->conn = new Connection();
			}
			$this->conn->query(sprintf("UPDATE computers SET mac='%s', ip='%s', user='%s', comments='%s', active='%s'' WHERE mac='%s';",
							mysql_real_escape_string($newmacaddress), mysql_real_escape_string($newipaddress), mysql_real_escape_string($newuser),
							mysql_real_escape_string($newcomments), mysql_real_escape_string($active), mysql_real_escape_string($macaddress)));
		}

		// edit a computer ip address
		public function editIPAddress($macaddress, $newipaddress){
			if($this->conn == null){
				$this->conn = new Connection();
			}
			
			$this->conn->query(sprintf("UPDATE computers SET ip='%s' WHERE mac='%s'",
								mysql_real_escape_string($newipaddress), mysql_real_escape_string($macaddress)));
		}

		// disable a computer register
		public function disable($macaddress){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			$this->conn->query(sprintf("UPDATE computers SET active=0 WHERE macaddress='%s'",
								mysql_real_escape_string($macaddress)));
		}

		// enable a computer register
		public function enable($macaddress){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			$this->conn->query(sprintf("UPDATE computers SET active=1 WHERE macaddress='%s'",
								mysql_real_escape_string($macaddress)));
		}

		// get a list of the enabled's computers
		public function getEnabledComputersList(){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			return $this->conn->query("SELECT * FROM computers WHERE active=1;");
		}

		// get a list of the disabled's computers
		public function getDisabledComputersList(){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			return $this->conn->query("SELECT * FROM computers WHERE active=0;");
		}

		// get computer by IP
		public function getComputerByIP($ipAddress){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			return $this->conn->query(sprintf("SELECT * FROM computers WHERE ip='%s' AND active=1;",
										mysql_real_escape_string($ipAddress)));

		}

		// get computer by MAC
		public function getComputerByMAC($macAddress){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			return $this->conn->query(sprintf("SELECT * FROM computers WHERE mac='%s' AND active=1;",
										mysql_real_escape_string($macAddress)));
		}

		// update cache
		public function updateCache($cacheArray){
			if($this->conn == null){
				$this->conn = new Connection();
				$this->conn->getConnection();
			}

			$sql = "DELETE FROM arpcache WHERE mac NOT IN(";
			$i=0;
			foreach($cacheArray as $mac){
				
				if($i != (count($cacheArray)-1)){
					$sql .= sprintf("'%s',", mysql_real_escape_string($mac));
				}else{
					$sql .= sprintf("'%s');\n", mysql_real_escape_string($mac));
				}
				$i++;
			}
    		while($mac = current($cacheArray)){
    			$ip = key($cacheArray);

    			$sql .= sprintf("CALL UPDATEELSEINSERT('%s', '%s');\n", mysql_real_escape_string($ip),mysql_real_escape_string($mac));
    			next($cacheArray);
    		}
    		$this->conn->getMultiQueryConnection()->multi_query($sql);
		}
		// get the cache array
		public function getCache(){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			$queryResult = $this->conn->query("SELECT * FROM arpcache;");

			return $queryResult;
		}
		public function getCacheUpdateTime(){
			if($this->conn == null){
				$this->conn = new Connection();
			}
			$result = mysql_fetch_assoc($this->conn->query("SELECT timestamp FROM arpcache LIMIT 1"));

			return $result["timestamp"];
		}
		public function checkForCacheUpdates(){
			//						h   mm   ss
			$oneHourAgo = time() - (1 * 60 * 60);
			$cacheTime = strtotime($this->getCacheUpdateTime());
			if($oneHourAgo > $cacheTime){
				$server = new ServerManager();
				$server->storeARPCache();
				return true;
			}else{
				return false;
			}
		}
	}

	/*
	 *	class name: Server Manager
	 *	class creator: Jonas Trevisan
	 *	class date: 10/14/20111
	 *	class description: (get Mac addresses, ip's list, mac's list, send wake up packets, send turn off commands and etc.)
	*/
	class ServerManager {
		

		public function storeARPCache(){
			// ip reg. exp.
			$ipRegEx = "/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/";
			// mac reg. exp.
			$macRegEx = "/(([0-9a-f]{2}([:-]|)){6})/";
			// TODO : config file to store the ip address range
			$nMapCommand = "nmap -sP 192.168.1.2-254";
			$arpCommand = "sudo arp -a ";

			// this can take a while, about 5 sec.
			$unparsedIPList = shell_exec($nMapCommand);

			preg_match_all($ipRegEx, $unparsedIPList, $ipMatchesArray);

			$cacheArray = array();

			foreach($ipMatchesArray[0] as $ip){
				$unparsedMACString = shell_exec($arpCommand. $ip);

				preg_match($macRegEx, $unparsedMACString, $matchedMAC);
				
				if(isset($matchedMAC[0])){
					$cacheArray[$ip] = $matchedMAC[0];
				}
			}

			$db = new DBManager();
			$db->updateCache($cacheArray);
		}

		// send a WOL packet to the target
		public function sendWakeUPPacket($targetMACAddress){

			$WOLCommand = "wakeonlan {$targetMACAddress}";
			$response = shell_exec($WOLCommand);

			return $response;
		}

		// send a switch off command to the target
		public function sendSwitchOffRequest($targetIPAddress, $targetPort, $sendAdvice){

			$clientSocketCommand = "clientsocket {$targetIPAddress} {$targetPort} {$sendAdvice}";

			if($sendAdvice == 0){
				$sendAdvice = "1";
			}else{
				$sendAdvice = "2";
			}

			$response = shell_exec($clientSocketCommand);

			return $response;
		}

		public function isOnline($ipaddress){
			$serverAnswer = shell_exec("nmap -sP {$ipaddress}");
			if(strpos($serverAnswer, "Host is up")){
				return true;
			}else{
				return false;
			}
		}
	}
?>
