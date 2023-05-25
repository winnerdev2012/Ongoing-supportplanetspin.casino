<?php
if (!empty($_SERVER['HTTP_PROXY']) && substr($_SERVER['HTTP_PROXY'], 0, 7 ) === "http://") {
    $proxy_host= substr($_SERVER['HTTP_PROXY'], 7);
    $default_opts = array(
        'http'=>array(
            'proxy'=> 'tcp://'.$proxy_host
        ),
        'https'=>array(
            'proxy'=> 'tcp://'.$proxy_host
        )
    );
    
    $default = stream_context_set_default($default_opts);
}
