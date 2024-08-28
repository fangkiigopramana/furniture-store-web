<section class="container pt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$cart->product_name}}</td>
                <td>{{$cart->quantity}}</td>
                <td>{{'Rp '.number_format($cart->total_price,0,' ','.')}}</td>
            </tr>
            @endforeach
        </tbody>
        <footer>
            <tr>
                <th class="text-center" colspan="3">TOTAL</th>
                <td>{{'Rp '.number_format($total_price_cart,0,' ','.')}}</td>
            </tr>
        </footer>
    </table>
</section>
