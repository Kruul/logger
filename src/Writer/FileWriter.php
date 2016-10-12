<?php
namespace Kruul\Logger\Writer;
/*
  20160304:
* Exception вынесен за пределі конструктора
+ Exceptin когда не указан путь к файлу
*/

class FileWriter{
  public $logfile;

  public function __construct($logfile){
    if (empty($logfile)) throw new \Exception("LOGGER ERROR: Name is empty in log", 1);
    $this->logfile = $logfile;
  }

  public function Write($msg){
    if (empty($this->logfile)) return ;
    if(!is_file($this->logfile)) {file_put_contents($this->logfile, '', FILE_APPEND);}
    if(!is_writable($this->logfile)){
        throw new \Exception("LOGGER ERROR: Can't write to log", 1);
    }
    file_put_contents($this->logfile, $msg, FILE_APPEND);
  }
}

