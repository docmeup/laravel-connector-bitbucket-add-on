<?php

$connectorBaseHost = env('GITCONNECTOR_BITBUCKET_HOST', env('APP_URL'));

return [
    'bitbucket' => [
        'client' => [
            'id' => env('GITCONNECTOR_BITBUCKET_CLIENT_ID'),
            'secret' => env('GITCONNECTOR_BITBUCKET_CLIENT_SECRET'),
        ],
        'connector' => [
            /**
             * @see https://developer.atlassian.com/cloud/bitbucket/app-descriptor/
             */
            "key" => "demo-key",

            "name" => "Demo Laravel Add-on",

            "description" => "An example add-on for Bitbucket",

            "vendor" => [
                "name" => "Tyler Mills",
                "url" => env('APP_URL')
            ],

            "baseUrl" => $connectorBaseHost . '/connector/bitbucket',

            "authentication" => [
                "type" => "jwt"
            ],

            "lifecycle" => [
                /** Final endpoint: bitbucket['baseUrl']/installed */
                "installed" => "/installed",
                /** Final endpoint: bitbucket['baseUrl']/uninstalled */
                "uninstalled" => "/uninstalled"
            ],

            /**
             * Modules are the specific integration points implemented by your app. These include UI elements like pages,
             * web panels, and web items. Other types of modules do not modify the Bitbucket UI, but describe how your
             * app interacts programmatically with Bitbucket, such as webhooks and Oauth consumers.
             */
            "modules" => [
                "webhooks" => [
                    [
                        "event" => "*",
                        /** Final endpoint: bitbucket['baseUrl']/webhook */
                        "url" => "/webhook"
                    ]
                ],
                "configurePage" => [
                    [
                        "key" => 'add-on-config',
                        "name" => ["value" => 'Configure'],
                        "url" => '/configure',
                        // "conditions" => [],
                        // params => [],
                    ],
                ],
                "webItems" => [
                    [
                        "url" => "/",
                        "name" => [
                            "value" => "Example External Link"
                        ],
                        "location" => "org.bitbucket.repository.navigation",
                        "key" => "example-web-item",
                        "params" => [
                            "auiIcon" => "aui-iconfont-link"
                        ]
                    ]
                ],
                "repoPages" => [
                    [
                        "url" => "/repo-page/{repository.full_name}",
                        "name" => [
                            "value" => "Example Page"
                        ],
                        "location" => "org.bitbucket.repository.navigation",
                        "key" => "example-repo-page",
                        "params" => [
                            "auiIcon" => "aui-iconfont-doc"
                        ]
                    ]
                ],
                "webPanels" => [
                    [
                        "url" => "/web-panels/{repository.full_name}",
                        "name" => [
                            "value" => "Example Web Panel"
                        ],
                        "location" => "org.bitbucket.repository.overview.informationPanel",
                        "key" => "example-web-panel"
                    ]
                ]
            ],

            /**
             * The definitions section of the descriptor enables application developers to define their own object schemas.
             * Currently the only place such schemas can be used is when they’re referenced from a custom event.
             *
             * "definitions": {
             *   "com.example.app:myobject": {
             *     "type": "object",
             *     "description": "An object",
             *     "properties": {
             *       "my-property": {
             *         "type": "string",
             *         "description": "A property",
             *         "required": true
             *       },
             *       "repository": {
             *         "$ref": "#/definitions/repository"
             *       }
             *     }
             *   }
             * }
             */

            "scopes" => ["account", "repository"],

            /** @see https://developer.atlassian.com/cloud/bitbucket/app-context/ */
            "contexts" => ["account"]
        ],
    ]
];
