<?php
namespace Kruul\Logger;
use Kruul\Logger\Writer;

/*
Logger - simple logger with writers support

Author: AShvager
Mailto: alex.shvager@gmail.com
Edited: 16.07.2015

Change
20160304: + Добавлен виртуальный Writer для случая когда ни один из врайтеров не задействован.
20160728: * Перенос и перевод каредки игнорируются в сообщении

Sample:
        $log=new Logger();
        $log->addWriter(new FileWriter('/tmp/logger.log')));
        $log->addWriter(new SymfonyConsoleWriter($out));

*/

class Logger{
       private $prefix;
       public  $writer=array();

       public function __construct() {
            echo "okk";
            $this->prefix='';
            $this->addWriter(new Writer\VirtualWriter(null));
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
            $this->write("DEBG", $this->prefix.$message);
            return $this;
        }
       public function error($message){
            $this->write("ERRR", $this->prefix.$message);
            return $this;
        }
       public function critical($message){

            $this->write("CRIT", $this->prefix.$message);

            return $this;
        }
       public function warning($message){
            $this->write("WARN", $this->prefix.$message);
            return $this;
        }
       public function info($message){
            $this->write("INFO", $this->prefix.$message);
            return $this;
        }
       private function write($status, $message) {
            $date = date('[Y-m-d H:i:s]');
            $msg = sprintf("%s: [%4s] - %s",$date,$status,str_replace(["\r","\n"],'',$message)). PHP_EOL;
            foreach($this->writer as $writer){
               $writer->Write($msg);
            }

        }
    }

