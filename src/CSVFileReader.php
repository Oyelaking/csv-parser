<?php

/**
 * CSVFileReader reads a csv file
 *
 * @author Oyelaking
 */
class CSVFileReader {

    protected $filePath;
    protected $useFirstRowAsHeaders;
    protected $headers;
    protected $fileHandle;
    protected $errorMessage;
    protected $initialized = false;
    protected $closed = false;

    public function __construct($filePath, $useFirstRowAsHeaders = true) {
        $this->filePath = $filePath;
        $this->useFirstRowAsHeaders = $useFirstRowAsHeaders;
        $this->init();
    }

    protected function init() {
        if (!file_exists($this->filePath)) {
            $this->errorMessage = "The file, {$this->filePath}, does"
                    . " not exist";
            return;
        }
        $this->fileHandle = fopen($this->filePath, "r");
        if (empty($this->fileHandle)) {
            $this->errorMessage = "Failed to open the file, {$this->filePath}"
                    . ", for reading";
            return;
        }
        $this->initialized = true;
        $this->readHeader();
    }

    protected function readHeader() {
        if ($this->useFirstRowAsHeaders) {
            //read the first row as headers
            $this->headers = $this->readRow();
        }
    }

    public function readRow() {
        if ($this->validateReader()) {
            return fgetcsv($this->fileHandle);
        }
        return false;
    }

    public function validateReader() {
        if ($this->closed) {
            $this->errorMessage = "Can't read from file because the file "
                    . "reader has already been closed";
            return false;
        } else if (!$this->initialized) {
            $this->errorMessage = "The reader has not been initialized";
            return FALSE;
        }
        return true;
    }

    public function getFilePath() {
        return $this->filePath;
    }

    public function getUseFirstRowAsHeaders() {
        return $this->useFirstRowAsHeaders;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }

    public function close() {
        @fclose($this->fileHandle);
        $this->closed = true;
    }

    public function __destruct() {
        $this->close();
    }

}
