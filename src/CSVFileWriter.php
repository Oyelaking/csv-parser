<?php

/**
 * CSVFileWriter implements writing a CSV line to file.
 *
 * @author Oyelaking
 */
class CSVFileWriter {

    protected $filePath;
    protected $fileHandle;
    protected $errorMessage = "";
    protected $initialized = false;
    protected $closed = false;

    public function __construct($filePath) {
        $this->filePath = $filePath;
        $this->init();
    }

    protected function init() {
        $this->fileHandle = fopen($this->filePath, "w+");
        if (!$this->fileHandle) {
            $this->errorMessage = "Failed to open file, $this->filePath";
            return false;
        }
        $this->initialized = true;
    }

    public function writeHeaders(array $headers) {
        if ($this->validateWriter()) {
            return fputcsv($this->fileHandle, $headers);
        }
        return FALSE;
    }

    public function validateWriter() {
        if ($this->closed) {
            $this->errorMessage = "Can't write to file because the file "
                    . "writer has already been closed";
            return false;
        }else if(!$this->initialized){
            $this->errorMessage = "The writer has not been initialized";
            return FALSE;
        }
        return true;
    }

    public function writeToFile(array $values) {
        if ($this->validateWriter()) {
            return fputcsv($this->fileHandle, $values);
        }
        return FALSE;
    }

    public function close() {
        @fclose($this->fileHandle);
        $this->closed = TRUE;
    }

    public function __destruct() {
        $this->close();
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function getFilePath() {
        return $this->filePath;
    }

}
