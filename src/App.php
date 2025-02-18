<?php

declare(strict_types=1);

namespace OnePix\WordPress;

use OnePix\WordPressContracts\ActionsRegistrar;

final class App
{
    public function __construct(
        private readonly ActionsRegistrar $actionsRegistrar
    )
    {
    }

    public function run(): void {
        $this->actionsRegistrar->add('plugins_loaded', $this->pluginsLoaded(...));
        $this->actionsRegistrar->add('init', $this->init(...));
        $this->actionsRegistrar->add('template_redirect', $this->templateRedirect(...));
    }

    private function pluginsLoaded(): void {
    }

    private function init(): void {
    }

    private function templateRedirect(): void {
    }
}
