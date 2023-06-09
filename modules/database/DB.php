<?php
class DB{

    /**
     * insert the to the table by provide data as assoc array
     * @param  mysqli $connection
     * @param string $table
     * @param array $data
     * @return bool
     */
    static public function insert($connection,$table,$data)
    {
        $columns = "";
        $values = "'";
        $keys = array_keys($data);
        foreach($data as $column => $value){
            if($column == $keys[0]){
                $columns = $columns.$column;
                $values = $values.$value."'";
                continue;
            }
            $columns = $columns.",".$column;
            $values = $values."',".$value;
        }
        $query = "INSERT INTO ".$table."(".$columns.") VALUES (".$values.")";
        $exe = mysqli_query($connection,$query);
        if($exe){
            return $query;
        }
        return $query;
        return false;
    }

    /**
     * insert the to the table by provide data as assoc array
     * @param  mysqli $connection
     * @return bool
     */
    static public function update($connection,$data)
    {
        return true;
        return false;
    }
    static public function delete($data)
    {

    }
    static public function select($data)
    {

    }
}