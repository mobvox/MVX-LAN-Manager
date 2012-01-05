# -*- encoding:utf-8 -*-
from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 6
_modified_time = 1322764548.749673
_template_filename='/var/www/jonas/MVX-LAN-Manager/lan-manager/lanmanager/templates/list.mako'
_template_uri='/list.mako'
_template_cache=cache.Cache(__name__, _modified_time)
_source_encoding='utf-8'
from webhelpers.html import escape
_exports = ['head_tags']


def _mako_get_namespace(context, name):
    try:
        return context.namespaces[(__name__, name)]
    except KeyError:
        _mako_generate_namespaces(context)
        return context.namespaces[(__name__, name)]
def _mako_generate_namespaces(context):
    pass
def _mako_inherit(template, context):
    _mako_generate_namespaces(context)
    return runtime._inherit_from(context, u'/base.mako', _template_uri)
def render_body(context,**pageargs):
    context.caller_stack._push_frame()
    try:
        __M_locals = __M_dict_builtin(pageargs=pageargs)
        c = context.get('c', UNDEFINED)
        __M_writer = context.writer()
        # SOURCE LINE 2
        __M_writer(u'\r\n')
        # SOURCE LINE 3
        __M_writer(u'\r\n\r\n')
        # SOURCE LINE 5
        for row in c.machines:
            # SOURCE LINE 6
            __M_writer(u'\t')
            __M_writer(escape(row.mac))
            __M_writer(u' ')
            __M_writer(escape(row.ip))
            __M_writer(u' ')
            __M_writer(escape(row.name))
            __M_writer(u' ')
            __M_writer(escape(row.last_update))
            __M_writer(u'\r\n')
            # SOURCE LINE 7
            for port in row.open_ports[1:-1].split(', '):
                # SOURCE LINE 8
                if port == '22':
                    # SOURCE LINE 9
                    __M_writer(u'\t\t\t<a href="ssh://')
                    __M_writer(escape(row.ip))
                    __M_writer(u':')
                    __M_writer(escape(port))
                    __M_writer(u'">ssh</a>\r\n')
                    pass
                # SOURCE LINE 11
                if port == '139':
                    # SOURCE LINE 12
                    __M_writer(u'\t\t\t<a href="smb://')
                    __M_writer(escape(row.ip))
                    __M_writer(u'">samba</a>\r\n')
                    pass
                pass
            # SOURCE LINE 15
            __M_writer(u'\t<br />\r\n')
            pass
        return ''
    finally:
        context.caller_stack._pop_frame()


def render_head_tags(context):
    context.caller_stack._push_frame()
    try:
        __M_writer = context.writer()
        # SOURCE LINE 3
        __M_writer(u'<title>List</title>')
        return ''
    finally:
        context.caller_stack._pop_frame()


