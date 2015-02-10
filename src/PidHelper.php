<?php namespace PidHelper;

class PidHelper
{
    public function __construct($directory, $filename)
    {
        $this->directory = $directory;
        $this->filename  = $filename;
    }

    /** Writes the process id to a pid file
        @return boolean true if the file was written
    */
    public function lock()
    {
        if ($this->isRunning())
            return false;

        $pidFile = $this->directory.$this->filename;

        if (!is_writable($pidFile)) {
            throw new Exception('Can not write to file: '.$pidFile);
        }

        $file = fopen($pidFile, 'w');
        if ($file === false) {
            return false;
        }

        fputs($file, getmypid());
        fclose($file);

        return true;
    }

    /** Checks if a process is still running
        @return boolean true if the process is still running
    */
    public function isRunning()
    {
        $this->checkDirExists();

        $pidFile = $this->directory.$this->filename;
        if (!file_exists($pidFile)) {
            return false;
        }

        $pid = file_get_contents($pidFile);
        // Empty pid file means the process is not running
        if (empty($pid)) {
            return false;
        }

        if (!is_dir('/proc/'))
        {
            /* OSX Workaround, not as good as using proc dir on linux, but oh well */
            exec('ps -Ac -o pid | awk '{print $1}' | grep \'^'.$pid.'$\'', $output, $return);

            if ($return == 0) {
                // process with the same id is still running
                return false;
            }
        }

        /* we assume the system is a linux system here */
        if (!is_dir('/proc/'.$pid)) {
            // process with the same id is still running
            return false;
        }

        return true;
    }

    /** Removes a pid file from the pid directory, kind of optional as if your
    process has already stopped we should already be able to detect it. It's
    nice to clean up though.
        @return boolean true if the file exists and was deleted
    */
    public function unlock()
    {
        $this->checkDirExists();

        if (!file_exists($this->directory.$this->filename)) {
            return false;
        }

        if (!is_writable($pidFile)) {
            throw new Exception('Can not write to file: '.$pidFile);
        }

        return unlink($this->directory.$this->filename);
    }

    private function checkDirExists()
    {
        if (!is_dir($this->directory)) {
            throw new Exception($this->directory.' directory does not exist for pid files');
        }
    }
}
