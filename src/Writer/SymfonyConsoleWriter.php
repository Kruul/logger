<?php
namespace Kruul\Logger\Writer;
use Symfony\Component\Console\Output\OutputInterface;

class SymfonyConsoleWriter{
        private $output;

        public function __construct($output=''){
            $this->setOutput($output);
        }

        public function setOutput($output){
            if ($output instanceof OutputInterface) {
                $this->output=$output;
            }
            return $this;
        }

        public function Write($msg){
         if ($this->output) $this->output->write('<fg=green>'.$msg.'</>');
        }


}
