<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Mobile Web-app fullscreen -->

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <style>
        body {font-family: Helvetica, sans-serif;font-size:13px;}
        .container{max-width: 680px; margin:0 auto;}
        .logotype{background:#000;color:#fff;width:75px;height:75px;  line-height: 75px; text-align: center; font-size:11px;}
        .column-title{background:#eee;text-transform:uppercase;padding:15px 5px 15px 15px;font-size:11px}
        .column-detail{border-top:1px solid #eee;border-bottom:1px solid #eee;}
        .column-header{background:#eee;text-transform:uppercase;padding:15px;font-size:11px;border-right:1px solid #eee;}
        .row{padding:7px 14px;border-left:1px solid #eee;border-right:1px solid #eee;border-bottom:1px solid #eee;}
        .alert{background: #ffd9e8;padding:20px;margin:20px 0;line-height:22px;color:#333}
        .socialmedia{background:#eee;padding:20px; display:inline-block}
    </style>

</head>

<body>

    <div class="container">

        <table width="100%">
          <tr>
            <td width="75px" style="background-color: black;"><div style="text-align: center; color: white;">Copmany</div></td>
            <td style="background-color: #ffd9e8;" height="50px;" width="300px"><div style="text-align: center;
             font-size: 25px;">#{{ $receipt['invoice_no'] }}</div></td>
            <td></td>
          </tr>
        </table> 
        <br><br>
        <h3>Customer {{ $receipt['name'] }},</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p><br>
        <table width="100%" style="border-collapse: collapse;">
          <tr>
            <td widdth="50%" style="background:#eee;padding:20px;">
              <strong>Order Date:</strong> {{ $receipt['order_date'] }}<br>
              <strong>Payment type:</strong> Credit Card VISA<br>
              <strong>Delivery type:</strong> Postnord<br>
            </td>
            <td style="background:#eee;padding:20px;">
              <strong>Order-nr:</strong> {{ $receipt['order_number'] }}<br>
              <strong>E-mail:</strong> {{ $receipt['email'] }}<br>
              <strong>Phone:</strong> {{ $receipt['phone'] }}<br>
            </td>
          </tr>
        </table><br>
        <table width="100%">
          <tr>
            <td>
              <table>
                <tr>
                  <td width="50px;" height="50px;" style="vertical-align: text-top; margin-right: 10px;">
                    <div style="background: #ffd9e8 url({{ public_path('frontend/assets/images/invoice/1.png') }}); width: 50px;height: 50px;margin-right: 10px;background-position: center;background-size: 42px;"></div>   
                  </td>
                  <td>
                    <strong>Delivery</strong><br>
                    Firstname Lastname<br>
                    Queens high 17 B<br>
                    SE-254 57 Helsingborg<br>
                    Sweden
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table>
                <tr>
                  <td width="50px;" height="50px;" style="vertical-align: text-top; margin-right: 10px;">
                    <div style="background: #ffd9e8 url({{ public_path('frontend/assets/images/invoice/2.png') }}) no-repeat;width: 50px;height: 50px;margin-right: 10px;background-position: center;background-size: 25px;"></div>   
                  </td>
                  <td>
                    <strong>Delivery</strong><br>
                    Firstname Lastname<br>
                    Queens high 17 B<br>
                    SE-254 57 Helsingborg<br>
                    Sweden
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table><br>
        <table width="100%" style="border-top:1px solid #eee;border-bottom:1px solid #eee;padding:0 0 8px 0">
          <tr>
            <td><h3>Checkout details</h3>Your checkout made by VISA Card **** **** **** 2478<td>
          </tr>
        </table><br>
        <h3>Your Products</h3>
      
         <table width="100%" style="border-collapse: collapse;border-bottom:1px solid #eee;">
           <tr>
             <td width="40%" class="column-header">Product</td>
             <td width="20%" class="column-header">Options</td>
             <td width="20%" class="column-header">Price</td>
             <td width="20%" class="column-header">Total</td>
           </tr>
           @foreach ($order_items as $order_item)
            <tr>
              <td class="row">{{ $order_item->product->product_name_en }}</td>
              <td class="row">{{ $order_item->color ? $order_item->color : ''}} {{ $order_item->size ? ' | '. $order_item->size : ''}}</td>
              <td class="row">{{ $order_item->qty }} <span style="color:#777">X</span> {{ $order_item->price }} taka</td>
              <td class="row">{{ $order_item->price * $order_item->qty }} taka</td>
            </tr>
           @endforeach
        </table><br>
        <table width="100%">
          <tr>
            <td>
              <table width="300px" style="float:right; background:#eee;padding:20px;">
                <tr>
                  <td><strong>Shipping arrival:</strong></td>
                  <td style="text-align:right">{{ $receipt['arrival_date'] }}</td>
                </tr>  
                <tr>
                  <td><strong>Total items:</strong></td>    
                  <td style="text-align:right">{{ $receipt['cart_qty'] }}</td>
                </tr>
                <tr>
                  <td><strong>Amount:</strong></td>
                  <td style="text-align:right">{{ $receipt['amount'] }} taka</td>
                </tr>
                <tr>
                  <td><strong>Status:</strong></td>    
                  <td style="text-align:right">{{ $receipt['status'] }}</td>
                </tr>
              </table>
             </td>
          </tr>
        </table>
        <div class="socialmedia">Follow us online <small>[
          <a href="https://www.facebook.com/">Facebook</a>
          ] [
            <a href="https://www.instagram.com/">Instagram</a>
          ]</small></div>
      </div><!-- container -->

</body>

</html>
