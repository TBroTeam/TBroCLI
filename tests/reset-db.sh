#!/bin/bash
: ${ALLOW_DROP_DATABASE?"this script will drop your database chado and user tbro if they exist. set the environment variable ALLOW_DROP_DATABASE to accept that"}

THISDIR="$(cd $(dirname $0); pwd)"
DUMP="${THISDIR}/tbro.min.dump.sql.bz2"

cat <<EOF | psql -U postgres 
DROP DATABASE IF EXISTS chado;
DROP USER IF EXISTS chado;
CREATE DATABASE chado;
CREATE ROLE tbro ENCRYPTED PASSWORD 'tbro' NOSUPERUSER CREATEDB NOCREATEROLE INHERIT LOGIN;
ALTER DATABASE chado OWNER TO tbro;
GRANT ALL PRIVILEGES ON DATABASE chado to tbro;
EOF

bzcat $DUMP | psql  -U postgres chado
