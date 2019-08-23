<?php

namespace  LRUcache;

class LRUcache {

    protected  $capacity; //list's capacity


    //append

    private  $head;
    private  $tail;
    private $hashmap;

    //init
    public  function __construct($capacity)
    {
        $this->capacity = $capacity;

        $this->hashmap = array();
        //list

        $this->head = new Node(null,null);
        $this->tail = new Node(null,null);

        //empty list
        $this->head->setNext($this->tail);
        $this->tail->setPrevious($this->head);

    }

    /**
     * 打印cache 里面的内容
     */
    function print_cache(){
        if(empty($this->hashmap)){return false;}
        $node = array();
        foreach($this->hashmap as $key=>$item){
            echo  "key is {$key}".PHP_EOL;
            $node = $this->hashmap[$key];
            echo "the key 's node 's key and value is ".$node->getKey()." and ".$node->getData().PHP_EOL;

        }
        die;
        print_r($node);
        $first_key = $node->getkey();
    /*    foreach($this->hashmap as $key=>$node){
            echo " key is {$key}, and data is ".print_r($node).PHP_EOL;
        }*/

        //从一个key中可以找到所有的list node

        while($node = $this->hashmap[$first_key]){
            echo "key is ".$node->getKey().", value is ".$node->getData().PHP_EOL;
            echo "the next node is :".print_r($node->getNext());
            die;
        }
    }

    /**
     * get key
     * @param $key
     */
    public function get($key){
        if(!isset($this->hashmap[$key])){
            return null;
        }
        //get the key -> $data
        $node = $this->hashmap[$key];
        // only one element
        if(count($this->hashmap) == 1 ){
            return $node->getData();
        }
        //refresh the cache
        $this->detach($node);
        $this->attach($this->head,$node);
        return $node->getData();
    }
    //insert a new element to the cache
    public function put($key,$data){
        if($this->capacity == 0){return false;}
        if(isset($this->hashmap[$key])&&!empty($this->hashmap[$key])){
            $node= $this->hashmap[$key];
            //delete the node
            $this->detach($node);
            //add the node to the head of the list
            $this->attach($this->head,$node);
            $node->setData($data);

        }else{
                $node =  new  Node($key,$data);
                $this->hashmap[$key]=$node;
                $this->attach($this->head,$node);
                //the cached is full ?
                if(count($this->hashmap)>$this->capacity){
                    //full ,remove the tail
                    $node_to_be_remove = $this->tail->getPrevious();
                    $this->detach($node_to_be_remove);
                    unset($this->hashmap[$node_to_be_remove->getKey()]);
                }
        }
        return true;
    }
    //remove key from the list
    public function remove($key){
        //not found the key
        if(!isset($this->hashmap[$key])){return false;}
        // node will to be remove
        $node_to_be_remove = $this->hashmap[$key];
        //detach the node
        $this->detach($node_to_be_remove);
        //unset the key
        unset($this->hashmap[$node_to_be_remove->getKey()]);
        return true;
    }

    // add a node to the head of the list
    public  function attach($head,$node){
            $node->setPrevious($head);
            $node->setNext($head->getNext());

            $head->getNext()->setPrevious($node);

            $head->setNext($node);

            return true;
            $head->getNext();
            //set the node's next node 's previous
            $node->getNext()->setPrevious($node);
            //set the previous 's node 's next node
            $node->getPrevious()->setNext($node);
    }
    //remove one node
    public  function detach($node){
        //current node ,
        $node->getPrevious()->setNext($node->getNext());
        $node->getNext()->setPrevious($node->getPrevious());
    }
}