import logging

from pylons import request, response, session, tmpl_context as c, url
from pylons.controllers.util import abort, redirect
from pylons import tmpl_context as c

from lanmanager.lib.base import BaseController, render
import lanmanager.model as model

log = logging.getLogger(__name__)

class ListController(BaseController):

    def index(self):
       	machines_q = model.meta.Session.query(model.Machines)
    	c.machines = machines_q.all()
    	
        return render("/list.mako")