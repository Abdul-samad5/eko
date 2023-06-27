<?php

namespace App\Http\Controllers;

// use cart;
use App\Models\cart;
use App\Models\delivery;
use App\Models\deliveryemail;
use App\Models\markets;
use App\Models\order;
use App\Models\orderitem;
use App\Models\paidsurvey;
use App\Models\Product;
use App\Models\survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyersController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $products = Product::where('status', 1)->take(10)->get();
            return view('buyers.dashboard', compact('products'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function allproducts()
    {
        if (Auth::check()) {
            $allprod = Product::where('status', 1)->get();
            return view('buyers.allproduct', compact('allprod'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');

        }
    }

    public function view_prod($id)
    {
        if (Auth::check()) {
            if (Product::where('id', $id)->exists()) {
                $showprod = Product::where('id', $id)->first();
                return view('buyers.showprod', compact('showprod'));
            }

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');

        }
    }

    //for cart

    public function addToCart(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->prod_id;
            $prod_qty = $request->quantity;
            $prod_check = Product::where("id", $prod_id)->first();
            if ($prod_check) {
                if (cart::where("prod_id", $prod_id)->where('user_id', Auth::user()->id)->exists()) {
                    return redirect()->back()->with('status', $prod_check->prod_name . ' ' . 'Already added to Cart');
                    // return response()->json(['status' => $prod_check->prod_name . ' ' . 'Already added to Cart']);
                } else {
                    $cart = new cart();
                    $cart->user_id = Auth::user()->id;
                    $cart->prod_id = $prod_id;
                    $cart->prod_qty = $prod_qty;
                    $cart->save();
                    return redirect()->back()->with('status', $prod_check->prod_name . ' ' . 'Added to Cart');
                }
            }

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');

        }
    }

    public function cartlist()
    {
        if (Auth::check()) {
            $cart = cart::where('user_id', Auth::user()->id)->get();
            return view('buyers.viewcart', compact('cart'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function updatecart(Request $request)
    {
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');

        if (Auth::check()) {
            if (cart::where('prod_id', $prod_id)->where('user_id', Auth::user()->id)->exists()) {
                $cart = cart::where('prod_id', $prod_id)->where('user_id', Auth::user()->id)->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => 'Quantity Updated!']);
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function deletcart(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('prod_id');
            if (cart::where('prod_id', $prod_id)->where('user_id', Auth::user()->id)->exists()) {
                $deletecart = cart::where('prod_id', $prod_id)->where('user_id', Auth::user()->id)->first();
                $deletecart->delete();
                return response()->json(['status' => 'Product Successfully Removed from cart']);
            } else {
                return response()->json(['status' => 'Product Id not found!']);

            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    //for checkout
    public function checkout()
    {
        if (Auth::check()) {
            $old_cart = cart::where('user_id', Auth::user()->id)->get();
            foreach ($old_cart as $cart) {
                if (!Product::where('id', $cart->prod_id)->where('quantity', '>=', $cart->prod_qty)->exists()) {
                    $removecart = cart::where('user_id', Auth::user()->id)->where('prod_id', $cart->prod_id)->first();
                    $removecart->delete();
                }
                $prod = Product::where('id', $cart->prod_id)->get();
            }
            $cart_item = cart::where('user_id', Auth::user()->id)->get();

            return view('buyers.checkout', compact('cart_item'));

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function placeorder(Request $request)
    {
        if (Auth::check()) {
            if ($request->address == null) {
                return response()->json([
                    // $request->validate([ 'address' => 'required',]),
                    'status' => 'Please add your delivery address!',
                ]);
            } else {
                $carts = cart::where('user_id', Auth::user()->id)->get();
                foreach ($carts as $cart) {
                    $order = new order();
                    $order->fname = $request->fname;
                    $order->lname = $request->lname;
                    $order->email = $request->email;
                    $order->phone = $request->phone;
                    $order->address = $request->address;
                    $order->payment_mode = $request->payment_mode;
                    $order->payment_id = $request->payment_id;
                    $order->prod_id = $cart->prod_id;
                    $order->vendor_id = $cart->product->user->id;
                    $order->tracking_no = $request->email . rand(1111, 9999);

                    //calculate total price
                    $total = 0;
                    $total_price = cart::where('user_id', Auth::user()->id)->get();
                    foreach ($total_price as $price) {
                        $total += $price->product->amount * $price->prod_qty;
                    }
                    $order->total_price = $total;
                    $order->user_id = Auth::user()->id;
                    $order->save();

                    $remainingqty = 0;
                    $qtyordered = cart::where('user_id', Auth::user()->id)->get();
                    foreach ($qtyordered as $qty) {
                        $remainingqty += $qty->prod_qty - $qty->product->quantity;
                    }
                    $product = product::where('id', $qty->prod_id)->decrement('quantity', $qty->prod_qty);
                    // $product->quantity = $remainingqty;
                    // $product->update();

                }

            }

            $cart = cart::where('user_id', Auth::user()->id)->get();
            foreach ($cart as $carts) {
                $orderitem = new orderitem();
                $orderitem->order_id = $order->id;
                $orderitem->prod_id = $carts->prod_id;
                $orderitem->prod_qty = $carts->prod_qty;
                $orderitem->price = $carts->product->amount;
                $orderitem->save();

            }

            $cartitem = cart::where('user_id', Auth::user()->id)->get();
            cart::destroy($cartitem);

            if ($request->payment_mode == 'Paid by Razorpay' || $request->payment_mode == 'Paid by Paypal') {
                return response()->json([
                    'status' => 'You have Successfully Placed Order!',
                ]);
            }

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');

        }
    }

    public function razorpay(Request $request)
    {
        if (Auth::check()) {
            $cart = cart::where('user_id', Auth::user()->id)->get();
            $totalprice = 0;
            foreach ($cart as $item) {
                $totalprice += $item->product->amount * $item->prod_qty;
            }

            $fname = $request->fname;
            $lname = $request->lname;
            $email = $request->email;
            $phone = $request->phone;
            $address = $request->address;

            return response()->json([
                "fname" => $fname,
                "lname" => $lname,
                "email" => $email,
                "phone" => $phone,
                "address" => $address,
                'total_price' => $totalprice,
            ]);
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }
    //for orders
    public function myorders()
    {
        if (Auth::check()) {
            $order = order::where('user_id', Auth::user()->id)->get();
            return view('buyers.myorders', compact('order'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function vieworder($id)
    {

        if (Auth::check()) {
            $order = order::where('id', $id)->where('user_id', Auth::user()->id)->first();
            $orderitem = orderitem::where('order_id', $id)->get();
            return view('buyers.vieworder', compact('order', 'orderitem'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    //for logistics/market survey
    public function getlogistics()
    {
        if (Auth::check()) {
            $market = markets::all();
            return view('buyers.logistics', compact('market'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function submitlogistics(Request $request)
    {
        if (Auth::check()) {
            $survey = new survey();
            $survey->user_id = Auth::user()->id;
            $survey->product_no = $request->product_no;
            $survey->product_name = $request->product_name;
            $survey->description = $request->description;
            $survey->location = $request->location;
            if ($request->hasfile('product_image')) {
                $file = $request->file('product_image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/receipt/', $filename);
                $survey->product_image = $filename;

            }
            if ($survey->save()) {
                return redirect('payment/' . $survey->id);
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');

        }

    }

    public function payment($id)
    {
        if (Auth::check()) {
            $getsurvey = survey::where('user_id', Auth::user()->id)->where('id', $id)->first();
            return view('buyers.payment', compact('getsurvey'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function make_payment(Request $request)
    {
        if (Auth::check()) {
            // $market = new survey();
            $store = new paidsurvey();
            if (paidsurvey::where('marketsurvey_id', $request->marketsurvey_id)->where('user_id', Auth::user()->id)->exists()) {
                return response()->json([
                    'status' => 'You Already submitted this survey!',
                ]);
            } else {
                $store->user_id = Auth::user()->id;
                $store->marketsurvey_id = $request->marketsurvey_id;
                $store->product_no = $request->product_no;
                $store->product_name = $request->product_name;
                $store->description = $request->description;
                $store->location = $request->location;
                $store->product_image = $request->product_image;
                $store->status = 0;
                $store->payment_mode = $request->payment_mode;
                $store->payment_id = $request->payment_id;
                $total = 0;
                if ($store->product_no > 2) {
                    $total += 500 * $store->product_no;
                } else {
                    $total += 1000;
                }
                $store->total_price = $total;
                $store->save();
                return response()->json([
                    'status' => 'You have successfully paid and submitted your survey, we will get back to you!',
                ]);
                // return redirect('mysurvey')->with('status', 'You have successfully paid and submitted your survey, we will get back to you');

            }

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');

        }
    }

    public function mysurvey()
    {
        if (Auth::check()) {
            $survey = paidsurvey::where('user_id', Auth::user()->id)->get();
            return view('buyers.mysurvey', compact('survey'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');

        }

    }

    // public function paywithrazor(Request $request)
    // {
    //     if (Auth::check()) {
    //         $store = new paidsurvey();
    //         $total = 0;
    //         if ($store->product_no > 2) {
    //             $total += 500 * $store->product_no;
    //         } else {
    //             $total += 1000;
    //         }
    //         // $store->total_price = $total;
    //         $email = Auth::user()->email;
    //         $phone = Auth::user()->phone_number;
    //         $user_firstname = Auth::user()->firstname;
    //         $user_lastname = Auth::user()->lastname;
    //         $marketsurvey_id = $request->marketsurvey_id;
    //         $product_no = $request->product_no;
    //         $product_name = $request->product_name;
    //         $description = $request->description;
    //         $location = $request->location;
    //         $product_image = $request->product_image;
    //         // $status = 0;
    //         // $payment_mode = $request->payment_mode;
    //         // $payment_id = $request->payment_id;

    //         return response()->json([
    //             "user_firstname" => $user_firstname,
    //             "user_lastname" => $user_lastname,
    //             "email" => $email,
    //             "phone" => $phone,
    //             "marketsurvey_id" => $marketsurvey_id,
    //             "product_no" => $product_no,
    //             "product_name" => $product_name,
    //             "description" => $description,
    //             "location" => $location,
    //             "product_image" => $product_image,
    //             'total' => $total,
    //         ]);
    //     } else {
    //         return redirect('bladelogin');
    //     }
    // }

    //for delivery request
    public function getdelivery()
    {
        if (Auth::check()) {
            $market = markets::all();
            return view('buyers.deliveryreq', compact('market'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');

        }

    }

    public function submitdeliveryreq(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'product_name' => 'required|string',
                'description' => 'required',
                'location' => 'required',
                'dealer_contact' => 'required',
                'delivery_address' => 'required',
            ]);

            $delivery = new delivery();
            $delivery->user_id = Auth::user()->id;
            $delivery->product_name = $request->product_name;
            $delivery->description = $request->description;
            $delivery->location = $request->location;
            $delivery->dealer_contact = $request->dealer_contact;
            $delivery->delivery_address = $request->delivery_address;
            // $delivery->product_receipt = $request->product_receipt;
            $delivery->product_cost = $request->product_cost;
            $delivery->delivery_method = $request->delivery_method;

            if ($request->hasfile('product_receipt')) {
                $file = $request->file('product_receipt');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/receipt/', $filename);
                $delivery->product_receipt = $filename;

            }
            $delivery->save();
            return redirect()->back()->with('status', 'Delivery Request have been submitted to Admin successfully,Check back here after 1 hour for our response!');

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function mydeliveryreq()
    {
        if (Auth::check()) {
            $delivery = delivery::where('user_id', Auth::user()->id)->get();
            return view('buyers.mydeliveryreq', compact('delivery'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    //displaying user delivery request email
    public function deliveryrequestemail()
    {
        if (Auth::check()) {
            $listdeliveryemail = deliveryemail::where('client_email', Auth::user()->email)->get();
            return view('buyers.deliveryemail', compact('listdeliveryemail'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function viewreceivedmail($id)
    {
        if (Auth::check()) {
            $receivedmail = deliveryemail::where('client_email', Auth::user()->email)->where('id', $id)->first();
            return view('buyers.viewdeliveryemail', compact('receivedmail'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function payfordelivery(Request $request)
    {
            $deliverypayment = deliveryemail::where('id',$request->id)->update([
                'payment_mode' => $request->payment_mode,
                'payment_id' => $request->payment_id,
                'status' => $request->status,
            ]);

            if ($request->payment_mode == 'Paid by Paypal') {
                return response()->json([
                    'status' => 'You have Successfully Paid Your delivery Request, Your product will be delivered soon!',
                ]);
            }


    }

//for cart count
    public function cartcount()
    {
        $cartcount = cart::where('user_id', Auth::user()->id)->count();
        return response()->json([
            'count' => $cartcount,
        ]);
    }

}
