<?

namespace App\Services;
use App\Models\Category;

use \Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService
{

    public function showCategoryById($id)
    {
        $category = Category::with('products')
            ->where('id', $id)
            ->get();

        return $category;

    }

    public function storeMyCategory($data)
    {
        $category = new Category;

        $category->fill($data);

        $category->save();

    }

    public function destroyMyCategory($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

    }

}


?>


