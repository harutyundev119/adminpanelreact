@extends('layouts.main')

@section('content')
    <div class="map">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe width="1080" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=evrika&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="margin-top: 30px;"></iframe>
            </div>
        </div>
    </div>
@endsection
