<?php

namespace Application;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'event' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/event[/:id]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'view',
                    ],
                ],
            ],
            'event-confirmation' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/event/:id/confirmation',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'confirmation',
                    ],
                ],
            ],
            'admin-event' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/admin/event[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action' => 'index',
                    ],
                ],
            ],

            'async-seat-pick' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/async-seat-pick',
                    'defaults' => [
                        'controller' => Controller\SeatController::class,
                        'action' => 'asyncPick',
                    ],
                ],
            ],
            'admin/async-seat-cancel' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin/async-seat-cancel',
                    'defaults' => [
                        'controller' => Controller\AdminSeatController::class,
                        'action' => 'asyncCancel',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\AdminController::class => InvokableFactory::class,
            Controller\SeatController::class => InvokableFactory::class,
            Controller\AdminSeatController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [dirname(__DIR__) . '/src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ],
        'fixture' => [
            __NAMESPACE__ => __DIR__ . '/../src/Fixture'
        ]
    ]
];
