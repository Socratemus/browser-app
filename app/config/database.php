<?php

return array(
    'host' => getenv('IP'),
    'username' => getenv('C9_USER'),
    'password' => '' ,
    'dbname' => 'dev_portals',
    'dbport' => 3306,
    'db_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    )
);