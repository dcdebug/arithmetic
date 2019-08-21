<?php

while(true){
    echo "please input a number:".PHP_EOL;
    pcntl_signal(SIGINT,function(){
    	
		echo "退出";
	    die;
    });        
}

//信号处理函数

function sig_handler($signo){
    switch($signo){
        case SIGTERM: //15
            //处理SIGTERM信号
            break;
        case  SIGHUP: //1
            //处理SIGHUP
            break;
        case SIGUSR1: //10
            break;
        case SIGUSR2: //12
            break;
        default :

            break;
    }
}
