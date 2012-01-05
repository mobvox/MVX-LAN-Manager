# -*- encoding:utf-8 -*-
from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 6
_modified_time = 1322504178.479644
_template_filename=u'/var/www/jonas/MVX-LAN-Manager/lan-manager/lanmanager/templates/base.mako'
_template_uri=u'/base.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        url = context.get('url', UNDEFINED)
        h = context.get('h', UNDEFINED)
        self = context.get('self', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\r\n"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html>\r\n\t<head>\r\n\t\t<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\r\n\t\t<link rel="shortcut icon" href="/favicon.ico">\r\n\t\t')
        # SOURCE LINE 8
        __M_writer(escape(h.javascript_link(url('/_static/js/base.js'))))
        __M_writer(u'\r\n\t\t')
        # SOURCE LINE 9
        __M_writer(escape(h.stylesheet_link(url('/_static/css/base.css'))))
        __M_writer(u'\r\n\t\t\r\n\t\t')
        # SOURCE LINE 11
        __M_writer(escape(self.head_tags()))
        __M_writer(u'\r\n\t</head>\r\n\t<body>\r\n\t\t')
        # SOURCE LINE 14
        __M_writer(escape(self.body()))
        __M_writer(u'\r\n\t</body>\r\n</html>')
        return ''
    finally:
        context.caller_stack._pop_frame()


