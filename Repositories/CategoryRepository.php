<?php namespace Blog\Repositories;

use Core\Repositories\BaseRepository;

/**
 * Interface CategoryRepository
 * @package Blog\Repositories
 */
interface CategoryRepository extends BaseRepository
{
    /**
     * Return resources translated in the given language
     * @param $lang
     * @return mixed
     */
    public function allTranslatedIn($lang);
}
