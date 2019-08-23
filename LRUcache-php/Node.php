<?php
namespace  LRUcache;
class Node{

    //list's node


    private  $key; //node's key ,sample with the hashmap's key

    private  $data; //node's data;

    private  $next; //the next node;

    private  $previous;// the previous node;

    public  function __construct($key,$data)
    {
        $this->key =$key;
        $this->data =$data;
    }

    public  function setData($data){
        $this->data = $data;
    }
    public  function setNext($next){
        $this->next = $next;
    }

    public  function setPrevious($previous){
        $this->previous = $previous;
    }

    public  function getKey(){
        return $this->key;
    }
    public  function getData(){
        return $this->data;
    }
    public function getNext(){
        return $this->next;
    }

    public  function getPrevious(){
        return $this->previous;
    }
}