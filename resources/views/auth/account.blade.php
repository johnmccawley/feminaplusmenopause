@extends('master')

@section('page_title', 'Account')
@section('page_id', 'account')
<?php
    $page_id = 'account';
    $states = [
        'AL' => 'Alabama',
        'AK' => 'Alaska',
        'AZ' => 'Arizona',
        'AR' => 'Arkansas',
        'CA' => 'California',
        'CO' => 'Colorado',
        'CT' => 'Connecticut',
        'DE' => 'Delaware',
        'DC' => 'District Of Columbia',
        'FL' => 'Florida',
        'GA' => 'Georgia',
        'HI' => 'Hawaii',
        'ID' => 'Idaho',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'IA' => 'Iowa',
        'KS' => 'Kansas',
        'KY' => 'Kentucky',
        'LA' => 'Louisiana',
        'ME' => 'Maine',
        'MD' => 'Maryland',
        'MA' => 'Massachusetts',
        'MI' => 'Michigan',
        'MN' => 'Minnesota',
        'MS' => 'Mississippi',
        'MO' => 'Missouri',
        'MT' => 'Montana',
        'NE' => 'Nebraska',
        'NV' => 'Nevada',
        'NH' => 'New Hampshire',
        'NJ' => 'New Jersey',
        'NM' => 'New Mexico',
        'NY' => 'New York',
        'NC' => 'North Carolina',
        'ND' => 'North Dakota',
        'OH' => 'Ohio',
        'OK' => 'Oklahoma',
        'OR' => 'Oregon',
        'PA' => 'Pennsylvania',
        'RI' => 'Rhode Island',
        'SC' => 'South Carolina',
        'SD' => 'South Dakota',
        'TN' => 'Tennessee',
        'TX' => 'Texas',
        'UT' => 'Utah',
        'VT' => 'Vermont',
        'VA' => 'Virginia',
        'WA' => 'Washington',
        'WV' => 'West Virginia',
        'WI' => 'Wisconsin',
        'WY' => 'Wyoming'
    ];
?>

@section('content')
    <section id="tile-account">
        <div class="container">
            <div class="row">
                <div class="span4">
                    <h3>My Account</h3>
                    <div class="subscription-status">
                        <div class="subscription-wrapper">
                            <div class="subscription-name">
                                Femina Plus Club
                            </div>
                            <div class="subscription-indicator">
                                @if($subscription)
                                    @if($subscription->cancel_at_period_end)
                                        INACTIVE
                                    @else
                                        ACTIVE
                                    @endif
                                @else
                                    INACTIVE
                                @endif
                            </div>
                            <div class="subscription-ends">
                                @if($subscription)
                                    Current Period:
                                    <br />
                                    @if($subscription->cancel_at_period_end)
                                        Ends {{ date('m/d/Y', $subscription->current_period_end) }}
                                    @else
                                        Ongoing
                                    @endif
                                @endif
                            </div>
                            @if($subscription)
                                @if($subscription->cancel_at_period_end)
                                    <form action="{{ url('/buy') }}" method="GET">
                                        {{ csrf_field() }}
                                        {{ method_field('GET') }}
                                        <button type="submit" class="atc-btn">PURCHASE</button>
                                    </form>
                                @else
                                    <button id="cancelButton" type="button" class="atc-btn">CANCEL</button>
                                    <div id="cancelDiv" style="display:none">
                                        <form action="{{ action('SubscriptionController@destroy') }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <button type="submit" class="atc-btn">ARE YOU SURE?</button>
                                        </form>
                                    </div>
                                @endif
                            @else
                                <form action="{{ url('/buy') }}" method="GET">
                                    {{ csrf_field() }}
                                    {{ method_field('GET') }}
                                    <button type="submit" class="primary-btn">PURCHASE</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="span8">
                    <h3>Billing Info</h3>
                    <form action="{{ action('HomeController@updateUser') }}" id="user-form" method="POST">
                        <div class="user-info-pane">
                            {{ csrf_field() }}
                            @include('errors.errors')
                            <div id="user-info">
                                <div class="row input-row">
                                    <input type="text" class="form-control" name="user-name" placeholder="Name" value="{{ $user->name }}"/>
                                </div>
                                <div class="row input-row">
                                    <div class="span6">
                                        <input type="text" class="form-control" name="user-email" placeholder="Email" value="{{ $user->email }}"/>
                                    </div>
                                    <div class="span6">
                                        <input id="user-phone" type="text" class="form-control" name="user-phone" placeholder="Phone" value="{{ $user->phone }}"/>
                                    </div>
                                </div>
                                <div class="row input-row">
                                    <input type="text" class="form-control" name="user-address-1" placeholder="Address" value="{{ $user->address }}"/>
                                </div>
                                <div class="row input-row">
                                    <div class="span6">
                                        <input type="text" class="form-control" name="user-address-2" placeholder="Address 2" value="{{ $user->apartment_suite_number }}"/>
                                    </div>
                                    <div class="span6">
                                        <input type="text" class="form-control" name="user-city" placeholder="City" value="{{ $user->city }}"/>
                                    </div>
                                </div>
                                <div class="row input-row">
                                    <div class="span8">
                                        <select name="user-state">
                                            <option class="null" value="" disabled selected>State</option>
                                            @foreach($states as $key => $value)
                                                @if($user->state == $key)
                                                    <option value="{{$key}}" selected>{{$value}}</option>
                                                @else
                                                    <option value="{{$key}}" >{{$value}}</option>
                                                @endif
                                            @endforeach
        								</select>
                                    </div>
                                    <div class="span4">
                                        <input type="text" class="form-control" name="user-zip" placeholder="Zip" value="{{ $user->zip }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="input-row">
                                <button type="submit" id="submitBtn" class="primary-btn">Update Information</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $('#cancelButton').on('click', function () {
            $('#cancelDiv').show();
        });
    </script>
@endsection
