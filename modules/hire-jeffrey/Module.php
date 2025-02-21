<?php

namespace modules\hirejeffrey;

use Craft;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use modules\hirejeffrey\fields\StructuredJson;
use yii\base\Event;
use yii\base\Module as BaseModule;

/**
 * hire-jeffrey module
 *
 * @method static Module getInstance()
 * @property-read CookieConsentService $cookieConsentService
 */
class Module extends BaseModule
{

    public function init(): void
    {
        Craft::setAlias('@modules/hirejeffrey', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->request->isConsoleRequest) {
            $this->controllerNamespace = 'modules\\hirejeffrey\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\hirejeffrey\\controllers';
        }

        parent::init();

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
        Event::on(Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = StructuredJson::class;
            }
        );
    }
}
