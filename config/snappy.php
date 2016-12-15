<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltopdf',
       // 'binary'  => base_path('vendor/h4cc/wkhtmltopdf-win32/bin/wkhtmltopdf.exe'),
        //'binary'  => base_path('C:/Program Files/wkhtmltopdf/bin/wkhtmltopdf'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
//        'binary'  => base_path('C:/Program Files/wkhtmltoimage/bin/wkhtmltoimage.exe'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
