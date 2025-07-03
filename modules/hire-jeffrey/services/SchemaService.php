<?php

namespace modules\hirejeffrey\services;

use Craft;
use craft\base\Component;
use craft\elements\Tag;

class SchemaService extends Component
{
    private readonly array $languageTags;
    private readonly array $aboutTags;
    
    public function __construct()
    {
        $this->languageTags = ['PHP', 'JavaScript', 'Vue.js', 'Twig', 'React', 'Blade', 'SQL', 'MySQL'];
        $this->aboutTags = ['Full-Stack Development', 'Team Leadership', 'Mentorship','CCPA Compliance', 'UX/ADA Compliance', 'Automations'];
        
        parent::__construct();
    }
    
    public function getSchemaTags(array $tags): array
    {
        $grouped = [
            'programmingLanguage' => [],
            'about' => [],
            'keywords' => [],
        ];
        
        foreach ($tags as $tag) {
            $title = $tag instanceof Tag ? $tag->title : (string)$tag;
            
            match (true) {
                in_array($title, $this->languageTags, true) => $grouped['programmingLanguage'][] = $title,
                in_array($title, $this->aboutTags, true) => $grouped['about'][] = $title,
                default => $grouped['keywords'][] = $title,
            };
        }
        
        return $grouped;
    }
    
    public function getSchemaPersonUrl(): string
    {
        // Assumes you don't want trailing slash
        return rtrim(Craft::getAlias('@web'), '/') . '#jeffreyBenusa';
    }
}