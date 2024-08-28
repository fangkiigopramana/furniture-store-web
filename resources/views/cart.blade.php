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
                <td>{{$cart->total_price}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
