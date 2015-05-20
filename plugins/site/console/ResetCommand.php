<?php namespace Site\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Exception;

use File;

use Backend\Models\User;
use Backend\Models\UserGroup;

use System\Classes\UpdateManager;
use Cms\Classes\Theme;

use Krisawzm\Embed\Models\Settings as EmbedSettings;

class ResetCommand extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'ocdemo:reset';

    /**
     * @var string The console command description.
     */
    protected $description = 'Reset the demo.';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function fire()
    {
        $lockedFile = base_path().'/.locked';

        if (File::exists($lockedFile)) {
            throw new Exception('Lockfile exists.');
        }

        File::put($lockedFile, '');

        $this->call('cache:clear');
        $this->info('Cleared cache');

        $this->down();
        $this->call('october:up');

        $this->adminPassword();
        $this->makeDemoUserGroup();

        $this->embedSettings();

        $this->resetTheme();

        File::delete($lockedFile);

        $this->info('Done');
    }

    public function down()
    {
        $manager = UpdateManager::instance()->resetNotes()->uninstall();

        foreach ($manager->getNotes() as $note) {
            $this->output->writeln($note);
        }
    }

    public function adminPassword()
    {
        $admin = User::first();
        $admin->password = 'Zwf,v9h3q%$V8YXnspD/x?z6w;K4A9[idBf4t4adeWhj8VFLw4';
        $admin->forceSave();
    }

    public function makeDemoUserGroup()
    {
        $group = UserGroup::create([
            'name'        => 'Demo',
            'code'        => 'demo',
            'description' => 'Group for demo',
            'is_new_user_default' => false,
            'permissions' => [
                'krisawzm.embed.settings'       => '1',
                'rainlab.pages.manage_pages'    => '1',
                'rainlab.pages.access_snippets' => '1',
            ],
        ]);

        $this->info('Made group');

        for ($i = 0; $i < 20; $i++) {
            $user = 'OC-Demo-'.$i;
            $user = User::create([
                'email'                 => 'demo-'.$i.'@user.tld',
                'login'                 => $user,
                'password'              => $user,
                'password_confirmation' => $user,
                'first_name'            => 'Demo',
                'last_name'             => 'User',
                'permissions'           => [],
                'is_activated'          => true
            ]);

            $user->addGroup($group);

            $this->info('Made user '.$i);
        }
    }

    public function embedSettings()
    {
        EmbedSettings::set('mode', 'all');
        EmbedSettings::set('list', '');
        EmbedSettings::set('googlemaps_api_key', 'AIzaSyCAiHStq8hmuTIM5ULIRzGGhzF-anUAA8I');
        EmbedSettings::set('soundcloud_client_id', '1eb43a5c34542f95a78cdc651f492de3');

        $this->info('Registered Embed Settings');
    }

    public function resetTheme()
    {
        $active = base_path().'/themes/active/';
        $original = base_path().'/themes/oc-demo/';

        File::deleteDirectory($active);
        $this->info('Deleted active theme');

        File::copyDirectory($original, $active);
        Theme::setActiveTheme('active');
        $this->info('Copied new active theme');
    }

    /**
     * Get the console command arguments.
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
