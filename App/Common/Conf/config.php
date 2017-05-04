<?php
 return array(
		'URL_MODEL' => 0,
	    'URL_CASE_INSENSITIVE'  =>  false,
	    'VAR_PAGE'=>'p',
	    'PAGE_SIZE'=>15,
		'DB_TYPE'=>'mysql',
	    'DB_HOST'=>'localhost',
	    'DB_NAME'=>'flysystem',
	    'DB_USER'=>'root',
	    'DB_PWD'=>'',
	    'DB_PREFIX'=>'fly_',
	    'DEFAULT_C_LAYER' =>  'Controller',
	    'DATA_CACHE_SUBDIR'=>true,
        'DATA_PATH_LEVEL'=>2,
	    'SESSION_PREFIX' => 'FLYSYSTEM',
        'COOKIE_PREFIX'  => 'FLYSYSTEM',
		'LOAD_EXT_CONFIG' => 'fly_config',
        'URL_HTML_SUFFIX'=>'.html',
        'TMPL_CACHE_ON'=>true,
        'SHOW_PAGE_TRACE'=>true,    //开启页面Trace
	);
?>
<!--'TMPL_CACHE_ON'=>false,-->
