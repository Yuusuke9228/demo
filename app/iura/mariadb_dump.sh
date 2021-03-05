#!/bin/bash
period=31
dirpath='/var/mariadb_backup'
filename=`date +%y%m%d`
mysqldump -u erphalcon --password=erphalcon smm > $dirpath/$filename.sql
chmod 777 $dirpath/$filename.sql
oldfile=`date --date "$period days ago" +%y%m%d`
rm -f $dirpath/$oldfile.sql

eval "mysql -h 'localhost' -u 'erphalcon' -p 'smm' --password='erphalcon' -e 'drop table zaiko_kakunin_tbl'"
eval "mysql -h 'localhost' -u 'erphalcon' -p 'smm' --password='erphalcon' -e 'create table zaiko_kakunin_tbl (index shouhin_mr_cd(shouhin_mr_cd),index tanni_mr1_cd(tanni_mr1_cd),index tanni_mr2_cd(tanni_mr2_cd)) select * from zaiko_kakunin_azukari_vws'"
