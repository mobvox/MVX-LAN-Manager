<?php

	/*
	 *	class name: Connection
	 *	class creator: Jonas Trevisan
	 *	class date: 10/13/20111
	 *	class description: Handle the MySQL connection.
	*/
	class Connection {

		// config constants
		private $HOST = "localhost";
		private $USERNAME = "root";
		private $PASSWD = "root";
		private $DB = "computersmanager";

		private $conn = null;

		// open and return the connection
		private function getConnection(){
			$conn = mysql_connect($this->HOST, $this->USERNAME, $this->PASSWD);
			if (!$conn) {

				// TODO: ERROR PAGE
    			die('Something went wrong when openning MySQL connection.');
	    	}else{
	    		mysql_select_db($this->DB); 
	    		return $conn;
	    	}
		}

		// executes the sql query
		public function query($sql){
			$this->conn = $this->getConnection();
			if($this->conn){
				$query = mysql_query($sql, $this->conn) OR die("Something went wrong when executing the query");
				if(gettype($query) == "resource"){
					$arr = mysql_fetch_array($query);
					return $arr;
				}

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
			$this->conn->query("INSERT INTO computers VALUES('{$macaddress}', '{$ipaddress}', '{$user}', '{$comments}', '{$active}');");
		}

		// edit a computer
		public function edit($macaddress, $newmacaddress, $newuser, $newcomments, $newipaddress, $active){
			if($this->conn == null){
				$this->conn = new Connection();
			}
			$this->conn->query("UPDATE computers SET mac='{$newmacaddress}', ip='{$newipaddress}', user='{$newuser}', comments='{$newcomments}', active='{$active}'' WHERE mac='{$macaddress}';");
		}

		// edit a computer ip address
		public function editIPAddress($macaddress, $newipaddress){
			if($this->conn == null){
				$this->conn = new Connection();
			}
			
			$this->conn->query("UPDATE computers SET ip='{$newipaddress}' WHERE mac='{$macaddress}'");
		}

		// disable a computer register
		public function disable($macaddress){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			$this->conn->query("UPDATE computers SET active=0 WHERE macaddress='{$macaddress}'");
		}

		// enable a computer register
		public function enable($macaddress){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			$this->conn->query("UPDATE computers  SET active=1 WHERE macaddress='{$macaddress}'");
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

			return $this->conn->query("SELECT * FROM computers WHERE ip='{$ipAddress}' AND active=1;");
		}

		// get computer by MAC
		public function getComputerByMAC($macAddress){
			if($this->conn == null){
				$this->conn = new Connection();
			}

			return $this->conn->query("SELECT * FROM computers WHERE mac='{$macAddress}' AND active=1;");
		}
	}

	/*
	 *	class name: Server Manager
	 *	class creator: Jonas Trevisan
	 *	class date: 10/14/20111
	 *	class description: Handle the server, (to get Mac addresses, ip's list, mac's list, send wake up packets, send switch off commands and etc.)
	*/
	class ServerManager {
		
		public function getIPAddrss($mac){
			// TODO: ARP Cache
		}

		// get the mac address of an ip address
		public function getMACAddress($ipAddress){

			$ipRegEx = "/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/";
			$macRegEx = "/(([0-9a-f]{2}([:-]|)){6})/";

			$arpingCommand = "sudo arping {$ipAddress} -c 1 -r";
			$NMapCommand = "nmap -sPn 192.168.1.2-254";

			$ips = shell_exec($NMapCommand);
			preg_match_all($ipRegEx, $ips, $matches);
	
			foreach($matches[0] as $ip) {
				if($ipAddress == $ip){
					$mac = shell_exec($arpingCommand);
					preg_match($macRegEx, $mac, $matches);

					if(isset($matches[0])){
						return $matches[0];
					}

					return null;
				}
			}
			return null;
		}

		// get ip addresses's list
		public function getIPAddressList(){

			$shellCommand = "nmap -sPn 192.168.1.2-254";
			$ipRegEx = "/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/";

			$ips = shell_exec($shellCommand);
			preg_match_all($ipRegEx, $ips, $matches);

			if(isset($matches[0][0])){
				return $matches[0];
			}
			return null;
		}

		/*	
		 *	get mac addresses's list returns a list containing the mac addresses referenced by the ip addresses
		 *	this function may take a WHILE because of the number of querys
		 */
		public function getMACAddressList($ipAddressList){

			$macRegEx = "/(([0-9a-f]{2}([:-]|)){6})/";

			$macAddressList = Array();

			foreach($ipAddressList as $ip){

				$arpingCommand = "sudo arping {$ip} -c 1 -r";

				$mac = shell_exec($arpingCommand);
				preg_match($macRegEx, $mac, $matches);

				if(isset($matches[0])){
					$macAddressList[$ip] = $matches[0];
				}
			}
			return $macAddressList;
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
	}
?>
