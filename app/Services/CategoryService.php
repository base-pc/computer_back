<?

namespace App\Services;
use App\Models\Category;

use \Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService
{
    public function findById($id)
    {
        $category = Category::where('id', $id)->first();

        if(!$category) {
            throw new ModelNotFoundException('Category is not found by id' );
        }
        return $category;
    }

}






?>


