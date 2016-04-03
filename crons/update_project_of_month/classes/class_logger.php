<?php
/**
 *
 * @Class logger
 *
 * @Purpose: Logs text to a file
 *
 * @Author: Mayank Biswari
 *
 * @copyright Homeonline.com (2015)
 *
 * @example usage
 * $log = logger::getInstance();
 * 
 * $log->write('A message to save', __FILE__, __LINE__);
 *
 */

class Logger {
	private static $instance;
	private $logfile = '';
    /**
     *
     * @Constructor is set to private to stop instantion
     *
     */
	private function Logger(){
		
	}
	
    /**
     *
     * @settor
     *
     * @access public
     *
     * @param string $name
     *
     * @param mixed $value
     *
     */
	public function __set($name, $value){
		
	}
	
	
    /**
     *
     * @write to the logfile
     *
     * @access public
     *
     * @param string $message
     *
     * @param string $file The filename that caused the error
     *
     * @param int $line The line that the error occurred on
     *
     * @return number of bytes written, false other wise
     *
     */
	 
	public function write($message, $file=null, $line=null) {
		if(LOG_MODE == 'On') {
			if (!$this->logfile) {
				$this->logfile = __DIR__ . '/logs/log_' . time();
			}
			
			$message = time() .' - '.$message;
			$message .= is_null($file) ? '' : " in $file";
			$message .= is_null($line) ? '' : " on line $line";
			$message .= "\n";
			return file_put_contents( $this->logfile, $message, FILE_APPEND ) or die("Can not write to {$this->logfile}");
		}
	}
	
	
    /**
    *
    * Return logger instance or create new instance
    *
    * @return object (PDO)
    *
    * @access public
    *
    */
    public static function getInstance()
    {
        if (!self::$instance)
        {
            self::$instance = new Logger;
        }
        return self::$instance;
    }
	
    /**
     * Clone is set to private to stop cloning
     *
     */
    private function __clone()
    {
    }
}

$ob_log = logger::getInstance();
 
?>