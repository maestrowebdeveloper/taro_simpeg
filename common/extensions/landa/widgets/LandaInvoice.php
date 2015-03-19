<?php

class LandaInvoice extends CWidget {

    public $id;

    public function run() {
        $model = Sell::model()->findByPk($this->id);
        $infos = SellInfo::model()->findAll(array('condition' => 'sell_id=' . $model->id));
        $details = SellDet::model()->findAll(array('condition' => 'sell_id=' . $model->id));
        foreach ($infos as $info) {            
        }
        $city = City::model()->findByPk($info->city_id);

        $data = '<div class="checkout-outer">
        <div class="checkout-header" style="text-align:center">      <br>      
            <h2><i class="icon-shopping-cart"></i> INVOICE # ' . $model->code . '</h2><br>
        </div><!--end checkout-header-->
        <div class="checkout-content">';
        $data .= '            
            <div id="ListViewCart" class="" >
                    <div class="">
                            <div class="">                              
                            <table>                            
                            <tr>
                            <td class="span1">Status</td>
                            <td class="">:</td>
                            <td class="span5"><span class="label label-warning"> ' . ucfirst($info->status) . ' </span></td>
                            
                            <td class="span1">Province</td>
                            <td class="">:</td>
                            <td class="span5">' . $city->Province->name . '</td>
                            </tr>
                            <tr>
                            <td class="span1">Name</td>
                            <td class="">:</td>
                            <td class="span5">' . ucwords($info->name) . '</td>
                            
                            <td class="span1">City</td>
                            <td class="">:</td>
                            <td class="span5">' . $city->name . '</td>
                            </tr>    
                            <tr>
                            <td class="span1">Phone</td>
                            <td class="">:</td>
                            <td class="span5">' . landa()->hp($info->phone) . '</td>
                            
                            <td class="span1">Address</td>
                            <td class="">:</td>
                            <td class="span5">' . $info->address . '</td>
                            </tr>  
                            <tr>
                            <td class="span1">Note</td>
                            <td class="">:</td>
                            <td class="span5">' . $model->description. '</td>
                            
                            <td class="span1"></td>
                            <td class=""></td>
                            <td class="span5"></td>
                            </tr> 
                            </table>                             
                            <hr>
                                <table class="table">
                                        <thead style="background:#e7e7e7 !important">
                                                <tr>
                                                        <th><span>Image</span></th>
                                                        <th class="desc"><span>Product Name</span></th>
                                                        <th><span>Quantity</span></th>
                                                        <th><span>Unit Price</span></th>
                                                        <th><span>Sub Price</span></th>                                                        
                                                </tr>
                                        </thead>
                                        <tbody>';
        $total = 0;
        foreach ($details as $detail) {
            $product = Product::model()->findByPk($detail->product_id);
            $subTot = $detail->price * $detail->qty;
            
            $data.='<tr>
                        <td>
                            <a href="' . $product->url . '"><img style="width:30%;" src="' . $product->imgUrl['small'] . '" alt="product image"></a>
                        </td>
                        <td class="desc">
                                <h4><a href="' . $product->url . '" class="invarseColor">
                                        ' . $product->name . '
                                </a></h4>
                                
                                <ul class="unstyled">
                                        
                                        <li>Product Code : ' . $product->code . '</li>
                                </ul>

                        </td>
                        <td class="quantity">                                
                                       <h2> ' . $detail->qty . '</h2>
                        </td>
                        <td class="sub-price">
                                <h4>' . landa()->rp($detail->price) . '</h4>
                        </td>
                        <td class="total-price">
                                <h4>' . landa()->rp($subTot) . '</h4>									
                        </td>              
                </tr>';

            $total = $total + ($detail->price * $detail->qty);
        }

        $data .= '
            
<tr>
                        <td style="text-align:right" colspan="4">
                            <h4>Shipping</h4>
                        </td>
                        <td class="total-price">
                                <h4>' .landa()->rp($model->other). '</h4>									
                        </td>              
                </tr>
<tr>
                        <td style="text-align:right" colspan="4">
                            <h4>Total</h4>
                        </td>
                        <td class="total-price">
                                <h4>' . landa()->rp($total+$model->other) . '</h4>									
                        </td>              
                </tr>



                        </tbody>
                    </table>
			</div>
		
			</div><!--end row-->
		</div>';

        $account = SiteConfig::model()->findByPk(1);
        $variable = explode('<br>', ucwords($account->bank_account));
        $bank ="";
        foreach ($variable as $key => $value) {
            $bank .= '~ '.$value . '<br>';
        }
        $data .= '<br>
            <div class="alert">   
                <h1>
                    Cara Pembayaran
                </h1>            
                Lakukan pembayaran <span class="label label-success"> <b>HANYA SETELAH STATUS TRANSAKSI ANDA MENJADI PENDING</b></span><br>
                Karena pada status ORDER biaya pengiriman belum kami cantumkan.<br><br>
                
                <h1>
                    Info Status Transaksi
                </h1>            
                ~ <span class="label label-warning"> ORDER </span> : Transaksi baru dilaksanakan dan belum direview oleh admin<br>
                ~ <span class="label label-warning"> PENDING </span>  : Transaksi telah direview oleh admin. Dan sedang menunggu proses confirmasi pembayaran dari user<br>
                ~ <span class="label label-warning"> CONFIRM </span> : Transaksi telah dibayarkan oleh user dan sendang dilakukan pengiriman<br>
                ~ <span class="label label-warning"> REJECT </span> : Transaksi dibatalkan oleh admin karena hal-hal tertentu. Seperti stok tidak mencukupi, dll.<br>
                ~ <span class="label label-warning"> Delivered </span> : Barang telah terkirim ke user<br><br>
                
                <h1>
                    Account Bank IndoMobile Cell
                </h1>
                '.$bank.'
                <br>
            </div>
            </div>
            </div>';
        echo $data;
    }

}
?>