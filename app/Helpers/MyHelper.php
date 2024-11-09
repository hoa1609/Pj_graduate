<?php

if(!function_exists('convert_price')){
    function convert_price(string $price = ''){
        return str_replace('.','', $price);
    }
}


if(!function_exists('laodclass')) {
    function loadClass(string $model = '', $folder = 'Repositories', $interface = 'Repository') {
        $serviceInterfaceNameSpace = 'App\\'.$folder.'\\' . ucfirst($model) . $interface;
        if (class_exists($serviceInterfaceNameSpace))
        {
            $serviceInstance = app($serviceInterfaceNameSpace);
        }
        return $serviceInstance;
    }
}
