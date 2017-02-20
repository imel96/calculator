<?php
return [
    'service_manager' => [
        'factories' => [
            \calculator\V1\Rest\Expressions\ExpressionsResource::class => \calculator\V1\Rest\Expressions\ExpressionsResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'calculator.rest.expressions' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/expressions[/:expressions_id]',
                    'defaults' => [
                        'controller' => 'calculator\\V1\\Rest\\Expressions\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'calculator.rest.expressions',
        ],
    ],
    'zf-rest' => [
        'calculator\\V1\\Rest\\Expressions\\Controller' => [
            'listener' => \calculator\V1\Rest\Expressions\ExpressionsResource::class,
            'route_name' => 'calculator.rest.expressions',
            'route_identifier_name' => 'expressions_id',
            'collection_name' => 'expressions',
            'entity_http_methods' => [
                0 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
                2 => 'DELETE',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \calculator\V1\Rest\Expressions\ExpressionsEntity::class,
            'collection_class' => \calculator\V1\Rest\Expressions\ExpressionsCollection::class,
            'service_name' => 'expressions',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'calculator\\V1\\Rest\\Expressions\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'calculator\\V1\\Rest\\Expressions\\Controller' => [
                0 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'calculator\\V1\\Rest\\Expressions\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \calculator\V1\Rest\Expressions\ExpressionsEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'calculator.rest.expressions',
                'route_identifier_name' => 'expressions_id',
                'hydrator' => \Zend\Hydrator\ArraySerializable::class,
            ],
            \calculator\V1\Rest\Expressions\ExpressionsCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'calculator.rest.expressions',
                'route_identifier_name' => 'expressions_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'calculator\\V1\\Rest\\Expressions\\Controller' => [
            'input_filter' => 'calculator\\V1\\Rest\\Expressions\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'calculator\\V1\\Rest\\Expressions\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\Regex::class,
                        'options' => [
                            'pattern' => '/\\d+[-+\\/*]\\d+/',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'expression',
                'description' => 'math expression',
                'field_type' => 'string',
            ],
        ],
    ],
];
