# _*_ coding: utf-8 _*_
<%inherit file="/base.mako" />
<%def name="head_tags()"><title>Lista</title></%def>

<div id='leftbar'>
	<div id='logo'></div>
	<div id='menu'>
		<ul>
			<li><div id='arrow'></div> <a href='/list'>Lista</a> </li>
		</ul>
	</div>
</div>
<div id='centercontent'>
	<div id='contenttable'>
		<div id='table'>
			<div id='tableheader'>
				<div><span>Status</span></div>
				<div><span>Nome</span></div>
				<div><span>IP/MAC</span></div>
				<div class='last'><span>Funções</span></div>
			</div>
			<div id='tablebody'>
				% for row in c.machines:
						<div class='tr'>
							<div><span>Status</span></div>
							<div><span>${row.name}</span></div>
							<div class='multiline'>
								<div>
									<span>${row.ip}</span>
									<span class="mac">${row.mac}</span>
								</div>
							</div>
							<div class='last'>
								% if c.is_onoff_client_installed:
										% if c.is_machine_on:
											<a id="onoff" class="shutdown" href="/server/shutdown/${row.ip}" alt='Desligar'></a>
										% else:
											<a id="onoff" class="wakeup" href="/server/wake/${row.ip}" alt='Ligar'></a>
										% endif
									% else:
										<a id="onoff" class='disabled' href="#" alt='A porta est&aacute; bloqueada ou o cliente n&atilde;o est&aacute; instalado.'></a>
								% endif
																	
								% if '22' in row.open_ports[1:-1].split(', '):
									<a id="ssh" class='showdialog' href="${row.ip}:22" alt="SSH"></a>
								% else:
									<a alt='A porta est&aacute; bloqueada ou o cliente n&atilde;o est&aacute; instalado.' id="ssh" class='disabled' href="#"></a>
								% endif

								% if '139' in row.open_ports[1:-1].split(', '):
									% if c.os == 'mac':
										<a id="samba" href="smb://${row.ip}" alt="Samba"></a>
									% elif c.os == 'ms':
										<a id="samba" class='showdialog' href="\\${row.ip}" alt="Samba"></a>
									% else:
										<a id="samba" class='showdialog' href="${row.ip}" alt="Samba"></a>
									% endif
								% else:
									<a id="samba" alt='A porta est&aacute; bloqueada ou o cliente n&atilde;o est&aacute; instalado.' class='disabled' href="#"></a>
								% endif
							</div>
						</div>
				% endfor
			</div>
		
		</div>
	</div>
</div>