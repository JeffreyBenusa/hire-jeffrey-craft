<?php

namespace jeffreybenusa\crafthirejeffreychat\fields;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;

use craft\fields\conditions\TextFieldConditionRule;

use yii\db\ExpressionInterface;
use yii\db\Schema;

use craft\helpers\Cp;
use craft\helpers\StringHelper;


/**
 * Cover Letter field type
 */
class CoverLetter extends Field
{
    private string $persona;
    private string $formating;
    private string $message;


    public static function displayName(): string
    {
        return Craft::t('_hire-jeffrey-chat', 'Cover Letter');
    }

    public static function icon(): string
    {
        return 'i-cursor';
    }

    public static function phpType(): string
    {
        return 'mixed';
    }

    public static function dbType(): array|string|null
    {
        // Replace with the appropriate data type this field will store in the database,
        // or `null` if the field is managing its own data storage.
        return Schema::TYPE_STRING;
    }

    public function attributeLabels(): array
    {
        return array_merge(parent::attributeLabels(), [
            // ...
        ]);
    }

    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            // ...
        ]);
    }

    public function getSettingsHtml(): ?string
    {
        return null;
    }

    public function normalizeValue(mixed $value, ?ElementInterface $element): mixed
    {
        return $value;
    }

    protected function inputHtml(mixed $value, ?ElementInterface $element, bool $inline): string
    {

        $id = $this->getInputId();

        $components = [
            Cp::textareaHtml([
                'id' => "$id-persona",
                'name' => "$this->handle[persona]",
                'label' => "Persona",
                'value' => $value['persona'] ?? null
            ]),
            Cp::textareaHtml([
                'id' => "$id-message",
                'name' => "$this->handle[message]",
                'label' => "Message",
                'value' => $value['message'] ?? null
            ]),

            Cp::textareaHtml([
                'id' => "$id-formatting",
                'name' => "$this->handle[formatting]",
                'label' => "Formatting",
                'value' => $value['formatting'] ?? null
            ]),
        ];

        return join('', $components);

//
//        // Decode saved JSON value
//        $value = Json::decodeIfJson($value) ?? $value[0] ?? $value ?? "";
//
//        // Render an editable table
//        return Craft::$app->getView()->renderTemplate('_hire-jeffrey-chat/coverLetter.twig', [
//            'field' => $this,
//            'name' => $this->handle, // Field handle
//            'value' => $value, // Current value of the field
//        ]);
    }

    public function getElementValidationRules(): array
    {
        return [];
    }

    protected function searchKeywords(mixed $value, ElementInterface $element): string
    {
        return StringHelper::toString($value, ' ');
    }

    public function getElementConditionRuleType(): array|string|null
    {
        return TextFieldConditionRule::class;
    }

    public static function queryCondition(
        array $instances,
        mixed $value,
        array &$params,
    ): ExpressionInterface|array|string|false|null {
        return parent::queryCondition($instances, $value, $params);
    }
}
