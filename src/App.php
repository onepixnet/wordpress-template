<?php

declare(strict_types=1);

namespace OnePix\WordPress;

use OnePix\WordPressContracts\ActionsRegistrar;
use OnePix\WordPressContracts\PluginLifecycleHandler;

final class App
{
    public function __construct(
        private readonly ActionsRegistrar $actionsRegistrar,
        private readonly PluginLifecycleHandler $pluginLifecycleHandler,
    ) {
    }

    public function initPluginLifecycle(): void
    {
        $this->pluginLifecycleHandler->registerActivationHook(function () {

        });

        $this->pluginLifecycleHandler->registerDeactivationHook(function () {

        });

        $this->pluginLifecycleHandler->registerUninstallHook(function () {

        });
    }

    public function run(): void
    {
        $this->actionsRegistrar->add('plugins_loaded', function (): void {
            di()->call($this->pluginsLoaded(...));
        });

        $this->actionsRegistrar->add('init', function (): void {
            di()->call($this->init(...));
        });

        $this->actionsRegistrar->add('adminMenu', function (): void {
            di()->call($this->adminMenu(...));
        });
    }

    private function pluginsLoaded(/* DI here */): void
    {
    }

    private function init(/* DI here */): void
    {
    }

    private function adminMenu(/* DI here */): void
    {

    }
}

