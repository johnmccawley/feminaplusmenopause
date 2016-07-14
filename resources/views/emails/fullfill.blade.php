CUSTOMER SHIPPING INFORMATION
<br/>
<hr>
<p>Name: {{ $userData->firstName }} {{ $userData->lastName }}</p>
<p>Email: {{ $userData->email }}</p>
<p>Phone: {{ $userData->phone }}</p>
<p>Adress: {{ $userData->addressOne }}</p>
@if($userData->addressTwo)
    <p>Apartment/Suite Number: {{ $userData->addressTwo }}</p>
@endif
<p>City: {{ $userData->city }}</p>
<p>State: {{ $userData->state }}</p>
<p>Zip: {{ $userData->zip }}</p>
<br/>
<br/>
ITEMS PURCHASED
<br/>
<hr>
@foreach($purchased as $key => $item)
    <p>Product: {{ $key }}</p>
    <p>Name: {{ $item->name }}</p>
    <p>Quantity: {{ $item->amount }}</p>
    <br />
@endforeach
