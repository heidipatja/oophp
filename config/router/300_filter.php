<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "FilterController",
            "mount" => "filter",
            "handler" => "\Hepa19\MyTextFilter\FilterController",
        ],
    ]
];
