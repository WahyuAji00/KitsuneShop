<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index() {
        $products = Product::all();

        return view('home.index', compact('products'));
    }

    public function shop() {
        $products = Product::all();

        return view('shop.index', compact('products'));
    }

    public function detailProduct($name) {
        $products = Product::where('name', $name)->firstOrFail();

        return view('shop.detailProduk', ['products' => $products]);
    }

    public function activity() {
        return view('activity.index');
    }

    public function about() {
        return view('about.index');
    }

    public function showLoginUser()
    {
        return view('middleware.loginUser');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegisterUser()
    {
        return view('middleware.registerUser');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'password.confirmed' => 'Confirm password does not match',
            'nomor.numeric' => 'The phone number must be a number',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/login');
    }

    public function addToCart(Request $request, $id)
    {
        $products = Product::findOrFail($id);

        $existingCartItem = Cart::where('user_id', Auth::id())
                                ->where('product_id', $products->id)
                                ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $products->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function addToFavorites($id)
    {
        $products = Product::findOrFail($id);
        $user = Auth::id();

        $existingFavorite = Favorite::where('user_id', $user)->where('product_id', $products->id)->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
            $products->decrement('favorites_count');
        } else {
            Favorite::create([
                'user_id' => $user,
                'product_id' => $products->id,
            ]);
            $products->increment('favorites_count');
        };

        return response()->json([
            'success' => true,
            'favorites_count' => $products->favorites()->count(),
            'is_favorited' => $products->favorites()->where('user_id', Auth::id())->exists(),
        ]);
    }

    public function viewFavoriteProduct() {
        $userId = auth()->user()->id;

        $favoriteProducts = DB::table('favorites')
            ->join('products', 'favorites.product_id', '=', 'products.id')
            ->where('favorites.user_id', $userId)
            ->select('products.*')
            ->get();

        return view('shop.favoriteProduk', ['favoriteProducts' => $favoriteProducts]);
    }

    public function viewCartProduct() {
        $userId = auth()->user()->id;

        $cartProducts = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->select('products.*', 'carts.quantity')
            ->get();

        return view('shop.cartProduk', ['cartProducts' => $cartProducts]);
    }

    public function profileUser() {
        $user = Auth::user();

        return view('profile.profileUser', compact('user'));
    }
}
