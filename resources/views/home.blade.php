@extends('layouts.app')

@section('content')

<style type="text/css">
    textarea{
        width: 410px;
        height: 150px !important;
    }
    .output-calculation{
        height: 150px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Exercise<!--{{ __('Dashboard') }}--></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <textarea name="input_calculation" id="input-calculation"></textarea>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="justify-content-center" id="output-calculation">
                                        @foreach($calculation as $calculate)
                                        <div class="row m-2" id="calc{{$calculate->id}}">
                                            <div class="col-lg-12">
                                                {{$calculate->input_calculation}} = {{$calculate->output_calculation}} <button class="btn btn-dark btn-sm calculate-delete" data-id="{{$calculate->id}}">Delete</button><br>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-lg-2 offset-lg-5">
                            <button class="btn btn-secondary btn-sm" id="calculate-save">Save</button>
                        </div>
                        <!-- <div class="col-lg-2 offset-lg-2">
                            <button class="btn btn-success btn-sm mt-2">+Add</button>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-info btn-sm mt-2">-Substract</button>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-warning btn-sm mt-2">%Division</button>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-danger btn-sm mt-2">*Multiplication</button>
                        </div> -->
                    </div>
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).on('click', '#calculate-save', function() {
        var input_calculation = $('#input-calculation').val();

        $.ajax({
            url: "{{route('calculate')}}",
            method: 'POST',
            data: {
                input_calculation: input_calculation,
                "_token": "{{csrf_token()}}"
            },
            success: function(data) {
                console.log(data);
                $('#input-calculation').val();
                $('#output-calculation').append(data.calculationhtmlcurrentupdated);
            }
        });

    });
    $(document).on('click', '.calculate-delete', function() {
        var id = $(this).data('id');

        $.ajax({
            url: "{{route('calculatedelete')}}",
            method: 'POST',
            data: {
                id: id,
                "_token": "{{csrf_token()}}"
            },
            success: function(data) {
                console.log(data);
                $('#calc'+data.id).remove();
            }
        });

    });

</script>
@endsection
