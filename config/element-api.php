<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;
use craft\helpers\ArrayHelper;

return [
    'endpoints' => [
        'projects.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'projects'],
                'transformer' => function(Entry $entry) {
                    // Get categories from the skillsAndTechnologies field
                    $categories = $entry->getFieldValue('skillsAndTechnologies')->all();
                    return [
                        'id' => $entry->id,
                        'domain' => $entry->domain,
                        'title' => $entry->title,
                        'skills' =>  ArrayHelper::getColumn($categories, 'title'),
                    ];
                },
                'pretty' => true,
            ];
        },
    ]
];
