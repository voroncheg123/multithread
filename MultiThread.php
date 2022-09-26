<?php


class MultiThread
{

    private $pull;
    private $handler;
    private $log_file;
    private $iteration;
    private $separator;

    /**
     * Creates thread
     * @param $params
     * @param $handler
     * @param $iteration
     * @param $separator
     * @return void
     */

    public function execute($params, $handler, $iteration,$separator){

        $this->iteration = $iteration;
        $this->separator = $separator;
        $this->set_pull($params);
        $this->set_handler($handler);
        $this->set_log_file($handler);
        $this->run();
    }

    /**
     * Starts a thread in the background
     * @return void
     */

    private function run(){

        $cmd = 'php '.$this->handler.' '.$this->pull.' > '.$this->log_file.' 2>&1 &';

        exec($cmd);
    }

    /**
     * Sets handler file
     * @param $file_name string
     * @return void
     */

    private function set_handler($file_name){
        $this->handler = __DIR__.'/handlers/'.$file_name;
    }

    /**
     * Sets and creates log file
     * @param $handler string
     * @return void
     */

    private function set_log_file($handler){
        $post_fix = $this->iteration.'.log';
        if(!is_dir(__DIR__.'/logs/')){
            mkdir(__DIR__.'/logs/');
        }
        $this->log_file = __DIR__.'/logs/'.str_replace('.php',$post_fix, $handler);
    }

    /** Creates a string to pass to the thread
     * @param $params
     * @return void
     */

    private function set_pull($params){
        $pull_str = '';
        foreach ($params as $elem){
            $pull_str .= $elem.$this->separator;
        }

        $this->pull = $pull_str;
    }

}