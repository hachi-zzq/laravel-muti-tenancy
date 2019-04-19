<?php
/**
 * Created by PhpStorm.
 * DateTime: 2018/11/5 15:39
 * @author: hachi.zzq <hachi.zzq@gmail.com>
 */

return [
    'models' => [
        /**
         * Specify different models to be used for the global, system database
         * connection. These are also used in their relationships. Models
         * used have to implement their respective contracts and
         * either extend the SystemModel or use the trait
         * UsesSystemConnection.
         */

        // Must implement \Hyn\Tenancy\Contracts\Customer
        'customer' => \Hachi\LaravelMutiTenancy\Models\Customer::class,

        // Must implement \Hyn\Tenancy\Contracts\Hostname
        'hostname' => \Hachi\LaravelMutiTenancy\Models\Hostname::class,

        // Must implement \Hyn\Tenancy\Contracts\Website
        'website' => \Hachi\LaravelMutiTenancy\Models\Website::class
    ],
    'website' => [

        'filter-field-name'=>'tenancy_id',
        /**
         * Each website has a short random hash that identifies this entity
         * to the application. By default this id is randomized and fully
         * auto-generated. In case you want to force your own logic for
         * when you need to have a better overview of the complete
         * tenant folder structure, disable this and implement
         * your own id generation logic.
         */
        'disable-random-id' => false,

        /**
         * Specify the disk you configured in the filesystems.php file where to store
         * the tenant specific files, including media, packages, routes and other
         * files for this particular website.
         *
         * @info If not set, will revert to the default filesystem.
         */
        'disk' => null,

        /**
         * Automatically generate a tenant directory based on the random id of the
         * website. Uses the above disk to store files to override system-wide
         * files.
         *
         * @info set to false to disable.
         */
        'auto-create-tenant-directory' => true,

        /**
         * Automatically rename the tenant directory when the random id of the
         * website changes. This should not be too common, but in case it happens
         * we automatically want to move files accordingly.
         *
         * @info set to false to disable.
         */
        'auto-rename-tenant-directory' => true,

        /**
         * Automatically deletes the tenant specific directory and all files
         * contained within.
         *
         * @see
         * @info set to true to enable.
         */
        'auto-delete-tenant-directory' => false,

        /**
         * Time to cache websites in minutes. Set to false to disable.
         */
        'cache' => 10,
    ],

    'folders' => [
        'config' => [
            /**
             * Merge configuration files from the config directory
             * inside the tenant directory with the global configuration files.
             */
            'enabled' => true,

            /**
             * List of configuration files to ignore, preventing override of crucial
             * application configurations.
             */
            'blacklist' => ['database', 'tenancy', 'webserver'],
        ],
        'routes' => [
            /**
             * Allows adding and overriding URL routes inside the tenant directory.
             */
            'enabled' => true,

            /**
             * Prefix all tenant routes.
             */
            'prefix' => null,
        ],
        'trans' => [
            /**
             * Allows reading translation files from a trans directory inside
             * the tenant directory.
             */
            'enabled' => true,

            /**
             * Will override the global translations with the tenant translations.
             * This is done by overriding the laravel default translator with the new path.
             */
            'override-global' => true,

            /**
             * In case you disabled global override, specify a namespace here to load the
             * tenant translation files with.
             */
            'namespace' => 'tenant',
        ],
        'vendor' => [
            /**
             * Allows using a custom vendor (composer driven) folder inside
             * the tenant directory.
             */
            'enabled' => true,
        ],
        'media' => [
            /**
             * Mounts the assets directory with (static) files for public use.
             */
            'enabled' => true,
        ],
        'views' => [
            /**
             * Adds the vendor directory of the tenant inside the application.
             */
            'enabled' => true,

            /**
             * Specify a namespace to use with which to load the views.
             *
             * @eg setting `tenant` will allow you to use `tenant::some.blade.php`
             * @info set to null to add to the global namespace.
             */
            'namespace' => null,

            /**
             * If `namespace` is set to null (thus using the global namespace)
             * make it override the global views. Disable to
             */
            'override-global' => true,
        ]
    ]
];