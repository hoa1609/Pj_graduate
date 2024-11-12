<?php

if (!function_exists('convert_price')) {
    function convert_price(string $price = '')
    {
        return str_replace('.', '', $price);
    }
}

if (!function_exists('convert_array')) {
    function convert_array($system = null, $keyword = '', $value = ''){
        $temp = [];
        if(is_array(($system))){
            foreach($system as $key => $val){
                $system[$val[$keyword]] = $val[$value];
            }
        }
        if(is_object($system)){
            foreach($system as $key => $val){
                $temp[$val->{$keyword}] = $val->{$value};
            }
        }
        return $temp;
    }
}

if (!function_exists('loadClass')) {
    function loadClass(string $model = '', $interface = 'Repository')
    {
        $serviceInterfaceNamespace = '\App\Repositories\\' . ucfirst($model) . $interface;
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        return $serviceInstance;
    }
}

if (!function_exists('convertArrayByKey')) {
    function convertArrayByKey($object = null, $fields = [])
    {
        $temp = [];
        foreach ($object as $key => $value) {
            foreach ($fields as $field) {
                if(is_array($object)){
                    $temp[$field][] = $value[$field];
                }
                else 
                {
                    $extract = explode('.',$field);
                    if(count($extract) == 2) {
                        $temp[$extract[0]][] =   $value->{$extract[1]}->first()->pivot->{$extract[0]};
                        
                    }else {
                        $temp[$field][] = $value->{$field};
                    }
                }
            }
        }
        return $temp;
    }
}

