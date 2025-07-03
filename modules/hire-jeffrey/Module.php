<?php

namespace modules\hirejeffrey;

use Craft;
use craft\web\twig\variables\CraftVariable;
use modules\hirejeffrey\services\SchemaService;
use yii\base\Event;
use yii\base\Module as BaseModule;

/**
 * hire-jeffrey module
 *
 * @method static Module getInstance()
 */
class Module extends BaseModule
{
    public function init(): void
    {
        // Set alias for module path
        Craft::setAlias('@modules/hirejeffrey', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->request->isConsoleRequest) {
            $this->controllerNamespace = 'modules\\hirejeffrey\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\hirejeffrey\\controllers';
        }

        parent::init();
        
        // Register the component with a friendly name
        // Register module + component
        Craft::$app->setModule('hireJeffrey', $this);
        Craft::$app->set('hireJeffrey', SchemaService::class);
        
        // Register Twig variable
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('hireJeffrey', SchemaService::class);
            }
        );
        
        // Attach event listeners, if needed
        $this->attachEventHandlers();

        // Any code that creates an element query or loads Twig should be deferred until
        // after Craft is fully initialized, to avoid conflicts with other plugins/modules
        Craft::$app->onInit(function() {
            // ...
        });
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/5.x/extend/events.html to get started)
    }
    
    public function getSchemaService(): SchemaService
    {
        return $this->get('SchemaService');
    }
}