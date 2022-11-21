@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                @csrf
<input type="hidden" id="token" value="{{ csrf_token() }}"/>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <button id="click" class="btn btn-success">Click</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// console.log('here');
//     var i = 0;
    // window.Echo.channel('websocket').listen('.ForWebsocket',(data)=> {
    //     console.log('here');
    //      //console.log(data);
    //    // $('#notification').append('<div class="alert alert-success">'+i+'.'+data.data+'</div>');
    // });
$('#click').click(function(e){
    e.preventDefault();
    $.ajax({
        url : "{{ route('event') }}",
        type : "get",
        success : function(){
           // console.log('event');
            window.Echo.channel(`websocket`)
    .subscribed(() => {
        console.log("Echo connected to WebSocket channel!");
    })
    .listen(".forwebsocket", (data) => {
        //console.log("New Order Received");
       console.log("New Order Data", data);
       var message = "notification sent";
       var token = $('#token').val();
       //console.log(token);
      $.ajax({
        url : "{{ route('notification') }}",
        type : "POST",
        data : { _token : token, message : message },
        success : function(data){
            // console.log(data);
            $.each(data, function(key, value){
               if(key == "message"){
                toastr.success(value);
               }
            })
            
           // $.each(data, function(key, value){
                 // console.log(data);
           // });
        }
      });
    });
        }
});



});


</script>
@endsection
