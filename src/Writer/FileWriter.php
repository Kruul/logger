<?php
namespace Kruul\Logger\Writer;
/*
  20160304:
* Exception вынесен за пределы конструктора
+ Exceptin когда не указан путь к файлу
* Исправлена ошибка если нет файла
*/

class FileWriter{
  public $logfile;

  public function __construct($logfile=''){
    //if (empty($logfile)) throw new \Exception("LOGGER ERROR: Name is empty in log", 1);
   $this->setLogfile($logfile);
    //$this->logfile = $logfile;
  }

  public function setLogfile($logfile){
      $this->logfile=$logfile;
      return $this;
  }

  public function Write($msg){
    //if (empty($logfile)) throw new \Exception("LOGGER ERROR: Name is empty in log", 1);
    if (empty($this->logfile)) return ;
    if(!is_file($this->logfile)) {
        if(@file_put_contents($this->logfile, '', FILE_APPEND)===false) throw new \Exception("LOGGER ERROR: Can't create log", 1);
    }
    if(!is_writable($this->logfile)){
        throw new \Exception("LOGGER ERROR: Can't write to log", 1);
    }
    file_put_contents($this->logfile, $msg, FILE_APPEND);
  }
}

