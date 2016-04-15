<?php return [
    'events' => [
        'out_compile_start' => 'startCache',
        'compile_response' => 'setCache',
        'in_compile_end' => 'getCache',
        'run_end' => 'debugCache'
    ]
];