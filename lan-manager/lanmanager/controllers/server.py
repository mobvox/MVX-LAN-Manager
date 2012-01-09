import logging

from pylons import request, response, session, tmpl_context as c, url
from pylons.controllers.util import abort, redirect

from lanmanager.lib.base import BaseController, render

import os

log = logging.getLogger(__name__)

class ServerController(BaseController):

	def index(self):
		# Return a rendered template
		#return render('/server.mako')
		# or, return a string
		return 'Hello World'
	
	def shutdown(self, id):
		return id

	def wake(self, id):
		wakecmd = 'wakeonlan %s' % id
		os.system(wakecmd)

		return 'wake packet send to %s' % id