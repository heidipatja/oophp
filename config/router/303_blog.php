<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "PostController",
            "mount" => "content/blog",
            "handler" => "\Hepa19\Content\PostController",
        ],
    ]
];
