@extends('emails.template')

@section('body')
    <h3>Nouvelles fonctionnalités !</h3>
    <p>Bonjour {{ $user->first_name }},</p>
    <p>Une nouvelle mise à jour vient d'être faite sur le site.</p>
@endsection
