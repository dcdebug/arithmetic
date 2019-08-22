<?php
include "./LRUcache.php";
include "./Node.php";

$lrucache  = new \LRUcache\LRUcache(5);
$key = "index_1";
$lrucache->put($key,3);
$lrucache->put("index_2",4444);
//$lrucache->put("index_3",11);
//s$lrucache->put("index_5",22);
//$lrucache->put("index_6",333);
//$lrucache->put("index_7",4);
$lrucache->print_cache();


//$result = $lrucache->get($key);

//var_dump($result);

return true;
while(true){
    $readline = readline();
    if(empty($readline)){
        continue;
    }
    $lrucache = new \LRUcache\LRUcache(10);
    if(is_int($readline)){
        echo "start";
    }else if(strtolower($readline) == 'quit'){
        die("end");
    }else if(is_string($readline)){
        $command_list =array("p",'n');
        if(!in_array(strtolower($readline),$command_list)){
            echo "not allowed array".PHP_EOL;
        }else{
            switch (strtolower($readline)){
                case 'p':
                    $lrucache->print_cache();
                    break;
                case 'n':
                    echo "please input a data:";
                    $data_readline = readline();
                    $lrucache->put("aaa",$data_readline);
                    break;
            }
        }
    }
}