#!/bin/sh
cd /opt/lampp/bin
./mysql -uroot -e "drop database todoDB;"
./mysql -uroot -e  "create database todoDB char set utf8;"
./mysql -uroot todoDB -e "create table ToDoList(id int not null auto_increment primary key,text varchar(255));"
./mysql -uroot todoDB -e "insert into ToDoList(text) value('testdata');"
./mysql -uroot todoDB -e "select * from ToDoList;"
