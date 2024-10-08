<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard() {
        $userCount = User::count();
        $productCount = Product::count();
        $adminCount = Admin::count();
        $saleCount = Sale::count();

        return view('admin.dashboard', compact('userCount', 'productCount', 'adminCount', 'saleCount'));
    }



    // Admin
    public function loginAdmin() {
        return view('middleware.loginAdmin');
    }

    public function login_prosesAdmin(Request $request) {
        $credentials = $request->only('email', 'password');

        $remember = $request->has('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Email or password is incorrect.']);
    }

    public function registerAdmin() {
        return view('middleware.registerAdmin');
    }

    public function register_prosesAdmin(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('loginAdmin');
    }

    public function logoutAdmin() {
        Log::info('Admin logged out: ' . Auth::guard('admin')->user()->email);
        Auth::guard('admin')->logout();
        return redirect()->route('loginAdmin')->with('success', 'You have Successfully Logged Out');
    }



    // User
    public function userData() {
        $data = User::get();

        return view('admin.userData', compact('data'));
    }

    public function createUser() {
        return view('admin.userCreate');
    }

    public function prosesCreateUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'Confirm password does not match',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('adminPage.userData');
    }

    public function editUser(Request $request,$id) {
        $data = User::find($id);

        return view('admin.userEdit',compact('data'));
    }

    public function updateUser(Request $request,$id) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'nullable',
        ], [
            'password.confirmed' => 'nullable',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['name'] = $request->username;
        $data['email'] = $request->email;
        if($request->password) {$data['password'] = Hash::make($request->password);}

        User::whereId($id)->update($data);

        return redirect()->route('adminPage.userData');
    }

    public function deleteUser($id) {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('adminPage.userData')->with('success', 'Product deleted successfully');
    }

    public function historyUser() {
        $data = User::onlyTrashed()->get();
        return view('admin.userHistory', compact('data'));
    }

    public function restoreUser($id) {
        $data = User::withTrashed()->findOrFail($id);
        $data->restore();

        return redirect()->route('adminPage.userData.historyUser', ['id' => $id])->with('success', 'Product restored successfully');
    }

    public function forceDeleteUser($id) {
        $data = User::withTrashed()->findOrFail($id);
        $data->forceDelete();

        return redirect()->route('adminPage.userData.historyUser', ['id' => $id])->with('success', 'Product permanently deleted');
    }



    // Product
    public function product() {
        $products = Product::get();

        return view('admin.productData', compact('products'));
    }

    public function createProduct() {
        return view('admin.productCreate');
    }

    public function prosesCreateProduct(Request $request) {
        $validator = Validator::make($request->all(), [
            'addimage' => 'required|image|max:2048',
            'nameImage' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
        ], [
            'addimage.required' => 'Image is required',
            'nameImage.required' => 'Name Image is required',
            'description.required' => 'Description is required',
            'price.required' => 'Price is required',
            'stock.required' => 'Stock is required',
            'category.required' => 'Category is required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($request->hasFile('addimage')) {
            $imageName = time().'.'.$request->addimage->extension();
            $request->addimage->move(public_path('storage/products'), $imageName);
        }

        $data = [
            'image' => $imageName,
            'name' => $request->nameImage,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
        ];

        Product::create($data);

        return redirect()->route('adminPage.product')->with(['success' => 'Product successfully added!']);
    }

    public function editProduct(Request $request,$id) {
        $data = Product::find($id);

        return view('admin.productEdit',compact('data'));
    }

    public function updateProduct(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'addimage' => 'nullable|image|max:2048',
            'nameImage' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'category' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $product = Product::findOrFail($id);

        $data = [
            'name' => $request->nameImage,
            'description' => $request->description,
        ];

        if ($request->price) {
            $data['price'] = $request->price;
        }

        if ($request->stock) {
            $data['stock'] = $request->stock;
        }

        if ($request->category) {
            $data['category'] = $request->category;
        }

        if ($request->hasFile('addimage')) {
            if ($product->image && file_exists(public_path('storage/products/' . $product->image))) {
                unlink(public_path('storage/products/' . $product->image));
            }
            $imageName = time().'.'.$request->addimage->extension();
            $request->addimage->move(public_path('storage/products'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        return redirect()->route('adminPage.product')->with('success', 'Product successfully updated!');
    }

    public function deleteProduct($id) {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('adminPage.product')->with('success', 'Product deleted successfully');
    }

    public function historyProduct() {
        $products = Product::onlyTrashed()->get();
        return view('admin.productHistory', compact('products'));
    }

    public function restoreProduct($id) {
        $products = Product::withTrashed()->findOrFail($id);
        $products->restore();

        return redirect()->route('adminPage.product.historyProduct', ['id' => $id])->with('success', 'Product restored successfully');
    }

    public function forceDeleteProduct($id) {
        $products = Product::withTrashed()->findOrFail($id);

        if ($products->image) {
            $imagePath = public_path('storage/products/' . $products->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $products->forceDelete();

        return redirect()->route('adminPage.product.historyProduct', ['id' => $id])->with('success', 'Product permanently deleted');
    }



    // Sale
    public function sale() {
        $sales = Sale::with(['user', 'product'])->get();

        return view('admin.saleData', compact('sales'));
    }
}
