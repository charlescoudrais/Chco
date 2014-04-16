<?php
class Chco_Db
{
    
    public static function factory($adapter)
    {
        $adapterClass = 'Chco_Db_Adapter_' . ucfirst(strtolower($adapter));
        $dbCharset    = Chco_Application::getConfig()->db->charset;
        
        if ('pdo' === strtolower($adapter)) {
            $dsn = 'mysql:host='
                    . Chco_Application::getConfig()->db->hostname
                    . ';dbname=' 
                    . Chco_Application::getConfig()->db->dbname;
            $options = array(
                'dsn'     => $dsn,
                'options' => array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.$dbCharset,
                    )
            );
        } else if ('mysqli' === strtolower($adapter)) {
            $options = array(
                'host'      => Chco_Application::getConfig()->db->hostname,
                'database'  => Chco_Application::getConfig()->db->dbname,
                'dbcharset' => $dbCharset,
            );
        }
        
        $options ['username'] = Chco_Application::getConfig()->db->user;
        $options ['password'] = Chco_Application::getConfig()->db->password;
        
        return new $adapterClass($options);
        
    }
    
}