<?php
namespace Kruul;
use Kruul\Logger\Writer\VirtualWriter;

/*
Logger - simple logger with writers support

Author: AShvager
Mailto: alex.shvager@gmail.com
Edited: 16.07.2015

Change
20160304: + Добавлен виртуальный Writer для случая когда ни один из врайтеров не задействован.
20160728: * Перенос и перевод каредки игнорируются в сообщении
20170112: * сообщение конвертируется в json если массив

Sample:
        $log=new Logger();
        $log->addWriter(new FileWriter('/tmp/logger.log')));
        $log->addWriter(new SymfonyConsoleWriter($out));

*/

class Logger{
       private $prefix;
       public  $writer=array();

       public function __construct() {
            $this->prefix='';
            $this->addWriter(new VirtualWriter(null));
        }
       public function setPrefix($prefix){
         $this->prefix=$prefix;
         return $this;
        }

       public function addWriter($writer){
            $this->writer[]=$writer;
            return $this;
        }

       public function debug($message){
            $this->write("DEBG", $message);
            return $this;
        }
       public function error($message){
            $this->write("ERRR", $message);
            return $this;
        }
       public function critical($message){
            $this->write("CRIT", $message);
            return $this;
        }
       public function warning($message){
            $this->write("WARN", $message);
            return $this;
        }
       public function info($message){
            $this->write("INFO", $message);
            return $this;
        }
       private function write($status, $message) {
            $date = date('[Y-m-d H:i:s]');
            if (is_array($message)) $message=json_encode($message,JSON_UNESCAPED_UNICODE);
            if ($this->prefix) $message='('.$this->prefix.') '.$message;

            $msg = sprintf("%s: [%4s] - %s",$date,$status,str_replace(["\r","\n"],'',$message)). PHP_EOL;
            foreach($this->writer as $writer){
               $writer->Write($msg);
            }

        }
    }

