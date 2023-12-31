<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function register()
    {

        return view('shop.register');
    }


    public function checkRegister(Request $request)
    {
        // $validated = $request->validate([
        //     'email' => 'required|unique:customers|email',
        //     'password' => 'required|min:6',
        // ]);
        $notifications = [
            'ok' => 'ok',
        ];
        $notification = [
            'message' => 'error',
        ];
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address =  $request->address;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->psw);
        if ($request->psw == $request->psw_repeat) {
            $customer->save();
            // dd(1);
            return redirect()->route('cart');
        } else {
            // dd(2);
            return redirect()->route('cart')->with($notification);
        }
    }

    public function login()
    {
        return view('shop.login');
    }

    public function checklogin(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::guard('customers')->attempt($arr)) {
            return redirect()->route('cart');
        } else {
            // dd(1);
            // return redirect()->route('user.login');
            return redirect()->route('shop.login') ->with('error', 'Đăng nhập thất bại, email or password không tồn tại');
        }
    }
    public function logout(){
        Auth::guard('customers')->logout();
        return redirect()->route('shop.login');
    }
    public function home(Request $request)
    {
        // $categories = Category::get();
        // $products = Product::paginate(4);

        $categories = Category::all();

        $products = Product::with('category');

        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $products->where('product_name', 'like', '%' . $keyword . '%')
                ->orwhere('status', 'like', '%' . $keyword . '%');
        }
        $products = $products->where('status',1)->orderby('id','desc')->paginate(8);
     
        return view('shop.home',compact('categories','products'));

    }

    public function detail($id)
    {
        $category = Category::find($id);
        $categories = Category::get();
        $product = Product::find($id);
        $products = Product::get();

        // Lấy các sản phẩm có liên quan (ví dụ: cùng danh mục)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '<>', $product->id) // Loại bỏ sản phẩm hiện tại
            ->inRandomOrder() // Sắp xếp ngẫu nhiên
            ->limit(4) // Giới hạn số lượng sản phẩm hiển thị
            ->get();
        return view('shop.detail', compact('categories', 'category', 'product', 'products', 'relatedProducts'));
    }




    public function cart()

    {
        $products = Product::get();

        return view('shop.cart');
    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function addToCart($id)

    {

        $product = Product::findOrFail($id);



        $cart = session()->get('cart', []);



        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;
            session()->flash('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công.');
        } else {

            $cart[$id] = [

                "product_name" => $product->product_name,

                "quantity" => 1,

                "price" => $product->price,

                "image" => $product->image

            ];
        }



        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function update(Request $request)

    {

        if ($request->id && $request->quantity) {

            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'them thanh cong');
        }
    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function remove(Request $request)

    {

        if ($request->id) {

            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'xoa sp thanh cong');
        }
    }

    public function checkout()
    {
        $categories = Category::all();
        return view('shop.checkout', compact('categories'));
    }

    public function order(Request $request)
    {
        $request->session()->flash('success', 'Đặt hàng thành công!');
        // dd($request->product_id);
        if ($request->product_id == null) {
            return redirect()->back();
        } else {
            $id = Auth::guard('customers')->user()->id;
            $customer = Customer::findOrfail($id);
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->password = bcrypt($request->password);

            if (isset($request->note)) {
                $customer->note = $request->note;
            }
            $customer->save();
            $totalAll = $request->input('total_all');

            $order = new Order();
            $order->customer_id = Auth::guard('customers')->user()->id;
            $order->date_at = date('Y-m-d H:i:s');
            $order->date_ship = date('Y-m-d H:i:s');
            $order->note = null;
           
            $order->total = null;
            // dd($order);



            $order->save();
        }
        $count_product = count($request->product_id);
        for ($i = 0; $i < $count_product; $i++) {
            $orderItem = new OrderDetail();
            $orderItem->order_id =  $order->id;
            $orderItem->product_id = $request->product_id[$i];
            $orderItem->quantity = $request->quantity[$i];
            $orderItem->total = $request->total[$i];
            $orderItem->save();
            session()->forget('cart');
            DB::table('products')
                ->where('id', '=', $orderItem->product_id)
                ->decrement('quantity', $orderItem->quantity);
        }

        $notification = [
            'message' => 'success',
        ];
        // $data = [
        //     'name' => $request->name,
        //     'pass' => $request->password,
        // ];
        // Mail::send('mail.mail', compact('data'), function ($email) use ($request) {
        //     $email->subject('Shein Shop');
        //     $email->to($request->email, $request->name);
        // });

        // dd($request);
        // alert()->success('Thêm Đơn Đặt: '.$request->name,'Thành Công');
        return redirect()->route('shop.home')->with($notification);;
        // }
        // } catch (\Exception $e) {
        //     // dd($request);
        //     Log::error($e->getMessage());
        //     // toast('Đặt hàng thấy bại!', 'error', 'top-right');
        //     return redirect()->route('shop.index');
        // }
    }
    public function showMore(Request $request)
    {
        $limit = 10; // Giá trị giới hạn (limit) của danh sách sản phẩm
    
        // Lấy danh sách sản phẩm từ cơ sở dữ liệu với giới hạn (limit) đã định nghĩa
        $products = Product::take($limit)->get();
    
        $data = [
            'products' => $products,
            'limit' => $limit
        ];
    
        return response()->json($data);
    }

}
