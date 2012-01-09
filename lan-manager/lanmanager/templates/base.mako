# -*- coding: utf-8 -*-
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" href="/favicon.ico">
		${h.javascript_link(url('/_static/js/jquery.min.js'))}
		${h.javascript_link(url('/_static/js/tipsy/jquery.tipsy.js'))}
		${h.javascript_link(url('/_static/js/jquery-ui-1.8.16.custom.min.js'))}
		${h.javascript_link(url('/_static/js/base.js'))}
		
		${h.stylesheet_link(url('/_static/css/tipsy/tipsy.css'))}
		${h.stylesheet_link(url('/_static/css/overcast/jquery-ui-1.8.16.custom.css'))}
		${h.stylesheet_link(url('/_static/css/base.css'))}
		
		${self.head_tags()}
	</head>
	<body>
		<div id='content'>
			${self.body()}
		</div>
	</body>
</html>