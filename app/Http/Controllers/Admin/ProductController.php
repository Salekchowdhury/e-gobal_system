<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Innersubcategory;
use App\Models\ProductImages;
use App\Models\Attribute;
use App\Models\Variation;
use App\Models\Brand;
use App\Models\VendorProduct;
use Auth;
use Stripe\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_product_show()
    {
        // dd('jj');
        // $data = Products::with('user')->orderBy('id', 'DESC')->paginate(10);
        $data = VendorProduct::with('user')->orderBy('id', 'DESC')->get();
        // dd($data);
        return view('Admin.products.admin_product_show',compact('data'));
    }
    public function admin_search(Request $request)
    {
        $data=Products::where('product_name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.products.admin_product_show',compact('data'));
    }

    public function index()
    {
        $data=VendorProduct::with(['category','variation'])->with('subcategory')->where('vendor_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
    //    dd($data);
        return view('Admin.products.index',compact('data'));
    }

    public function add()
    {

    	$data=Category::select('id','category_name')->where('status','1')->get();
        $attribute=Attribute::select('id','attribute')->where('status','1')->get();
        $brands=Brand::select('id','brand_name')->where('status','1')->get();
        return view('Admin.products.add',compact('data','attribute','brands'));
    }


       public function addProductSearch(Request $request)
    {
         if($request->ajax()){
             $searchData = Products::where('product_name','LIKE', $request->name.'%')->get();

             // dd($searchData);

             // $searchData = User::where('name','LIKE', $request->name.'%')->with('stockiest')->get();

             $output = '';

             if(count($searchData)> 0){
             $output = '<ul class="list-group" style="display:block; position:relative; z-index:1">';

                 foreach($searchData as $data){
                     $output .= '<li class="product-id list-group-item" value="'.$data->id.'"> '.$data->product_name.'</li>';
                 }

             $output .= '</ul>';
             }

         }
     return $output;
 }
    public function list()
    {
        $data = Products::with('category')->with('subcategory')->with('innersubcategory')->where('vendor_id',Auth::user()->id)->get();
        return view('Admin.products.productstable',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data=Products::where('product_name', 'LIKE', '%' . $request->search . '%')->where('vendor_id',Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        return view('Admin.products.index',compact('data'));

    }
    public function searchById(Request $request)
    {
        if($request->ajax()){
            // $id = $request->user_id;

             $product_name = Products::where('id',$request->product_id)->select('product_name')->get();

             if($product_name){
                return response()->json([
                    'status'=>200,
                    'data'=>$product_name ,
                 ]);
             }

          }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->is_variation == "on") {
            $this->validate($request,[
                'available_stock' => 'required',
                'product_type' => 'required',
                'sku' => 'required',
                'product_name' => 'required',
                'description' => 'required',
                'attribute' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg',
                'variation.*' => 'required',
                'price.*' => 'required',
                'discounted_variation_price.*' => 'required',
                'qty.*' => 'required',
            ]);
            $is_variation = 1;

            $product_price = $request->price[0];
            $discounted_price = $request->discounted_variation_price[0];

        } else {
            $this->validate($request,[
                'available_stock' => 'required',
                'product_type' => 'required',
                'sku' => 'required',
                'cat_id' => 'required',
                'subcat_id' => 'required',
                'innersubcat_id' => 'required',
                'product_name' => 'required',
                'product_price' => 'required',
                'product_qty' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg',
                'description' => 'required',
            ]);
            $is_variation = 0;

            $product_price = $request->product_price;
            $discounted_price = $request->discounted_price;

        }

        if ($request->free_shipping == "on") {
            $free_shipping = 1;
        } else {
            $free_shipping = 2;
        }

        if ($request->is_hot == "on") {
            $is_hot = 1;
        } else {
            $is_hot = 2;
        }

        if ($request->flat_rate == "on") {
            $this->validate($request,[
                'shipping_cost' => 'required'
            ]);
            $shipping_cost = $request->shipping_cost;
            $flat_rate = 1;
        } else {
            $shipping_cost = 0;
            $flat_rate = 2;
        }

        if ($request->is_return == "on") {
            $this->validate($request,[
                'return_days' => 'required'
            ]);
            $return_days = $request->return_days;
            $is_return = 1;
        } else {
            $return_days = 0;
            $is_return = 2;
        }

        if ($request->is_featured == "is_featured") {
            $is_featured = 1;
        } else {
            $is_featured = 2;
        }

        // if ($request->product_qty == "on") {
        //     $product_qty = $request->product_qty;
        // } else {
        //     $product_qty = 2;
        // }

        $product_qty = $request->product_qty;

        if ($request->tags == "") {
            $tags = "";
        } else {
            $tags = implode(', ', $request->tags);
        }

        // dd($request->product_id);

        if(!empty($request->product_id)){
            // echo 'productvebdor';
            // dd($request->product_id);

          $prdct_slug=$request->product_name."-".Auth::user()->id;
          $dataval=array(
            'vendor_id'=>Auth::user()->id,
            'product_id'=>$request->product_id,
            'cat_id'=>$request->cat_id,
            'subcat_id'=>$request->subcat_id,
            'innersubcat_id'=>$request->innersubcat_id,
            'product_name'=>$request->product_name,
            'brand'=>$request->brand,
            'description'=>$request->description,
            'product_price'=>$product_price,
            'discounted_price'=>$discounted_price,
            'slug'=>\Str::slug($prdct_slug),
            'is_variation'=>$is_variation,
            'attribute'=>$request->attribute,
            'product_qty'=>$product_qty,
            'is_hot'=>$is_hot,
            'free_shipping'=>$free_shipping,
            'flat_rate'=>$flat_rate,
            'shipping_cost'=>$shipping_cost,
            'is_return'=>$is_return,
            'return_days'=>$return_days,
            'is_featured'=>$is_featured,
            'available_stock'=>$request->available_stock,
            'sku'=>$request->sku,
            'est_shipping_days'=>$request->est_shipping_days,
            'tax'=>$request->tax,
            'tax_type'=>$request->tax_type,
            'product_type'=>$request->product_type,
            'tags'=>$tags,
        );

            // dd($dataval);
            $vendorProductData = VendorProduct::create($dataval);
        }else{
            $dataval=array(
                'vendor_id'=>Auth::user()->id,
                'cat_id'=>$request->cat_id,
                'subcat_id'=>$request->subcat_id,
                'innersubcat_id'=>$request->innersubcat_id,
                'product_name'=>$request->product_name,
                'brand'=>$request->brand,
                'description'=>$request->description,
                'product_price'=>$product_price,
                'discounted_price'=>$discounted_price,
                'slug'=>\Str::slug($request->product_name),
                'is_variation'=>$is_variation,
                'attribute'=>$request->attribute,
                'product_qty'=>$product_qty,
                'is_hot'=>$is_hot,
                'free_shipping'=>$free_shipping,
                'flat_rate'=>$flat_rate,
                'shipping_cost'=>$shipping_cost,
                'is_return'=>$is_return,
                'return_days'=>$return_days,
                'is_featured'=>$is_featured,
                'available_stock'=>$request->available_stock,
                'sku'=>$request->sku,
                'est_shipping_days'=>$request->est_shipping_days,
                'tax'=>$request->tax,
                'tax_type'=>$request->tax_type,
                'product_type'=>$request->product_type,
                'tags'=>$tags,
            );

            $data=Products::create($dataval);
            // dd($data);

             //insert in product vendor

             $vendorProductData=array(
                'vendor_id'=>Auth::user()->id,
                'product_id'=>$data->id,
                'cat_id'=>$request->cat_id,
                'subcat_id'=>$request->subcat_id,
                'innersubcat_id'=>$request->innersubcat_id,
                'product_name'=>$request->product_name,
                'brand'=>$request->brand,
                'description'=>$request->description,
                'product_price'=>$product_price,
                'discounted_price'=>$discounted_price,
                'slug'=>\Str::slug($request->product_name),
                'is_variation'=>$is_variation,
                'attribute'=>$request->attribute,
                'product_qty'=>$product_qty,
                'is_hot'=>$is_hot,
                'free_shipping'=>$free_shipping,
                'flat_rate'=>$flat_rate,
                'shipping_cost'=>$shipping_cost,
                'is_return'=>$is_return,
                'return_days'=>$return_days,
                'is_featured'=>$is_featured,
                'available_stock'=>$request->available_stock,
                'sku'=>$request->sku,
                'est_shipping_days'=>$request->est_shipping_days,
                'tax'=>$request->tax,
                'tax_type'=>$request->tax_type,
                'product_type'=>$request->product_type,
                'tags'=>$tags,
            );
            $vendorProductData = VendorProduct::create($vendorProductData);
        }

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            $product_id = $vendorProductData->product_id;
            foreach($files as $file){
                $productimage = new ProductImages;
                $image = 'product-' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move('storage/app/public/images/products', $image);
                 if(!empty($request->product_id)){
                    $productimage->product_id =$request->product_id;
                 }else{
                     $productimage->product_id =$product_id;

                 }
                $productimage->vendor_product_id =$vendorProductData->id;
                $productimage->image =$image;
                $productimage->save();
            }
        }

        if ($is_variation == 1) {
            $vendor_product_id = $vendorProductData->id;
            $product_id = $vendorProductData->product_id;
            // dd($vendor_product_id);
            $variation = $request->variation;
            $price = $request->price;
            $discounted_variation_price = $request->discounted_variation_price;
            $qty= $request->qty;

            foreach($price as $i => $no)
            {
                if(!empty($request->product_id)){
                    $input['product_id'] =$request->product_id;
                }else{
                    $input['product_id'] =$product_id;

                }
                $input['vendor_product_id'] =  $vendor_product_id;
                $input['price'] = $no;
                $input['discounted_variation_price'] = $discounted_variation_price[$i];
                $input['variation'] = $variation[$i];
                $input['qty'] = $qty[$i];

                Variation::create($input);
            }
        }

        if ($vendorProductData) {
             return redirect('admin/products')->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        // <!-- $data=Products::where('vendor_id',Auth::user()->id)->find($id); -->
        $data=VendorProduct::where('vendor_id',Auth::user()->id)->find($id);
        // dd($data);
        $category=Category::select('id','category_name')->where('status','1')->get();
        $subcategory=Subcategory::select('id','subcategory_name')->where('status','1')->get();
        $innersubcategory=Innersubcategory::select('id','innersubcategory_name')->where('status','1')->get();
        $attribute=Attribute::select('id','attribute')->where('status','1')->get();
        $images=ProductImages::select('id','product_id',\DB::raw("CONCAT('".url('/storage/app/public/images/products/')."/', image) AS image_url"))->where('product_id',$id)->get();
        $brands=Brand::select('id','brand_name')->where('status','1')->get();
        $variations=Variation::where('product_id',$id)->get();
        return view('Admin.products.show',compact('data','category','subcategory','innersubcategory','attribute','images','brands','variations'));
    }

    public function showimage(Request $request)
    {
        $getitem = ProductImages::where('id',$request->id)->first();
        if($getitem->image){
            $getitem->img=url('storage/app/public/images/products/'.$getitem->image);
        }
        return response()->json(['ResponseCode' => 1, 'ResponseData' => $getitem], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd('ddd');
        if ($request->is_variation == "1") {
            if ($request->variation == null) {
                return redirect()->back()->with('danger', trans('messages.please_add_variation'));
            }
            $this->validate($request,[
                'cat_id' => 'required',
                'available_stock' => 'required',
                'sku' => 'required',
                'subcat_id' => 'required',
                'innersubcat_id' => 'required',
                'product_name' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg',
                'variation.*' => 'required',
                'price.*' => 'required',
                'qty.*' => 'required',
            ]);

            $product_price = $request->price[0];
            if ($request->discounted_variation_price[0] == null) {
                $discounted_price = 0;
            } else {
                $discounted_price = $request->discounted_variation_price[0];
            }


            $variation = $request->variation;
            $price = $request->price;
            $discounted_variation_price = $request->discounted_variation_price;
            $qty= $request->qty;

            if (is_array($variation) || is_object($variation)) {
                foreach($variation as $i => $no)
                {
                    if ($no != "") {
                        if ($discounted_variation_price[$i] == null) {
                            $dic_price = 0;
                        } else {
                            $dic_price = $discounted_variation_price[$i];
                        }
                        $input['price'] = $price[$i];
                        $input['discounted_variation_price'] = $dic_price;
                        $input['variation'] = $variation[$i];
                        $input['qty'] = $qty[$i];

                        if (isset($request->variation_id[$i])) {
                            $product=Variation::where('id',$request->variation_id[$i])->update($input);
                        } else {
                            $input['product_id'] =$request->product_id;

                            Variation::create($input);
                        }
                    }
                }
            }
        } else {
            $this->validate($request,[
                'cat_id' => 'required',
                'subcat_id' => 'required',
                'innersubcat_id' => 'required',
                'available_stock' => 'required',
                'product_name' => 'required',
                'sku' => 'required',
                'product_price' => 'required',
                'product_qty' => 'required',
                'product_type' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg',
            ]);
            $product_price = $request->product_price;
            $product_qty = $request->product_qty;

            if ($request->discounted_price == null) {
                $discounted_price = 0;
            } else {
                $discounted_price = $request->discounted_price;
            }
            $dlt=Variation::where('product_id',$request->product_id)->delete();
        }

        if ($request->free_shipping == "1") {
            $free_shipping = 1;
        } else {
            $free_shipping = 2;
        }

        if ($request->is_hot == "1") {
            $is_hot = 1;
        } else {
            $is_hot = 2;
        }

        if ($request->flat_rate == "1") {
            $this->validate($request,[
                'shipping_cost' => 'required'
            ]);
            $shipping_cost = $request->shipping_cost;
            $flat_rate = 1;
        } else {
            $shipping_cost = 0;
            $flat_rate = 2;
        }

        if ($request->is_return == "1") {
            $this->validate($request,[
                'return_days' => 'required'
            ]);
            $return_days = $request->return_days;
            $is_return = 1;
        } else {
            $return_days = 0;
            $is_return = 2;
        }

        if ($request->is_featured == "1") {
            $is_featured = 1;
        } else {
            $is_featured = 2;
        }

        if ($request->tags == "") {
            $tags = "";
        } else {
            $tags = implode(', ', $request->tags);
        }

        $data=array(
            'vendor_id'=>Auth::user()->id,
            'cat_id'=>$request->cat_id,
            'subcat_id'=>$request->subcat_id,
            'innersubcat_id'=>$request->innersubcat_id,
            'product_name'=>$request->product_name,
            'brand'=>$request->brand,
            'description'=>$request->description,
            'product_price'=>$product_price,
            'discounted_price'=>$discounted_price,
            'product_qty'=>$product_qty,
            'product_type'=>$request->product_type,
            'slug'=>\Str::slug($request->product_name),
            'is_variation'=>$request->is_variation,
            'attribute'=>$request->attribute,
            'is_hot'=>$is_hot,
            'free_shipping'=>$free_shipping,
            'flat_rate'=>$flat_rate,
            'shipping_cost'=>$shipping_cost,
            'is_return'=>$is_return,
            'return_days'=>$return_days,
            'is_featured'=>$is_featured,
            'available_stock'=>$request->available_stock,
            'sku'=>$request->sku,
            'est_shipping_days'=>$request->est_shipping_days,
            'tax'=>$request->tax,
            'tax_type'=>$request->tax_type,
            'tags'=>$tags,
        );

        // $product=Products::find($request->product_id)->update($data);
        $product=VendorProduct::find($request->product_id)->update($data);

        if ($product) {
            return redirect('admin/products')->with('success', trans('messages.update'));
        } else {
            return redirect()->back()->with('danger', trans('messages.fail'));
        }
    }

    public function updateimage(Request $request)
    {
        $this->validate($request,[
            'image' => 'image|mimes:jpeg,png,jpg'
        ]);

        $itemimage = new ProductImages;
        $itemimage->exists = true;
        $itemimage->id = $request->id;

        if(isset($request->image)){
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image = 'product-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move('storage/app/public/images/products', $image);
                $itemimage->image=$image;
            }
        }
        $itemimage->save();

        if ($itemimage) {
            return response()->json(['ResponseCode' => 1], 200);
        } else {
            return response()->json(['ResponseCode' => 0], 200);
        }
    }

    public function storeimages(Request $request)
    {
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            foreach($files as $file){

                $productimage = new ProductImages;
                $image = 'item-' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move('storage/app/public/images/products', $image);

                $productimage->product_id =$request->pro_id;
                $productimage->image =$image;
                $productimage->save();
            }
        }

        return redirect()->back()->with('success', trans('messages.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
        ]);
        // $data=Products::where('id',$request->id)->where('vendor_id',Auth::user()->id)->delete();
        $data=VendorProduct::where('id',$request->id)->where('vendor_id',Auth::user()->id)->delete();
        if($data) {
            return 1000;
        } else {
            return 2000;
        }
    }

    public function destroyimage(Request $request)
    {
        $getitemimages = ProductImages::where('product_id', $request->product_id)->count();

        if ($getitemimages > 1) {
           $itemimage=ProductImages::where('id', $request->id)->delete();
           if ($itemimage) {
               return 1;
           } else {
               return 0;
           }
        } else {
            return 2;
        }
    }

    public function changeStatus(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'status' => 'required',
        ]);

        $data['status']=$request->status;
        Products::where('id',$request->id)->where('vendor_id',Auth::user()->id)->update($data);
        if ($data) {
            return 1000;
        } else {
            return 2000;
        }
    }

    public function subcat(Request $request)
    {
        $data=Subcategory::select('id','subcategory_name')->where('cat_id',$request->cat_id)->get();
        return json_encode($data);
    }

    public function innersubcat(Request $request)
    {
        $data=Innersubcategory::select('id','innersubcategory_name')->where('subcat_id',$request->subcat_id)->get();
        return json_encode($data);
    }

    public function editProduct(int $id)
    {
        // dd($id);
    //   $product =Products::findOrFail($id);
      $product =VendorProduct::findOrFail($id);
      return view('Admin.products.edit_product', compact('product'));

    }

    public function confirmProduct(int $id)
    {
        // dd($id);

        $product = VendorProduct::where('id',$id)->update(['approve_status' => 1]);

      if($product){

        return back()->with('message','Confirm product successfully');

    }

    }

    public function cancelProduct(int $id)
    {
        // dd($id);

        $product = VendorProduct::where('id',$id)->update(['approve_status' => 0]);

      if($product){

        return back()->with('message','Cancel product successfully');

    }

    }

    public function UpdateProduct(Request $request, $id)
    {
        // $product =Products::find($id);
        // $vendorProduct = VendorProduct::where('product_id',$id)->get();
        // if($vendorProduct){
        //          foreach($vendorProduct as $item){
        //             VendorProduct::where('id',$item->id)->update(['point' =>$request->input('point')]);
        //          }
        // }

        // $product->point = $request->input('point');
        // $product->admin_product_price = $request->input('admin_product_price');


        // VendorProduct::where('product_id',$id)->update(['admin_product_price' =>$request->input('admin_product_price')]);
        // $product->update();
        //    dd($request->all());
        $inputProduct = $request->all();
        $inputProductVendorProduct = $request->all();
        $inputProductVendorProduct['approve_status']= 1;

        $vendorProduct =VendorProduct::find($request->id);
        $product = Products::find($vendorProduct->product_id);

        $vendorProduct->update($inputProductVendorProduct);
        $product->update($inputProduct);


      if($product){

        return redirect('admin/products/admin_product_show')->with('message','updated successfully');

    }
}

}
