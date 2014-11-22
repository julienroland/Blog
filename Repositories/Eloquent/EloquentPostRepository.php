<?php namespace Blog\Repositories\Eloquent;

use Blog\Entities\Post;
use Blog\Repositories\PostRepository;
use Core\Internationalisation\Helper;
use Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPostRepository extends EloquentBaseRepository implements PostRepository
{
    /**
     * Update a resource
     * @param $post
     * @param array $data
     * @return mixed
     */
    public function update($post, $data)
    {
        $post->update($data);
        $post->tags()->sync($data['tags']);

        return $post;
    }

    /**
     * Create a blog post
     * @param array $data
     * @return Post
     */
    public function create($data)
    {
        $post = $this->model->create($data);
        $post->tags()->sync($data['tags']);

        return $post;
    }
}
