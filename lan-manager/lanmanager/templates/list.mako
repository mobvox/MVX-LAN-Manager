# _*_ coding: utf-8 _*_
<%inherit file="/base.mako" />
<%def name="head_tags()"></%def>

% for row in c.machines:
	${row.mac} 
% endfor