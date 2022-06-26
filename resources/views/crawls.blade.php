@extends('layouts.app')
    @section('content')
        <x-crawler-component :crawlers="$crawlers"/>
    @endsection
