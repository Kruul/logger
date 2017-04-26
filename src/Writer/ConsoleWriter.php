<?php
namespace Kruul\Logger\Writer;

class ConsoleWriter{
        public $output;

        public function __construct(){          
        }

        public function Write($msg){
         echo $msg;
        }


}
