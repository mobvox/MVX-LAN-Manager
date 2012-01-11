#!/usr/bin/python
# _*_ coding: utf-8 _*_
import commands as cmd
import nmap
class Server:
	def __init__(self):
		# initializing the nmap port scanner
		self._nmps = nmap.PortScanner()

	def getOnlineIPList(self, addr = '192.168.1.0/24'):
		""" returns a list with all online ips """
		for ip_term in range(100, 150):
			print cmd.getstatus('ping -c 1 192.168.1.%s | gawk --re-interval /1\ received/' % ip_term)
			
		self._nmps.scan(hosts=addr, arguments='-sPn')
		host_list = list()
		for host in self._nmps.all_hosts():
			if self._nmps[host]['status']['state'] == 'up':
				host_list.append(host)
		return host_list

	def getNameByIP(self, addr):
		""" returns the netbios name of addr """
		nbtscancmd = " nbtscan %s | gawk --re-interval '/^(([[:digit:]]{1,3}\.){3}[[:digit:]]{1,3})/{print $2 }'" % addr
		return cmd.getoutput(nbtscancmd)

	def getMACAddrByIP(self, ip):
		""" returns the MAC addr of the ip """
		arpcmd = "arp -a %s | gawk --re-interval '/([0-9a-fA-F]{2}\:){5}([0-9a-fA-F]{2})/{print $4}'" % ip
		return cmd.getoutput(arpcmd)
	
	def getOpenPorts(self, ip):
		""" returns a list of the tcp ports opened on the ip """
		self._nmps.scan(ip, arguments='-sT --host-timeout 5m')
		if self._nmps[ip].has_key('tcp'):
			return self._nmps[ip]['tcp'].keys()
		else:
			return 'None'

import pymysql
class Connection:
	def __init__(self):
		import os
		self._config_file = os.path.dirname(os.path.abspath(__file__)) + "/db.ini"
		self._connect()
	
	def _connect(self):
		""" it connect to the database configured in the config_file """
		config = self.getConfig()
		self._connection = pymysql.connect(host=config.get('database', 'host'), port=int(config.get('database', 'port')), user=config.get('database', 'user'), passwd=config.get('database', 'passwd'), db=config.get('database', 'db'))

	def getConfig(self):
		""" it access the config_file and retrieve the database config """
		import ConfigParser
		config = ConfigParser.ConfigParser()
		config.read(self._config_file)
		return config

	def getConnection(self):
		""" returns the connection """
		if self._connection != None:
			return self._connection
		else:
			self._connect()
			return self._connection

class DatabaseUpdater:
	def __init__(self):
		self._conn = Connection().getConnection()

	def update(self, mac, ip, name, ports):
		""" insert or update the information of the selected mac
			if it does not exist insert else only update the info """
		cur = self._conn.cursor()
		sql = []
		sql.append("insert into machines (mac, ip, name, open_ports)")
		sql.append(" values('%s', '%s', '%s', '%s')" % (mac, ip, name, ports))
		sql.append(" on duplicate key update ip='%s', name='%s', open_ports='%s';" % (ip, name, ports))
		cur.execute(''.join(sql))
		cur.close()
	def deleteIfNotIn(self, criteria):
		""" delete from the database the old macs that are not in the new mac list """
		cur = self._conn.cursor()
		sql = "delete from machines where mac not in(%s)" % criteria
#		print sql
		cur.execute(sql)
		cur.close()
	def close(self):
		""" just close the database connection """
		self._conn.close()

if __name__ == '__main__':
	a = DatabaseUpdater()
	s = Server()
	print "Getting the ip list..."
	ipList = s.getOnlineIPList()
	macList = []
	for ip in ipList:
		print "Running over %s" % ip
		mac = s.getMACAddrByIP(ip)
		mac = ('00:00:00:00:00:00', mac)[len(mac) > 0]
		name = s.getNameByIP(ip)
		name = ('-', name)[len(name) > 0]
		macList.append("'%s'," % mac)
		a.update(mac, ip, name, s.getOpenPorts(str(ip)))
	macCriteria = ''.join(macList)
	print "Cleanning..."
	a.deleteIfNotIn(macCriteria[:len(macCriteria)-1])
	a.close()
	print "Done! :)"