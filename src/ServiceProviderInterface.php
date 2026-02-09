<?php

namespace Framework;

use Framework\ServiceContainer;

interface ServiceProviderInterface
{
    public function register(ServiceContainer $serviceContainer): void;
}
