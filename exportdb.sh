#!/bin/sh
now="$(date +"%d %m %Y %T")"
mysqldump --defaults-extra-file=mycred.cnf 62999wclp20192 > "sqlbackup $now.sql"
