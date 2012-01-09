# -*- encoding:utf-8 -*-
from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 6
_modified_time = 1325779615.34218
_template_filename='/var/www/jonas/MVX-LAN-Manager/lan-manager/lanmanager/templates/error.mako'
_template_uri='/error.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = []


def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        c = context.get('c', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"\n"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html>\n\t<head>\n\t\t<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">\n\t\t<link rel="shortcut icon" href="/favicon.ico">\n\t\t<title>Error ')
        # SOURCE LINE 8
        __M_writer(escape(c.code))
        __M_writer(u'</title>\n\t</head>\n\t<body>\n\t\t')
        # SOURCE LINE 11
        __M_writer(escape(c.message))
        __M_writer(u'\n\t</body>\n</html>')
        return ''
    finally:
        context.caller_stack._pop_frame()


