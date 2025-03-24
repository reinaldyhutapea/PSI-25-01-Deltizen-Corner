<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
class ProductController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $title = 'Master Product';
        $products = Product::orderBy('name','asc')->get();
        $categories = Category::orderBy('name','asc')->get();
        return view('products.index', compact('title','products','categories'));
    }
    public function create(){
        $title = 'Create Product';
        $categories = Category::orderBy('name','asc')->get();
        return view('products.index',compact('title','categories'));
    }
    public function store(Request $request){
        $input = new Product;
        $input->id=$request->id;
        $input->description=$request->description;
        $input->name=$request->name;
        $input->price=$request->price;
        $input->stock=1;
        $input->stoks=$request->stoks;
        if ($request->hasFile('image')){
            $input['image'] = '/upload/products/'.str::slug($input['name'], '-').'.'
            .$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }
        $input->category_id=$request->category_id;
        $input->save();
        return redirect()->back()->with('status','Anda berhasil menambahkan product');
    }
    public function edit($id){
        $title = 'Edit Product';
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name','asc')->get();
        return view('products.edit', compact('product', 'title','categories'));
    }
    public function update(Request $request, $id){
        $input = $request->all();
        $product = Product::findOrFail($id);  
        $input['image'] = $product->image;
        if ($request->hasFile('image')){
            if (!$product->image == NULL){
                unlink(public_path($product->image));
            }
            $input['image'] = '/upload/products/'.str::slug($input['name'], '-').'.'
            .$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }
        $product->update($input);
        return redirect()->back()->with('status','Anda berhasil mengubah data produdct');
    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        if (!$product->image == NULL){
            unlink(public_path($product->image));
        }
        Product::destroy($id);
        return redirect()->back()->with('status','Anda berhasil menghapus produk'.$product->name);
    }
    public function detail($id){
        $product = Product::findOrFail($id);
        return view('products.detail',compact('product'));
    }
   public function changeStoks ($id){
    $product = Product::findOrFail($id);
    if ($product->stoks == 0){
        $product->stoks = 1;
    }else{
        $product->stoks = 0;
    }
    $product->save();
    return redirect()->back()->with('berhasil diubah');
   }
   public function produk (){
       return view('products.index2');
   }

public function produkData (){
$data = Product::join('categories', 'products.category_id', '=', 'categories.id')
->select('products.id', 'products.name as pname', 'categories.name as cname', 'products.description',
'products.price','products.stoks', 'products.image');
return Datatables::of($data)
->addColumn('action', function ($data) {
    $actiona = '<a href="'.route('product.edit',$data->id).'" id="action" class="btn btn-xs btn-success">
    <i class="fa-solid fa-pen-to-square"></i></a>';
    $actionb = '<a href="'.route('product.detail',$data->id).'" id="action" class="btn btn-xs btn-warning" >
    <i class="fa-solid fa-circle-info"></i></a>';
    return $actiona . $actionb ;
})
->addIndexColumn()
->editColumn('image', function($data){
    return '<img src=" '.url($data->image).' "/>';
})
->editColumn('stoks', function($data){
    if ($data->stoks == 0) {
        $actiona = '<a href="'.route('change.stoks',$data->id).'" class="btn btn-xs btn-danger" >Habis</a>';        
    } else {
        $actiona = '<a href="'.route('change.stoks',$data->id).'" class="btn btn-xs btn-primary" >Ada</a>';
    }
    return $actiona;
})
->editColumn('price', function($data){
                return 'Rp. '.number_format($data->price,0).' ';
            })
->rawColumns(['image','action','stoks'])
->make(true);
}
}
