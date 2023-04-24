<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewAdmin()
    {   
        $user = Auth::user();
        return view('Admin', ['user' => $user]);
    }

    public function viewLoginAdmin()
    {
        // return view('Loginadmin');
        if (Auth::check() && Auth::user()->role === 'admin') {
            $user = Auth::user();
            return view('Admin', ['user' => $user]);
        } else {
            return view('Loginadmin');
        }
    }


    public function loginAdmin(Request $request)
    {
        // Kiểm tra tính hợp lệ của đầu vào
        $this->validate($request, ['email' => 'required|email',
                                'password' => 'required|min:6']);
        
        // Lấy thông tin đăng nhập từ đầu vào
        $credentials = $request->only('email', 'password');
        

        // Thực hiện đăng nhập và kiểm tra tính hợp lệ
        if (Auth::attempt($credentials, $request->remember)) {
            // Nếu đăng nhập thành công, kiểm tra vai trò của người dùng
            $user = Auth::user();
            if ($user->role === 'admin') {
                // Chuyển hướng đến trang người dùng
                // if ($request->remember) {                  
                //     auth()->user()->remember_token = Str::random(60);
                //     auth()->user()->save();
                //     Cookie::queue('remember_token', auth()->user()->remember_token, 1440);
                // }
                return redirect()->route('admin.page');
            } else {
                // Nếu vai trò không phải admin, đăng xuất và chuyển hướng đến trang đăng nhập với thông báo lỗi
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
            }
        } else {
            // Nếu đăng nhập không thành công, chuyển hướng đến trang đăng nhập và hiển thị thông báo lỗi
            return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
        }
    }


    public function logOutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/Loginadmin');
    }




    public function viewCategory()
    {   
        $user = Auth::user();
        $category = Category::orderBy('idcategory', 'asc')->get();
        return view('Category', ['user' => $user, 'category' => $category]);
    }


    public function viewProduct()
    {   
        $user = Auth::user();
        $products = Product::orderBy('idproduct', 'asc')->get();
        return view('Product', ['user' => $user, 'products' => $products]);
    }

    public function viewOrder()
    {   
        $user = Auth::user();
        $products = Product::orderBy('price', 'asc')->get();
        $cart = Cart::where('status', 1)->orderBy('updated_at', 'asc')->get();
        return view('Order', ['user' => $user, 'products' => $products, 'cart' => $cart]);
    }

    public function viewHistory()
    {   
        $user = Auth::user();
        $products = Product::orderBy('price', 'asc')->get();
        $cart = Cart::where('status', 2)->orderBy('updated_at', 'asc')->get();
        return view('History', ['user' => $user, 'products' => $products, 'cart' => $cart]);
    }

    public function addCategory(Request $request)
    {   
        $input = $request->all();
        $category = Category::create([
            'namecategory' => $input['namecategory'],
            'iconcategory' => $input['device'],
        ]);
        return back();
    }

    public function updateCategory(Request $request)
    {   
        $input = $request->all();
        // dd($input);
        $category = Category::find($input['idcategory']);
        $category->namecategory = $input['namecategory'];
        $category->iconcategory = $input['device'];
        // dd($category);
        $category->save();
        return back();
    }

    public function deleteCategory(Request $request)
    {   
        $input = $request->all();
        // dd($input);
        $category = Category::find($input['idcategory']);
        $category->delete();
        // dd($category);
        return back();
    }
}