<?php


namespace Rusinov\Ex2\Factory;


class DbConnectionFactory
{
    public static function getDBConnection($params)
    {
        return \Doctrine\DBAL\DriverManager::getConnection($params['mysql']);
    }
}
