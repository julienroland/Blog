<?php namespace Blog\Repositories;

use Core\Repositories\BaseRepository;

/**
 * Interface TagRepository
 * @package Blog\Repositories
 */
interface TagRepository extends BaseRepository
{
    /**
     * @param string $slug
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * @param $name
     * @return mixed
     */
    public function findByName($name);

    /**
     * Create the tag for the specified language
     * @param string $lang
     * @param array $name
     * @return mixed
     */
    public function createForLanguage($lang, $name);
}
