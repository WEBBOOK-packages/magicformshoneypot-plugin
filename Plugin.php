<?php declare(strict_types=1);

namespace WebBook\MagicFormsHoneypot;

use System\Classes\PluginBase;
use Event;
use WebBook\MagicFormsHoneypot\Classes\Events\FormSubmissionHandler;
use WebBook\MagicFormsHoneypot\Components\HoneypotField;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/4.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * compatible plugins
     */
    protected array $compatiblePlugins = [
        'martin.forms',
        'blakejones.magicforms',
        'publipresse.forms',
        'webbook.forms',
    ];

    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name' => 'Magic Forms Honeypot',
            'description' => 'Dismisses bot submissions to Magic Forms using the honeypot technique.',
            'author' => 'WebBook',
            'icon' => 'icon-bolt',
            'homepage' => 'https://github.com/WEBBOOK-packages/magicformshoneypot-plugin',
        ];
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot(): void
    {
        foreach ($this->compatiblePlugins as $plugin) {
            Event::listen($plugin . '.beforeSaveRecord', FormSubmissionHandler::class);
        }
    }

    /**
     * registerComponents used by the frontend
     */
    public function registerComponents(): array
    {
        return [
            HoneypotField::class => 'honeypotField',
        ];
    }
}
