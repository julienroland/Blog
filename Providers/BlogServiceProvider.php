<?php namespace Blog\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Blog\Entities\Category;
use Blog\Entities\Post;
use Blog\Entities\Tag;
use Blog\Repositories\Eloquent\EloquentCategoryRepository;
use Blog\Repositories\Eloquent\EloquentPostRepository;
use Blog\Repositories\Eloquent\EloquentTagRepository;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * The filters base class name.
     *
     * @var array
     */
    protected $filters = [
        'Core' => [
            'permissions' => 'PermissionFilter',
            'auth.admin' => 'AdminFilter',
        ]
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booted(function ($app) {
            $this->registerFilters($app['router']);
            $this->registerBindings();
        });
    }

    /**
     * Register the filters.
     *
     * @param  Router $router
     * @return void
     */
    public function registerFilters(Router $router)
    {
        foreach ($this->filters as $module => $filters) {
            foreach ($filters as $name => $filter) {
                $class = "{$module}\\Http\\Filters\\{$filter}";

                $router->filter($name, $class);
            }
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Blog\Repositories\PostRepository',
            function() {
                return new EloquentPostRepository(new Post);
            }
        );

        $this->app->bind(
            'Blog\Repositories\CategoryRepository',
            function() {
                return new EloquentCategoryRepository(new Category);
            }
        );

        $this->app->bind(
            'Blog\Repositories\TagRepository',
            function() {
                return new EloquentTagRepository(new Tag);
            }
        );
    }
}
