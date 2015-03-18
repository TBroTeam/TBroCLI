#!/bin/bash
exec 6<&0; 
service postgresql start
exec 0<&6 6<&-; 
/bin/bash
