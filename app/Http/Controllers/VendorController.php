<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\Product;
use App\Models\Category;
use App\Models\orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File as FacadesFile;

class VendorController extends Controller
{
    public function vendreg(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|unique:users|min:10',
            'password' => 'required|min:8|string',
            'confirm_password' => 'required|same:password',
        ]);

        $users = new User();
        $users->role_as = '4';
        $users->firstname = $request->firstname;
        $users->lastname = $request->lastname;
        $users->email = $request->email;
        $users->phone_number = $request->phone_number;
        $users->password = Hash::make($request->password);
        $users->status = 0;
        $users->save();
        if ($users->save()) {
            return redirect('/bladelogin')->with('status', 'Your account has been Created Sucessfully, You can only Login once Admin Approves your account!');
        } else {
            return redirect()->back()->with('status' . 'Unable to create account for vendor');
        }

    }

    public function getprod()
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not an Admin so you can not Invite a vendor!');
            } else {
                $cate = Category::all();
                return view('vendorsfolder.uploadprod', compact('cate'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function addprod(Request $request)
    {
        if (Auth::check()) {

            $request->validate([
                'cate_id' => 'required',
                'prod_name' => 'required',
                'description' => 'required',
                'amount' => 'required',
                'quantity' => 'required',
                'prod_picture' => 'required',
            ]);

            $product = new Product();
            $product->user_id = Auth::user()->id;
            $product->cate_id = $request->cate_id;
            $product->prod_name = $request->prod_name;
            $product->descriptions = $request->description;
            $product->amount = $request->amount;
            $product->quantity = $request->quantity;
            $product->height = $request->height;
            $product->breadth = $request->breadth;
            $product->length = $request->length;
            $product->status = 0;

            if ($request->hasfile('prod_picture')) {
                $file = $request->file('prod_picture');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/products/', $filename);
                $product->prod_picture = $filename;

            }
            $product->save();
            if ($product->save()) {
                return redirect('getprod')->with('status', 'Product added successfully!');
            }

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');

        }

    }

    public function viewprod()
    {
        if (Auth::check()) {
            $prod = Product::where('user_id', Auth::user()->id)->get();

            return view('vendorsfolder.viewprod', compact('prod'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function editprod($id)
    {
        if (Auth::check()) {
            $editpro = Product::find($id);
            if (Auth::user()->id == $editpro->user_id) {
                $cate = Category::all();
                return view('vendorsfolder.editprod', compact('editpro', 'cate'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function updateprod(Request $request, $id)
    {
        if(Auth::check()){
            $update = Product::find($id);
            $update->user_id = $request->user_id;
            $update->cate_id = $request->cate_id;
            $update->prod_name = $request->prod_name;
            $update->descriptions = $request->description;
            $update->amount = $request->amount;
            $update->quantity = $request->quantity;
            // $update->status = $request->status;
            if ($request->hasfile('prod_picture') && $request->prod_picture != '') {
                $destination1 = 'uploads/products/' . $update->prod_picture;
                // dd($destination1);
                if (FacadesFile::exists($destination1)) {
                    FacadesFile::delete($destination1);
                    // return true;
                }
                $file = $request->file('profile');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $file->move('uploads/student/', $filename);
                $update->prod_picture = $filename;
            }
            // $data =  $upemp->profile;
            $update->update();
            return redirect('viewprod')->with('status', 'Product Updated!');
        }else{
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function vendorprod()
    {

        if (Auth::check()) {
            $order = order::where('vendor_id', Auth::user()->id)->get();
            foreach($order as $orders){
                $orderitem = orderitem::where('prod_id', $orders->prod_id)->first();
            }

            return view('vendorsfolder.myorders', compact('order', 'orderitem'));

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

}
