<?php namespace Krisawzm\Embed\DemoProvisioners;

use Krisawzm\DemoManager\Classes\DemoProvisionerInterface;
use Krisawzm\Embed\Models\Settings;

class SettingsProvisioner implements DemoProvisionerInterface
{
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        Settings::set('mode', 'all');
        Settings::set('list', '');
        Settings::set('googlemaps_api_key', 'AIzaSyCAiHStq8hmuTIM5ULIRzGGhzF-anUAA8I');
        Settings::set('soundcloud_client_id', '1eb43a5c34542f95a78cdc651f492de3');

        return true;
    }
}
