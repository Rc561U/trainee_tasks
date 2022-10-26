<?php

namespace Crud\Mvc\core;


use App\Exceptions\DbException;
use Crud\Mvc\core\traits\DatabaseConnect;

class Model
{
    use DatabaseConnect;

    private string $tablename = 'users';
    public object $database;


    public function __construct()
    {
        $this->database = $this->connect();
        $this->dumpUserTable();
    }


    function dumpUserTable(): void
    {
        $table = $this->tablename;
        $DBH = $this->database;
        $DBH->setAttribute(\PDO::ATTR_ORACLE_NULLS, \PDO::NULL_NATURAL);

        $filename = $this->tablename;
        $handle = fopen( $filename . '.sql', 'w');
        $numtypes = array('tinyint', 'smallint', 'mediumint', 'int', 'bigint', 'float', 'double', 'decimal', 'real');


        $result = $DBH->query("SELECT * FROM $table");
        $num_fields = $result->columnCount();
        $num_rows = $result->rowCount();
        $return = "";

        // write table structure
        $pstm2 = $DBH->query("SHOW CREATE TABLE $table");
        $row2 = $pstm2->fetch(\PDO::FETCH_NUM);
        $ifnotexists = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $row2[1]);
        $return .=  $ifnotexists . ";\n\n";

        fwrite($handle, $return);

        //insert table values
        if ($num_rows) {
            $return = 'INSERT INTO `' . "$table" . "` (";
            $pstm3 = $DBH->query("SHOW COLUMNS FROM $table");
            $count = 0;
            $type = array();
            while ($rows = $pstm3->fetch(\PDO::FETCH_NUM)) {

                if (stripos($rows[1], '(')) {
                    $type[$table][] = stristr($rows[1], '(', true);
                } else $type[$table][] = $rows[1];

                $return .= "`" . $rows[0] . "`";
                $count++;
                if ($count < ($pstm3->rowCount())) {
                    $return .= ", ";
                }
            }
            $return .= ")" . ' VALUES';
            fwrite($handle, $return);

        }
        $count = 0;
        while ($row = $result->fetch(\PDO::FETCH_NUM)) {
            $return = "\n\t(";

            for ($j = 0; $j < $num_fields; $j++) {

                if (isset($row[$j])) {
                    if ((in_array($type[$table][$j], $numtypes)) && (!empty($row[$j]))) $return .= $row[$j]; else $return .= $DBH->quote($row[$j]);
                } else {
                    $return .= 'NULL';
                }
                if ($j < ($num_fields - 1)) {
                    $return .= ',';
                }
            }
            $count++;
            if ($count < ($result->rowCount())) {
                $return .= "),";
            } else {
                $return .= ");";

            }
            fwrite($handle, $return);
        }
        $return = "";

        fwrite($handle, $return);
        fclose($handle);

    }
}