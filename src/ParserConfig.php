<?php

/**
 * Description of ParserConfig
 *
 * @author Oyelaking
 */
class ParserConfig {

    /**
     *
     * @var array 
     */
    private $headers;

    /**
     *
     * @var array 
     */
    private $keys;

    public function getHeaders() {
        return $this->headers;
    }

    public function getKeys() {
        return $this->keys;
    }

    public function setHeaders(array $headers) {
        $this->headers = $headers;
    }

    public function setKeys(array $keys) {
        $this->keys = $keys;
    }

}
