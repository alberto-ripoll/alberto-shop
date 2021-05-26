<?php
use AlbertoCore\DB\Connector;

Connector::addParam(["database" =>'default']);
Connector::addParam(["gestor" =>'pgsql']);
Connector::addParam(["host" =>'postgres']);
Connector::addParam(["port" =>'5432']);
Connector::addParam(["dbname" =>'db']);
Connector::addParam(["user" =>'zataca']);
Connector::addParam(["password" =>'zataca']);