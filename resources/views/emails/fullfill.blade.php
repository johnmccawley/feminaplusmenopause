<p>Name: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<p>Adress: {{ $user->address }}</p>
@if($user->apartment_suite_number)
    <p>Apartment/Suite Number: {{ $user->apartment_suite_number }}</p>
@endif
<p>City: {{ $user->city }}</p>
<p>State: {{ $user->state }}</p>
<p>Zip: {{ $user->zip }}</p>

<p>User purchased {{ $product }}</p>
