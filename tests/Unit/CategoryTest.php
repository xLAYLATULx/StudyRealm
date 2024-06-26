<?php
 
namespace Tests\Feature;
 
use Tests\TestCase;
use App\Models\Category;
 
class CategoryTest extends TestCase
{

    /* Models */
    public function testCreateCategory()
    {
        $testData = [
            'userID' => 1,
            'categoryName' => 'Test Category',
        ];
        $category = Category::create($testData);
        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals($testData['userID'], $category->userID);
        $this->assertEquals($testData['categoryName'], $category->categoryName);
        $category->delete();
    }

    public function testGetCategories()
    {
        Category::factory()->create(['userID' => '1', 'categoryName' => 'Category 1']);
        Category::factory()->create(['userID' => '1', 'categoryName' => 'Category 2']);
        $categories = Category::all();
        $this->assertCount(2, $categories);
        $categories->each->delete();
    }

    /* Controllers */
    public function testEditCategory(){
        $category = Category::factory()->create(['userID' => '1', 'categoryName' => 'Category 1']);
        $categoryID = Category::find($category->id);
        $categoryID->update(['categoryName' => 'Category 2']);
        $category = Category::find($category->id);
        $this->assertEquals('Category 2', $category->categoryName);
        $category->delete();
    }

    public function testDeleteCategory(){
        $category = Category::factory()->create(['userID' => '1', 'categoryName' => 'Category 1']);
        $categoryID = Category::find($category->id);
        $categoryID->delete();
        $category = Category::find($category->id);
        $this->assertNull($category);
    }

    public function testGetCategory(){
        $category = Category::factory()->create(['userID' => '1', 'categoryName' => 'Category 1']);
        $categoryID = Category::find($category->id);
        $this->assertEquals('Category 1', $categoryID->categoryName);
        $category->delete();
    }
}