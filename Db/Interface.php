<?php
interface Chco_Db_Interface
{
    public function getConnection();
    
    public function close();
    
    public function isConnected();
    
    public function query($statement);
    
    public function insert(array $row, $table);
    
    public function update(array $row, $where, $table);
    
    public function delete($where, $table);
}