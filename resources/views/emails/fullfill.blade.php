CUSTOMER SHIPPING INFORMATION
<br/>
<hr>
<p>Name: {{ $customerData->firstName }} {{ $customerData->lastName }}</p>
<p>Email: {{ $customerData->email }}</p>
<p>Phone: {{ $customerData->phone }}</p>
<p>Adress: {{ $customerData->addressOne }}</p>
@if($customerData->addressTwo)
    <p>Apartment/Suite Number: {{ $customerData->addressTwo }}</p>
@endif
<p>City: {{ $customerData->city }}</p>
<p>State: {{ $customerData->state }}</p>
<p>Zip: {{ $customerData->zip }}</p>
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
