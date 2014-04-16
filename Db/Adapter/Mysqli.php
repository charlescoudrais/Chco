<?php
class Chco_Db_Adapter_Mysqli extends Chco_Db_Abstract
{

    protected function connect()
    {
         $this->connection = new mysqli(
                $this->options['host'],
                $this->options['username'],
                $this->options['password'], 
                $this->options['database']
         );
         $this->connection->set_charset($this->options['dbcharset']);
    }

    
    public function isConnected()
    {
        return ((bool) ($this->connection instanceof mysqli));
    }

    public function query($sql)
    {
        $result = $this->getConnection()->query($sql);
        $rowSet = array();
        while($row = $result->fetch_array())
        {
            $rowSet[] = $row;
        }
        return $rowSet;
    }
    
    public function insert(array $row, $table)
    {   
    }
    
    public function update(array $row, $where, $table)
    {
//        echo '<pre>';
//        print_r($row);
//        echo '</pre>';
//        $sql = "UPDATE functions SET id_function='1',name_function='array_change_key_case ( array \$array [, 1 (CASE_UPPER) | 0 (default:CASE_LOWER) ] )',desc_function='Change la casse des clés d'un tableau.',returnvalue_function='array()',exemple_function='TEST CHCO 2',id_category='1' WHERE id_function = 1";
        $rowKeys   = array();
        $rowValues = array();
        unset($row['id_function']);
        $row['id_category'] = 5;
        foreach ($row as $key => $val) {
            $rowKeys[]   = $key;
            $rowValues[] = $val;
            $sets[] = $key . ' = ' . $val;
        }
        $settemp   = implode(', ', $rowKeys);
        $set   = implode(', ', $sets);
        $value = implode(', ', $rowValues);
        $sql   = 'UPDATE '
                  . $table
                  . ' SET ('
                  . $set
//                  . '") VALUES ('
//                  . $value
                  . ') WHERE '
                  . 'id_function = 1';
        $result = $this->getConnection()->query($sql);
        echo $sql;
    }
    
    public function delete($where, $table)
    {
    }
}