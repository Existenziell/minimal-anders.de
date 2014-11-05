<?php

class RedisIO {

    private $_redis;

    public function __construct() {
    	include('RedisConf.php');
        $this->_redis = Predis_Client::create($configurations);
    }
	
	// Getter & Setter
    public function getEntry($key) {
        return $this->_redis->get($key);
    }
    
    public function setEntry($key, $data) {
        $this->_redis->set($key, $data);
    }
    
    public function deleteEntry($key) {
        $this->_redis->delete($key);
    }

	// Lists
    public function addListItem($key, $data){
        $this->_redis->lpush($key, $data);
    }

    public function removeListItem($key, $data){
        $this->_redis->lrem($key, 0, $data);
    }

    public function getList($key) {
        return $this->_redis->lrange($key, 0, -1);
    }

    public function getListCount($key) {
        return $this->_redis->llen($key);
    }
   	
	// Expires & Keys   
    public function setExpireTime($key, $timeout) {
        $this->_redis->expire($key, $timeout);
    }
	
	public function getKeys($pattern) {
        return $this->_redis->keys($pattern);
    }

    public function checkIfKeyExists($key) {
    	return $this->_redis->exists($key);
    }

    public function flushDatabase() {
        $this->_redis->flushDatabase();
    }   
}

?>