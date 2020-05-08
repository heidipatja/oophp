<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "ContentController",
            "mount" => "content",
            "handler" => "\Hepa19\Content\ContentController",
        ],
    ]
];
