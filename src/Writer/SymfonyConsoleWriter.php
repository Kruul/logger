<?php
namespace Kruul\Logger\Writer;
use Symfony\Component\Console\Output\OutputInterface;

class SymfonyConsoleWriter{
        public $output;

        public function __construct(OutputInterface $output){
          $this->output=$output;
        }

        public function Write($msg){

         $this->output->write($msg);
        }


}
