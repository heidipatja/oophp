<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "PageController",
            "mount" => "content/pages",
            "handler" => "\Hepa19\Content\PageController",
        ],
    ]
];
