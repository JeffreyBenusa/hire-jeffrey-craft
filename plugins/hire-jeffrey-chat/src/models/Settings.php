<?php

namespace jeffreybenusa\crafthirejeffreychat\models;

use Craft;
use craft\base\Model;

/**
 * hire-jeffrey-chat settings
 */
class Settings extends Model
{
    /**
     * @var string|null The API key for ChatGPT
     */
    public ?string $apiKey = null;

    /**
     * @var string|null The Persona text for ChatGPT
     */
    public ?string $persona = null;

    /**
     * @var array|null A list of formatting options
     */
    public ?array $formatting = null;

    /**
     * Define validation rules for the API key field
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            [['apiKey'], 'string'],
            [['apiKey'], 'required'],
            [['persona'], 'string'],
            [['formatting'], 'safe'],
        ];
    }

    /**
     * Get the API key from environment settings if not defined
     *
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey ?? Craft::parseEnv('$OPENAI_API_KEY'); // Replace with your desired env key
    }
}