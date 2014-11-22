<?php namespace Blog\Repositories\Eloquent;

use Blog\Entities\Category;
use Blog\Repositories\CategoryRepository;
use Core\Internationalisation\Helper;
use Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentCategoryRepository extends EloquentBaseRepository implements CategoryRepository
{
    /**
     * Create a category
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $this->model->create($data);
    }

    /**
     * Update a category
     * @param Category $category
     * @param array $data
     * @return mixed
     */
    public function update($category, $data)
    {
        $category->update($data);

        return $category;
    }

    /**
     * Return all categories in the given language
     * @param $lang
     * @return mixed
     */
    public function allTranslatedIn($lang)
    {
        return $this->model->whereHas('translations', function($q) use($lang)
        {
            $q->where('locale', "$lang");
        })->get();
    }
}
