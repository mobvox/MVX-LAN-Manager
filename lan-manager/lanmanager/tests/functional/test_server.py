from lanmanager.tests import *

class TestServerController(TestController):

    def test_index(self):
        response = self.app.get(url(controller='server', action='index'))
        # Test response...
