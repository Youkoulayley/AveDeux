<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;

/**
 * Class CategoryRepository.
 */
class CategoryRepository
{
    protected $category;

    /**
     * CategoryRepository constructor.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get all categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllCategories()
    {
        return $this->category::orderBy('name')->get();
    }

    /**
     * Get category by ID.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getCategoryByID($id)
    {
        return $this->category::where('id', '=', $id)->first();
    }

    /**
     * Get category by Name.
     *
     * @param $name
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getCategoryByName($name)
    {
        return $this->category::where('name', '=', $name)->first();
    }
}
