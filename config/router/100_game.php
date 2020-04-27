<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "DiceController",
            "mount" => "spel/dice2",
            "handler" => "\Hepa19\DiceV2\DiceController",
        ],
    ]
];
