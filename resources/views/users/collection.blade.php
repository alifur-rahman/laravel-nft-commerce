@extends('layouts.users.user-layout')
@section('title','User Profile')
@section('custom-css')
<style>

</style>
@stop
@section('content')

<div class="row g-5">
    <!-- start single collention -->
    @foreach ($collections as $collection)
        <div data-sal="slide-up" data-sal-delay="150" data-sal-duration="800"
            class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-12">
            <a href="{{url('collection/view/'.$collection->name.'/'.$collection->user_id)}}" class="rn-collection-inner-one">
                <div class="collection-wrapper">
                    <div class="collection-big-thumbnail">
                        <img src="{{ asset('Uploads/cover/' . $collection->cover_photo) }}"
                            alt="Nft_Profile">
                    </div>

                    <div class="collection-profile">
                        <img src="{{ asset('Uploads/profile/' . $collection->profile_photo) }}"
                            alt="Nft_Profile">
                    </div>
                    <div class="collection-deg">
                        <h6 class="title">{{ $collection->name }}</h6>
                        <span class="items">  Items</span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection
@section('custom-js')
    <script src="{{ asset('js/like-operation.js') }}"></script>
@stop
