<?php
namespace App\Exports;

use App\Models\order;
use App\Models\delivery;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// class ReportExport implements FromCollection, WithHeadings, ShouldAutoSize
class ReportExport implements FromCollection, ShouldAutoSize
{
    protected $date;
    protected $cate;

    public function __construct(string $date,$cate)
    {
        $this->date = $date;
        $this->cate = $cate;
    }

    public function collection()
    {
        $data = [];
    
        if ($this->cate == 'orders') {
            $orders = Order::whereDate('created_at', $this->date)->get();
            $headers = [
                'Order ID',
                'Product Id',
                'Vendor ID',
                'Customer Name',
                'Customer Email',
                'Payment Mode',
                'Total Price',
                'Created At',
            ];
    
            $data[] = $headers;
    
            foreach ($orders as $order) {
                $data[] = [
                    $order->id,
                    $order->prod_id,
                    $order->vendor_id,
                    $order->fname,
                    $order->email,
                    $order->payment_mode,
                    $order->total_price,
                    $order->created_at,
                ];
            }
    
        } elseif ($this->cate == 'delivery') {
            $deliveries = Delivery::whereDate('created_at', $this->date)->get();
            $headers = [
                'Id',
                'Product Name',
                'Description',
                'Dealer Contact',
                'Product Cost',
                'Created at',
            ];
    
            $data[] = $headers;
    
            foreach ($deliveries as $delivery) {
                $data[] = [
                    $delivery->id,
                    $delivery->product_name,
                    $delivery->description,
                    $delivery->dealer_contact,
                    $delivery->product_cost,
                    $delivery->created_at,
                ];
            }
    
        } elseif ($this->cate == 'survey') {
            $surveys = DB::table('paidsurveys')->whereDate('created_at', $this->date)->get();
            $headers = [
                'Id',
                'Product Name',
                'Number of Product',
                'Description',
                'Payment Mode',
                'Created At',
            ];
    
            $data[] = $headers;
    
            foreach ($surveys as $survey) {
                $data[] = [
                    $survey->id,
                    $survey->product_name,
                    $survey->product_no,
                    $survey->description,
                    $survey->payment_mode,
                    $survey->created_at,
                ];
            }
    
        } elseif ($this->cate == 'product') {
            $products = DB::table('products')->whereDate('created_at', $this->date)->get();
            $headers = [
                'Id',
                'Product Name',
                'Amount',
                'Quantity',
                'Description',
                'Created At',
            ];
    
            $data[] = $headers;
    
            foreach ($products as $product) {
                $data[] = [
                    $product->id,
                    $product->prod_name,
                    $product->amount,
                    $product->quantity,
                    $product->descriptions,
                    $product->created_at,
                ];
            }
        }
    
        return collect($data);
    }
    

    // public function headings(): array
    // {
    //     return [
    //         'Order ID',
    //         'Product Id',
    //         'Vendor ID',
    //         'Customer Name',
    //         'Customer Email',
    //         'Payment Mode',
    //         'Total Price',
    //         'Created At',
    //     ];
    // }

}


