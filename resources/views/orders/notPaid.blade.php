@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card w-75 mx-auto text-center">
    
            <div class="card-body">
                <img src="{{URL::asset('../../public/images/system/checkmark.png')}}" alt="Checkmark image">
                
              <h5 class="card-title">Je betaling nog niet ontvangen</h5>
              <p class="card-text">Probeer later opnieuw.</p>
              
            </div>
            <div class="p-3">
              <a href="/orders" class="btn btn-primary">Ga terug</a>
            </div>
          </div>
    </div>
@endsection