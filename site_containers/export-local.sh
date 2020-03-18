#!/bin/sh

./carpenter -vv -s template_db -d "mysql_user:password@tcp(127.0.0.1:13001)" design -s -p --dir ../database/json/
./carpenter -vv -s template_db -d "mysql_user:password@tcp(127.0.0.1:13001)" export -r "^m_.*" -d ../database/csv/
