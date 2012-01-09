import logging

from pylons import request, response, session, tmpl_context as c, url
from pylons.controllers.util import abort, redirect
from pylons import tmpl_context as c

from lanmanager.lib.base import BaseController, render
import lanmanager.model as model

from operator import contains

log = logging.getLogger(__name__)

class ListController(BaseController):

	# main index
	def index(self):
		machines_q = model.meta.Session.query(model.Machines)
		c.machines = machines_q.all()
		c.os = self.__get_os_name()
		
		c.is_machine_on = False # off
		c.is_onoff_client_installed = False

		return render("/list.mako")

	def __get_os_name(self):
		user_agent = request.environ.get('HTTP_USER_AGENT')
		if contains(user_agent, 'Mac'):
			return 'mac'
		elif contains(user_agent, 'Windows'):
			return 'ms'
		else:
			return 'other'