<?php namespace Blog;

use Cms\Providers\BaseModuleServiceProvider;

class ServiceProvider extends BaseModuleServiceProvider
{
    protected $name = 'Blog';


    public function register()
    {
        parent::register($this->name);
    }

    public function boot()
    {
        parent::boot($this->name);
    }
}

