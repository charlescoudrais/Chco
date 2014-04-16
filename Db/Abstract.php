<?php
abstract class Chco_Db_Abstract implements Chco_Db_Interface
{
    protected $options;
    protected $connection;
    
    public function __construct(array $options)
    {
       $this->options = $options; 
    }
    
    public function close()
    {
        $this->connection = null;
    }
    
	/**
     * @return the $connection
     */
    public function getConnection ()
    {
        if (null === $this->connection) {
            $this->connect();
        }
        return $this->connection;
    }
    
}