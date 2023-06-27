<?php

namespace App\Http\Controllers;

// use mail;

use XLSXWriter;
use App\Models\role;
use App\Models\User;
use App\Models\order;
use App\Models\markets;
use App\Models\Product;
use App\Mail\surveymail;
use App\Models\Category;
use App\Models\delivery;
use App\Models\orderitem;
use App\Mail\deliverymail;
use App\Models\paidsurvey;
use App\Mail\invitevendors;
use App\Models\surveyemail;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Models\deliveryemail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App\Exports\ReportExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

// use Illuminate\Support\Facades\Response;
// use Maatwebsite\Excel\Concerns\FromArray;

class AdminController extends Controller
{
    public function admindash()
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return view('buyers.dashboard');
            } else {
                $total_userprod = Product::where('user_id', Auth::user()->id)->count();
                $buyers = User::where('role_as', 5)->count();
                $product = Product::where('status', "1")->count();
                $vendor = User::where('role_as', 4)->count();
                $completed_order = order::where('status', "1")->count();
                $uncompleted_order = order::where('status', "0")->count();
                //all orders for a particular vendor
                $order = order::where('vendor_id', Auth::user()->id)->count();
                $cate = Category::all();
                $prod = Product::where('user_id', Auth::user()->id)->get();
                return view('admin.dashboard', compact('cate', 'prod', 'total_userprod', 'buyers', 'product', 'vendor', 'completed_order', 'uncompleted_order', 'order'));
            }

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function alladmin()
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 4 || Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not the Owner of this website so you cant see the list of Admins here');
            } else {
                $admin = User::wherein('role_as', [2, 3])->get();
                return view('admin.alladmin', compact('admin'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function delete($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 1) {
                User::find($id)->delete();
                return redirect('alladmin')->with('status', 'You have successfully deleted this Admin');
            } else {
                return redirect('alladmin')->with('status', 'You are not authorize to carry out this action!');
            }

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function addvendor(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not an Admin so you can not Invite a vendor!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not an Admin so you can not Invite a vendor!');
            } else {

                $request->validate([
                    'email' => 'required|email|unique:users',
                ]);

                $vendor = new User();
                $vendor->role_as = 4;
                $vendor->firstname = '';
                $vendor->lastname = '';
                $vendor->email = $request->email;
                $vendor->phone_number = '';
                $vendor->password = Hash::make($request->email);
                $vendor->status = 1;
                $referal_link = rand() . Auth::user()->phone_number . Auth::user()->lastname;
                $vendor->referal_link = $referal_link;
                $mailContent = [
                    'content' => 'Once you login please kindly update your account with the neccessary information',
                    'email' => $request->email,
                    'password' => $request->email,
                ];
                $send = Mail::to($request->email)->send(new invitevendors($mailContent));
                if ($send) {
                    $vendor->save();
                    return redirect('vendor')->with('status', 'You have Successfully in invited' . ' ' . $request->email . ' ' . 'to come join Eko-Market as a Vendor!');
                } else {
                    return redirect('vendor')->with('status', 'Unable to send mail');
                }
                // if ($vendor->save()) {

                // }
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function adminpage()
    {

        if (Auth::check()) {
            if (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not Authorize to add admin');

            } elseif (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not Authorize to add admin');
            } else {
                $role = role::all();
                return view('admin.addadmins', compact('role'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function addadmin(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 1) {
                $request->validate([
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email|unique:users',
                    'phone_number' => 'required|unique:users|min:10',
                    'role' => 'required',
                ]);

                $admins = new User();
                $admins->firstname = $request->firstname;
                $admins->lastname = $request->lastname;
                $admins->email = $request->email;
                $admins->phone_number = $request->phone_number;
                $admins->role_as = $request->role;
                $admins->password = Hash::make($request->email);
                $admins->status = 1;
                $admins->save();
                if ($admins->save()) {
                    return redirect('/admin')->with('status', 'You have successfully added an admin');
                }
            } else {
                return redirect()->back()->with('status', 'You are not Authorize to add admin');
            }
        } else {
            return redirect('/bladelogin')->with('status', 'Please Kindly login');
        }
    }

    public function allvendor()
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not Authorize to add admin');

            } elseif (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not Authorize to add admin');
            } else {
                return view('admin.addvendor');
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function viewvendors()
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } elseif (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');

            } else {
                $vendor = User::where('role_as', 4)->get();
                return view('admin.viewvendor', compact('vendor'));
            }
        } else {
            return redirect('/bladelogin')->with('status', 'Please Kindly Login');
        }

    }

    public function approve($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } elseif (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } else {
                $update = User::where('id', $id)->update([
                    'status' => 1,
                ]);
                if ($update) {
                    return redirect('/viewvendors')->with('status', 'Vendor status have been updated successfully');

                } else {
                    return "error";
                }
            }
        } else {
            return redirect('/bladelogin')->with('status', 'Please Kindly Login');
        }
    }

    public function disapprove($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } elseif (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } else {
                $update = User::where('id', $id)->update([
                    'status' => 0,
                ]);
                if ($update) {
                    return redirect('/viewvendors')->with('status', 'You have successfully deactivated this Vendor');

                } else {
                    return "error";
                }
            }
        } else {
            return redirect('/bladelogin')->with('status', 'Please Kindly Login');
        }
    }

    public function approveprod($id){
        if (Auth::check()) {
            if (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } elseif (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } else {
                $update = Product::where('id', $id)->update([
                   'status' => 1,
                ]);
                if ($update) {
                    return redirect()->back()->with('status', 'Product have been Approved successfully');

                } else {
                    return "error";
                }
            }
        } else {
            return redirect('/bladelogin')->with('status', 'Please Kindly Login');
        }
    }

    public function disapproveprod($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } elseif (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } else {
                $update = Product::where('id', $id)->update([
                  'status' => 0,
                ]);
                if ($update) {
                    return redirect()->back()->with('status', 'Product have been Disapproved successfully');

                } else {
                    return "error";
                }
            }
        } else {
            return redirect('/bladelogin')->with('status', 'Please Kindly Login');
        }
    }

    public function allprod()
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');
            } elseif (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not Authorize to carry out this action');

            } else {
                $products = Product::all();
                return view('admin.allproducts', compact('products'));
            }
        } else {
            return redirect('/bladelogin')->with('status', 'Please Kindly Login');
        }
    }

    public function viewproducts($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $products = Product::find($id);
                // $order = orderitem::where('order_id', $id)->get();
                return view('admin.viewproducts', compact('products'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function updateproducts(Request $request, $id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $update = Product::find($id);
                $update->prod_name = $request->prod_name;
                $update->descriptions = $request->description;
                $update->amount = $request->amount;
                $update->quantity = $request->quantity;
                $update->height = $request->height;
                $update->breadth = $request->breadth;
                $update->length = $request->length;
                $update->update();
                return redirect('allprod')->with('status', 'Product Updated Successfully!');
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    //all buyers
    public function allbuyer()
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect('/buyerdash');
            } else {
                $buyer = User::where('role_as', 5)->get();
                return view('admin.allbuyer', compact('buyer'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }
//FOR ALL ORDERS
    public function orders()
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $allorders = order::where('status', 0)->get();
                return view('admin.allorder', compact('allorders'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }
    public function orderhistory()
    {
        if (Auth::check()) {

            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {

                $completeorder = order::where('status', '1')->get();
                return view('admin.complete_order', compact('completeorder'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function vieworder($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $vieworder = Order::where('id', $id)->first();
                $order = orderitem::where('order_id', $id)->get();
                return view('admin.vieworder', compact('vieworder', 'order'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function updateorder(Request $request, $id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $update = order::find($id);
                $update->status = $request->status;
                $update->update();
                return redirect('orders')->with('status', 'Status Updated Successfully!');
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function category()
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                return view('admin.addcategory');
            }

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function addcategory(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $store = new Category();
                $store->cate_name = $request->cate_name;
                $store->save();
                return redirect()->back()->with('status', 'You have successfully added Category!');
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function viewcate()
    {
        if (Auth::check()) {
            $view = Category::all();
            return view('admin.viewcategory', compact('view'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    //display all user profile details
    public function profile()
    {
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            return view('admin.profile', compact('user'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function edituser($id)
    {
        if (Auth::check()) {
            $edit = User::find($id);
            return view('admin.editprofile', compact('edit'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function updateuser(Request $request, $id)
    {
        if (Auth::check()) {
            $update = User::find($id);
            $update->firstname = $request->firstname;
            $update->lastname = $request->lastname;
            $update->email = $request->email;
            $update->phone_number = $request->phone_number;
            $update->update();
            if ($update->update()) {
                return redirect()->back()->with('status', 'User Info have been updated successfully!');
            } else {
                return redirect()->back()->with('status', 'User Info was not updated!');
            }

        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function updatepassword(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            $user = $user = $request->user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
                return redirect()->back()->with('status', 'Password have been updated successfully!');

            } else {
                return redirect()->back()->with('status', 'Old pasword does not match!');

            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    //for delivery and survey request
    public function viewdeliveryreq()
    {
        if (Auth::check()) {
            // $deliverymail = deliveryemail::where('status', 1)->get();
            $viewdelivery = delivery::where('status', 0)->get();
            return view('admin.alldeliveryreq', compact('viewdelivery'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function deliveryhistory()
    {
        if (Auth::check()) {
            $deliveryhistory = delivery::wherein('status', [1, 2, 3])->get();
            return view('admin.deliveryhistory', compact('deliveryhistory'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function viewdelivery($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $viewdelivery = delivery::where('id', $id)->first();
                $viewdeli = delivery::where('id', $id)->get();
                $market = markets::all();
                return view('admin.viewdeliverreq', compact('viewdelivery', 'viewdeli', 'market'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function update_deliverystatus(Request $request, $id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $update = delivery::find($id);
                $update->status = $request->status;
                $update->update();
                return redirect('viewdeliveryreq')->with('status', 'Status Updated Successfully!');
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function senddeliveryresp(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not an Admin so you can not Invite a vendor!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not an Admin so you can not Invite a vendor!');
            } else {

                $request->validate([
                    'client_email' => 'required',
                    'pickup_no' => 'required',
                    'delivery_package' => 'required',
                ]);
                // dd($request->client_email);
                $deliverymail = new deliveryemail();
                $deliverymail->user_id = Auth::user()->id;
                $deliverymail->client_email = $request->client_email;
                $deliverymail->pickup_no = $request->pickup_no;
                $deliverymail->delivery_package = $request->delivery_package;
                $deliverymail->box_no = $request->box_no;
                $deliverymail->box_size = $request->box_size;
                $deliverymail->extrabox_no = $request->extrabox_no;
                $deliverymail->extra_box = $request->extra_box;
                $deliverymail->distance_km = $request->distance_km;
                $deliverymail->dimensional_w = $request->dimensional_w;
                //with companys packaging total price
                $nofboxsize = $request->box_no * $request->box_size;
                $extraboxno = $request->extrabox_no * $request->extra_box;
                $total = 0;
                if ($request->box_size == 1950) {
                    $distance = 40 * $request->distance_km;
                } elseif ($request->box_size == 2900) {
                    $distance = 60 * $request->distance_km;
                } elseif ($request->box_size == 4300) {
                    $distance = 100 * $request->distance_km;
                }

                //for getting customers package total
                if ($request->dimensional_w < 2) {
                    $dw = $request->dimensional_w * 850;
                } elseif ($request->dimensional_w >= 2) {
                    $dw = $request->dimensional_w * 400;
                } elseif ($request->dimensional_w >= 7) {
                    $dw = $request->dimensional_w * 250;
                }

                //for getting distance charge of customer package
                if ($request->dimensional_w < 2) {
                    $distancecharge = 40 * $request->distance_km;
                } elseif ($request->dimensional_w >= 2) {
                    $distancecharge = 60 * $request->distance_km;
                } elseif ($request->dimensional_w >= 7) {
                    $distancecharge = 100 * $request->distance_km;
                }

                if ($request->delivery_package == 'Companys Packaging') {
                    $total += $nofboxsize + $distance + $extraboxno;
                } else {
                    $total += $dw + $distancecharge;
                }

                if ($request->delivery_package == 'Companys Packaging') {
                    $deliveryMail = [
                        'pickup points no' => $request->pickup_no,
                        'delivery package' => $request->delivery_package,
                        'no of box' => $request->box_no,
                        'box size' => $request->box_size,
                        'no of extrabox' => $request->extrabox_no,
                        'extra box' => $request->extra_box,
                        'distance kilometer' => $request->distance_km,
                        'dimentional wieght' => $request->dimensional_w,
                        'content' => 'Please kindly visit your dashboard to make payment for this delivery request so we can dispatch your product',
                        'total' => 'The total amount you are paying before your goods will be delivered is' . ' ' . $total,
                    ];
                    $send = Mail::to($request->client_email)->send(new deliverymail($deliveryMail));
                    if ($send) {
                        $deliverymail->total_price = $total;
                        $deliverymail->save();
                        return redirect('allsentdeliveryemail')->with('status', 'You have Successfully send a delivery response to' . ' ' . $request->client_email);
                    } else {
                        return redirect('allsentdeliveryemail')->with('status', 'Unable to send mail');
                    }
                } elseif ($request->delivery_package == 'Customers Packaging') {
                    $deliveryMail = [
                        'pickup points no' => $request->pickup_no,
                        'delivery package' => $request->delivery_package,
                        'distance kilometer' => $request->distance_km,
                        'dimentional wieght' => $request->dimensional_w,
                        'content' => 'Please kindly visit your dashboard to make payment for this delivery request so we can dispatch your product',
                        'total' => 'The total amount you are paying before your goods will be delivered is' . ' ' . $total,
                    ];
                    $send = Mail::to($request->client_email)->send(new deliverymail($deliveryMail));
                    if ($send) {
                        $deliverymail->save();
                        return redirect('viewdeliveryreq')->with('status', 'You have Successfully send a survey response to' . ' ' . $request->client_email);
                    } else {
                        return redirect('viewdeliveryreq')->with('status', 'Unable to send mail');
                    }
                }

                // if ($vendor->save()) {

                // }
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function allsentdeliveryemail()
    {
        if (Auth::check()) {
            $sentemail = deliveryemail::all();
            return view('admin.deliverysentemail', compact('sentemail'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly login');
        }

    }

    public function viewsurveyreq()
    {
        if (Auth::check()) {
            $viewsurvey = paidsurvey::where('status', 0)->get();
            return view('admin.allsurvey', compact('viewsurvey'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }

    }

    public function surveyhistory()
    {
        if (Auth::check()) {
            $surveyhistory = paidsurvey::wherein('status', [1, 2, 3])->get();
            return view('admin.surveyhistory', compact('surveyhistory'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function viewsurvey($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $viewsurvey = paidsurvey::where('id', $id)->first();
                $viewsurv = paidsurvey::where('id', $id)->get();
                $market = markets::all();
                return view('admin.viewsurveyreq', compact('viewsurvey', 'viewsurv', 'market'));
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function update_surveystatus(Request $request, $id)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not authorize to carry out this action!');
            } else {
                $update = paidsurvey::find($id);
                $update->status = $request->status;
                $update->update();
                return redirect('viewsurveyreq')->with('status', 'Status Updated Successfully!');
            }
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly Login!');
        }
    }

    public function sendsurveyresp(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role_as == 5) {
                return redirect()->back()->with('status', 'You are not an Admin so you can not Invite a vendor!');
            } elseif (Auth::user()->role_as == 4) {
                return redirect()->back()->with('status', 'You are not an Admin so you can not Invite a vendor!');
            } else {
                $request->validate([
                    'client_email' => 'required',
                    'product_no' => 'required',
                    'product_name' => 'required',
                    'market_name' => 'required',
                    'description' => 'required',
                ]);
                // dd($request->client_email);
                $surveymail = new surveyemail();
                $surveymail->user_id = Auth::user()->id;
                $surveymail->client_email = $request->client_email;
                $surveymail->product_no = $request->product_no;
                $surveymail->product_name = $request->product_name;
                $surveymail->market_name = $request->market_name;
                $surveymail->description = $request->description;
                $surveyMail = [
                    'product no' => $request->product_no,
                    'product name' => $request->product_name,
                    'market name' => $request->market_name,
                    'description' => $request->description,
                ];
                $send = Mail::to($request->client_email)->send(new surveymail($surveyMail));
                if ($send) {
                    $surveymail->save();
                    return redirect('allsentsurveyemail')->with('status', 'You have Successfully send a survey response to' . ' ' . $request->client_email);
                } else {
                    return redirect('allsentsurveyemail')->with('status', 'Unable to send mail');
                }
                // if ($vendor->save()) {

                // }
            }
        } else {
            return redirect('bladelogin')->with('success', 'Please kindly Login!');
        }
    }

    public function allsentsurveyemail()
    {
        if (Auth::check()) {
            $surveyemail = surveyemail::all();
            return view('admin.surveysentemail', compact('surveyemail'));
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly login');
        }
    }

    public function reports()
    {
        if (Auth::check()) {
            return view('admin.report');
        } else {
            return redirect('bladelogin')->with('status', 'Please kindly login');
        }

    }

        public function generatereports(Request $request)
    {
        $date = $request->input('date');
        $cate = $request->input('category');
        $fileName = 'Reports-' . $date . '.xlsx';

        return Excel::download(new ReportExport($date,$cate), $fileName);

    }

}
