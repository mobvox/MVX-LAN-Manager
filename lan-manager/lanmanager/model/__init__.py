import sqlalchemy as sa
from sqlalchemy import orm

from lanmanager.model import meta

import datetime

def init_model(engine):
	"""Call me before using any of the tables or classes in the model."""
	sm = orm.sessionmaker(autoflush=True, transactional=True, bind=engine)

	meta.engine = engine
	meta.Session = orm.scoped_session(sm)


# Machines table
machines_table = sa.Table('machines', meta.metadata,
	sa.schema.Column('mac', sa.types.Unicode(17), primary_key=True, unique=True),
	sa.schema.Column('ip', sa.types.Unicode(15), default=u''),
	sa.schema.Column('name', sa.types.String),
	sa.schema.Column('open_ports', sa.types.String),
	sa.schema.Column('last_update', sa.types.TIMESTAMP(), default=datetime.datetime.now()),
)

class Machines(object):
	pass

# Mapping machines_table to Machines
orm.mapper(Machines, machines_table)