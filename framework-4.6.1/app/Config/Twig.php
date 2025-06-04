<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Twig extends BaseConfig
{
    public string $viewsPath = APPPATH . 'Views/templates';
    public string $cachePath = WRITEPATH . 'cache/twig';
	public string $templateLayout = 'base';
    public string $templateExtension = '.twig';
    public bool $debug = ENVIRONMENT === 'development';
    public bool $autoReload = true;
}
