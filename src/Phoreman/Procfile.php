<?php
namespace Phoreman;
use Symfony\Component\Process\Process;

/**
* Handle Procfile
*/
class Procfile
{
  protected $proc_file_path="Procfile";
  protected $lines=[];
  public $entries=[];
  protected $env=[];
  protected $cwd=null;
  

  public function set_procfile($path){
    if (!empty($cwd)){
      $this->proc_file_path=$path;
    }
    return  $this->proc_file_path;
  }

  public function set_env($env){
    $this->env=$env;
    return $env;
  }
  
  public function set_port($env){
    throw new \Exception("Not Implemented Yet");
  }
  
  /* format of $concurrencies is process=num,process=num
  */
  public function set_concurrency($concurrencies){
    if (!empty($concurrencies)){
    $concurrencies = explode(",", $concurrencies);
    foreach ($concurrencies as $concurrency){
      $concurrency = explode("=", $concurrency);
      $this->entries[$concurrency[0]] = $concurrency[1];
    }
   }
  }
  
  public function set_root($cwd){
    if (!empty($cwd)){
      chdir($cwd);
      $this->cwd=$cwd;
    }
    return $this->cwd;
  }
  
  protected function start_proc(&$entry) {

    $process = new Process($entry["command"], $this->cwd, $this->env);
    $process->start();
    $entry["pid"] = $process->getPid();
    $entry["process"] = $process;
    if (empty($entry["pid"])){
      throw new \Exception($entry["name"]." could not be run");
    }
  }
  
  protected function parse_line($line){
    preg_match("/^([A-Za-z0-9_-]+):\s*(.+)$/", $line, $output_array);
    if (!empty($output_array)) {
      return array(
        "name" => $output_array[1],
        "command" => $output_array[2],
        "pid" => null,
        "concurrency" => 1,
      );
    }
    else return null;
  }
  
  protected function load(){
    
    if (file_exists($this->proc_file_path)) {
      $this->lines = file($this->proc_file_path, FILE_IGNORE_NEW_LINES);
    } else {
      throw new \Exception($this->proc_file_path." does not exist.");
      return null;
    }
    return $this->lines ;
  }
  

  protected function filter_entries($processes){
    if (!empty($processes)) $this->entries = array_intersect_key($this->entries, array_flip(explode(" ",$processes)));
    return $this->entries;
  }
    
  protected function parse(){
    if (!empty($this->lines)){
      foreach ($this->lines as $line){
        $entry = $this->parse_line($line);
        if (!empty($entry)) {
          $this->entries[] = $entry;
        } else {
          throw new \Exception($line." can not be parsed" );
        };
      }
    }
    else {
      throw new \Exception("Procfile is empty");
    }
  }

  function start($processes=[]) {
    $this->load();
    $this->parse();
    $this->filter_entries($processes);
    foreach ($this->entries as &$entry){
      $this->start_proc($entry);
    }
    return $this->entries;
  }
}

