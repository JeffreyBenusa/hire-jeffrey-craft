<?php

namespace jeffreybenusa\crafthirejeffreychat;

use Craft;
use OpenAI;
use craft\base\Model;
use craft\base\Plugin as BasePlugin;
use craft\elements\Entry;
use craft\events\ElementEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Elements;
use craft\services\Fields;
use jeffreybenusa\crafthirejeffreychat\fields\CoverLetter;
use jeffreybenusa\crafthirejeffreychat\fields\StructuredJson;
use jeffreybenusa\crafthirejeffreychat\models\Settings;
use yii\base\Event;

/**
 * hire-jeffrey-chat plugin
 *
 * @method static Plugin getInstance()
 * @method Settings getSettings()
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => [
                // Define component configs here...
            ],
        ];
    }

    public function init(): void
    {
        parent::init();

         $this->attachEventHandlers();

        // Any code that creates an element query or loads Twig should be deferred until
        // after Craft is fully initialized, to avoid conflicts with other plugins/modules
        Craft::$app->onInit(function() {
            // ...
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('_hire-jeffrey-chat/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/5.x/extend/events.html to get started)
        // Register Cover Letter field (encapsulate the processing)
        Event::on(Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
//                $event->types[] = CoverLetter::class;
                $event->types[] = StructuredJson::class;
        });
    }

    private function processJobPosting(Entry $entry)
    {
        $jobUrl = $entry->getFieldValue('jobListingUrl')->value;

        // Fetch job details from the URL
        $fetchJobHTML = $this->fetchJobHTML($jobUrl);
        $jobPageMainContent = $this->extractBodyContent($fetchJobHTML);

        if ($jobPageMainContent) {
            // Generate a cover letter via API
            $coverLetter = $this->generateCoverLetter($jobPageMainContent, $entry->title);

            // Store the cover letter in a field in Craft (assumes a `coverLetter` field)
            if ($coverLetter) {
                $entry->setFieldValue('coverLetter', $coverLetter);
                Craft::$app->getElements()->saveElement($entry);
            }
        }
    }
    /**
     * Extract and return the inner HTML of the <body> element from the given HTML.
     *
     * @param string $html The full HTML content to parse.
     * @return string|null The inner HTML of the <body> element or null if not found.
     */
    private function extractBodyContent(string $html): ?string
    {
        // Suppress any warnings or errors caused by malformed HTML
        libxml_use_internal_errors(true);

        $doc = new \DOMDocument();
        @$doc->loadHTML($html); // Load the provided HTML

        // Create an XPath object to find the <body> element
        $xpath = new \DOMXPath($doc);
        $bodyNode = $xpath->query('//body')->item(0);

        if ($bodyNode) {
            // Create a new DOMDocument for the extracted content
            $cleanDoc = new \DOMDocument();

            // Import the <body> node into the new clean document
            $importedNode = $cleanDoc->importNode($bodyNode, true);
            $cleanDoc->appendChild($importedNode);

            // Return the clean HTML of the <body>
            return $cleanDoc->saveHTML($importedNode);
        }

        // If there's no <body> element found, return null
        return null;
    }


    private function fetchJobHTML($url): ?string
    {
        // Make a request to fetch job details
        $client = Craft::createGuzzleClient();
        try {
            $response = $client->get($url);
            return (string) $response->getBody();
        } catch (\Exception $e) {
            Craft::error("Failed to fetch job details: " . $e->getMessage(), __METHOD__);
            return null;
        }
    }

    private function getChatGptPersona(): ?string
    {
        $persona = trim($this->getSettings()->persona);
        // if the text field has value - use it
        if (!empty($persona)) return $persona;
        // Return null if the field or global set doesn't exist
        return "You are a professional career assistant writing cover letters for Jeffrey Benusa, a senior web developer specializing in PHP, JavaScript, and full-stack development. 
    Jeffrey has experience in Laravel, Craft CMS, WordPress, and optimizing user experiences in e-commerce and web applications. 
    He values innovation, collaboration, and building scalable digital experiences. Only respond with the body of the cover letter";
    }

    private function getFormatting(): ?string
    {
        $formattingInstructions = "Formatting instructions:\n";

        $formattingOptions = $this->getSettings()->formatting;

        if (is_array($formattingOptions)) {
            // Extract the 'option' value from each row and implode into a list
            $optionsList = array_map(function ($row) {
                return $row[0] ?? ''; // Default to an empty string if key doesn't exist
            }, $formattingOptions);

            $formattingInstructions .= "\n\n" . implode("\n", array_filter($optionsList)); // Filter removes empty options
        }

        Craft::info($formattingInstructions, __METHOD__);
        return $formattingInstructions;
    }

    private function generateCoverLetter($jobDescription, $companyName)
    {
        $apiKey = getenv('OPENAI_API_KEY');
        if (empty($apiKey)) return false;


        try{
            $client = OpenAI::client($apiKey);
            // get the persona field value from the Settings model
            $persona = $this->getChatGptPersona();
            $formatting = $this->getFormatting();

//            $response = $client->models()->list();
//
//            $response->object; // 'list'
//
//            foreach ($response->data as $result) {
//                $result->id; // 'gpt-3.5-turbo-instruct'
//                $result->object; // 'model'
//                // ...
//            }
//
//            return $response->toArray(); // ['object' => 'list', 'data' => [...]]

            // get the text value from the single Globals and the field ChatGptPersona


            $response = $client->chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => $formatting, 'name' => 'formatting'],
                    ['role' => 'system', 'content' => $persona, 'name' => 'persona'],
                    ['role' => 'user', 'content' => "Generate a professional cover letter for a job at $companyName. Here is the full page HTML that I need you to parse through and extract the job description: $jobDescription"]
                ]
            ]);
            return $response['choices'][0]['message']['content'] ?? null;

        } catch (\Exception $e) {
            Craft::error("Failed to generate cover letter: " . $e->getMessage(), __METHOD__);
            return null;
        }
    }
}
