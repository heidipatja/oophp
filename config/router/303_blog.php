<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "BlogController",
            "mount" => "content/blog",
            "handler" => "\Hepa19\Content\BlogController",
        ],
    ]
];
