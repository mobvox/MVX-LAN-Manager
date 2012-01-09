# -*- encoding:utf-8 -*-
from mako import runtime, filters, cache
UNDEFINED = runtime.UNDEFINED
__M_dict_builtin = dict
__M_locals_builtin = locals
_magic_number = 6
_modified_time = 1326117634.22474
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
        __M_writer(u"\r\n\r\n<div id='leftbar'>\r\n\t<div id='logo'></div>\r\n\t<div id='menu'>\r\n\t\t<ul>\r\n\t\t\t<li><div id='arrow'></div> <a href='/list'>Lista</a> </li>\r\n\t\t</ul>\r\n\t</div>\r\n</div>\r\n<div id='centercontent'>\r\n\t<div id='contenttable'>\r\n\t\t<div id='table'>\r\n\t\t\t<div id='tableheader'>\r\n\t\t\t\t<div><span>Status</span></div>\r\n\t\t\t\t<div><span>Nome</span></div>\r\n\t\t\t\t<div><span>IP/MAC</span></div>\r\n\t\t\t\t<div class='last'><span>Fun\xe7\xf5es</span></div>\r\n\t\t\t</div>\r\n\t\t\t<div id='tablebody'>\r\n")
        # SOURCE LINE 23
        for row in c.machines:
            # SOURCE LINE 24
            __M_writer(u"\t\t\t\t\t\t<div class='tr'>\r\n\t\t\t\t\t\t\t<div><span>Status</span></div>\r\n\t\t\t\t\t\t\t<div><span>")
            # SOURCE LINE 26
            __M_writer(escape(row.name))
            __M_writer(u"</span></div>\r\n\t\t\t\t\t\t\t<div class='multiline'>\r\n\t\t\t\t\t\t\t\t<div>\r\n\t\t\t\t\t\t\t\t\t<span>")
            # SOURCE LINE 29
            __M_writer(escape(row.ip))
            __M_writer(u'</span>\r\n\t\t\t\t\t\t\t\t\t<span class="mac">')
            # SOURCE LINE 30
            __M_writer(escape(row.mac))
            __M_writer(u"</span>\r\n\t\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t\t<div class='last'>\r\n")
            # SOURCE LINE 34
            if c.is_onoff_client_installed:
                # SOURCE LINE 35
                if c.is_machine_on:
                    # SOURCE LINE 36
                    __M_writer(u'\t\t\t\t\t\t\t\t\t\t\t<a id="onoff" class="shutdown" href="/server/shutdown/')
                    __M_writer(escape(row.ip))
                    __M_writer(u'" alt=\'Desligar\'></a>\r\n')
                    # SOURCE LINE 37
                else:
                    # SOURCE LINE 38
                    __M_writer(u'\t\t\t\t\t\t\t\t\t\t\t<a id="onoff" class="wakeup" href="/server/wake/')
                    __M_writer(escape(row.ip))
                    __M_writer(u'" alt=\'Ligar\'></a>\r\n')
                    pass
                # SOURCE LINE 40
            else:
                # SOURCE LINE 41
                __M_writer(u'\t\t\t\t\t\t\t\t\t\t<a id="onoff" class=\'disabled\' href="#" alt=\'A porta est&aacute; bloqueada ou o cliente n&atilde;o est&aacute; instalado.\'></a>\r\n')
                pass
            # SOURCE LINE 43
            __M_writer(u'\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\r\n')
            # SOURCE LINE 44
            if '22' in row.open_ports[1:-1].split(', '):
                # SOURCE LINE 45
                __M_writer(u'\t\t\t\t\t\t\t\t\t<a id="ssh" class=\'showdialog\' href="')
                __M_writer(escape(row.ip))
                __M_writer(u':22" alt="SSH"></a>\r\n')
                # SOURCE LINE 46
            else:
                # SOURCE LINE 47
                __M_writer(u'\t\t\t\t\t\t\t\t\t<a alt=\'A porta est&aacute; bloqueada ou o cliente n&atilde;o est&aacute; instalado.\' id="ssh" class=\'disabled\' href="#"></a>\r\n')
                pass
            # SOURCE LINE 49
            __M_writer(u'\r\n')
            # SOURCE LINE 50
            if '139' in row.open_ports[1:-1].split(', '):
                # SOURCE LINE 51
                if c.os == 'mac':
                    # SOURCE LINE 52
                    __M_writer(u'\t\t\t\t\t\t\t\t\t\t<a id="samba" href="smb://')
                    __M_writer(escape(row.ip))
                    __M_writer(u'" alt="Samba"></a>\r\n')
                    # SOURCE LINE 53
                elif c.os == 'ms':
                    # SOURCE LINE 54
                    __M_writer(u'\t\t\t\t\t\t\t\t\t\t<a id="samba" class=\'showdialog\' href="\\\\')
                    __M_writer(escape(row.ip))
                    __M_writer(u'" alt="Samba"></a>\r\n')
                    # SOURCE LINE 55
                else:
                    # SOURCE LINE 56
                    __M_writer(u'\t\t\t\t\t\t\t\t\t\t<a id="samba" class=\'showdialog\' href="')
                    __M_writer(escape(row.ip))
                    __M_writer(u'" alt="Samba"></a>\r\n')
                    pass
                # SOURCE LINE 58
            else:
                # SOURCE LINE 59
                __M_writer(u'\t\t\t\t\t\t\t\t\t<a id="samba" alt=\'A porta est&aacute; bloqueada ou o cliente n&atilde;o est&aacute; instalado.\' class=\'disabled\' href="#"></a>\r\n')
                pass
            # SOURCE LINE 61
            __M_writer(u'\t\t\t\t\t\t\t</div>\r\n\t\t\t\t\t\t</div>\r\n')
            pass
        # SOURCE LINE 64
        __M_writer(u'\t\t\t</div>\r\n\t\t\r\n\t\t</div>\r\n\t</div>\r\n</div>')
        return ''
    finally:
        context.caller_stack._pop_frame()


def render_head_tags(context):
    context.caller_stack._push_frame()
    try:
        __M_writer = context.writer()
        # SOURCE LINE 3
        __M_writer(u'<title>Lista</title>')
        return ''
    finally:
        context.caller_stack._pop_frame()


