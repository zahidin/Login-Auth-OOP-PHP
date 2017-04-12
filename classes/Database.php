<?php

class Database{

  private static $INSTANCE = null;
  private $mysqli,
          $HOST = 'localhost',
          $USER = 'root',
          $PASS = '' ,
          $DBNAME = 'authphp';

  public function __construct(){

    $this->mysqli = new mysqli ( $this->HOST, $this->USER, $this->PASS, $this->DBNAME );
    if( mysqli_connect_error() ){
      die("gagal koneksi");
    }
  }

/*
  singleton pattern ,
  agar menguji koneksi agar tidak double
*/
  public static function getInstance(){
    if( !isset( self::$INSTANCE ) ){
      self::$INSTANCE = new Database();
  }
  return self::$INSTANCE;
  }

  public function insert($table, $fields = array()){
    // implode menjadikan array menjadi string biasa

    // mengambil column
    $column = implode(", ", array_keys($fields));

    //mengambil nilai
    // $valuesArrays = array(); untuk menyiapkan array yang akan diisi
    $valuesArrays = array();
    $i = 0; // untuk mengindex kan array 0 => password
    foreach($fields as $key=>$values){
      // fungsi is_int(varname) berfungsi untunk melakukan pengecekan
      // apakah variabel bernilai int atau tidak
      if( is_int($values) ){
        $valuesArrays[$i] = $this->escape($values);
      }else{
        $valuesArrays[$i] = "'" . $this->escape($values) . "'";
      }

      $i++;
    }
    $values = implode(", ", $valuesArrays);

    $query = "INSERT INTO $table ($column) VALUES ($values)";

    return $this->run_query($query, '<script>alert("Masalah Pada Masukan Data")</script>');
  }

  public function get_info($table , $column = '' ,$value = '')
  {
    if( !is_int($value) ){
      $value = "'". $value ."'";

      if($column != ''){
      $query = "SELECT * FROM $table WHERE $column = $value";
      $result = $this->mysqli->query($query);

      while ($row = $result->fetch_assoc()) {
        return $row;
          }
        }else {
          $query = "SELECT * FROM $table";
          $result = $this->mysqli->query($query);

          while ($row = $result->fetch_assoc()) {
            $results[] = $row;
            }
      }
        return $results;
    }
  }

  public function update($table,$fields, $id){
    $valuesArrays = array();
    $i = 0; // untuk mengindex kan array 0 => password
    foreach($fields as $key=>$values){
      // fungsi is_int(varname) berfungsi untunk melakukan pengecekan
      // apakah variabel bernilai int atau tidak
      if( is_int($values) ){
        $valuesArrays[$i] =$key. "=" .$this->escape($values);
      }else{
        $valuesArrays[$i] =$key. "='" . $this->escape($values) . "'";
      }

      $i++;
    }
    $values = implode(", ", $valuesArrays);

    $query = "UPDATE $table SET $values WHERE id=$id";

    return $this->run_query($query, '<script>alert("Masalah Pada Ganti Password")</script>');

  }


  public function run_query($query,$msg)
  {
    if($this->mysqli->query($query)) return true;
    else echo $msg ;
  }

  public function escape($name)
  {
    return $this->mysqli->real_escape_string($name);
  }

}
?>
