# _*_ coding: utf-8 _*_
<%inherit file="/base.mako" />
<%def name="head_tags()"><title>List</title></%def>

% for row in c.machines:
	${row.mac} ${row.ip} ${row.name} ${row.last_update}
	% for port in row.open_ports[1:-1].split(', '):
		% if port == '22':
			<a href="ssh://${row.ip}:${port}">ssh</a>
		% endif
		% if port == '139':
			<a href="smb://${row.ip}">samba</a>
		% endif
	% endfor
	<br />
% endfor