<?php namespace Site\OCDemo;

use System\Classes\PluginBase;

/**
 * OCDemo Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'OCDemo',
            'description' => 'No description provided yet...',
            'author'      => 'Site',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function registerSchedule($schedule)
    {
        $schedule->command('ocdemo:reset')->everyThirtyMinutes();
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->registerConsoleCommand('ocdemo:reset', 'Site\Console\ResetCommand');
    }
}
