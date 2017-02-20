<?php
return [
    'calculator\\V1\\Rest\\Expressions\\Controller' => [
        'description' => 'calculate math expression',
        'collection' => [
            'description' => 'list of received expressions',
            'GET' => [
                'description' => 'show expressions and result',
                'response' => '{
   "expression": "math expression"
}',
            ],
            'POST' => [
                'description' => 'batch add expressions',
                'response' => '{
   "expression": "math expression"
}',
                'request' => '{
   "expression": "math expression"
}',
            ],
            'DELETE' => [
                'description' => 'reset list of expressions',
                'request' => '',
            ],
        ],
        'entity' => [
            'GET' => [
                'description' => 'get expression with result',
                'response' => '{
   "expression": "math expression"
}',
            ],
            'description' => 'a math expression with result',
            'POST' => [
                'description' => 'add an expression',
                'request' => '{
   "expression": "math expression"
}',
            ],
        ],
    ],
];
