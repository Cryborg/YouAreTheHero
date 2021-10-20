@extends('emails.template')

@section('body')
    <p>Bonjour {{ $user->first_name }},</p>
    <p>Il semble que tu aies commencé à écrire au moins une histoire mais que depuis tu ne sois jamais revenu(e) !</p>
    <p>Si tu rencontres des difficultés, n'hésite pas à venir en discuter sur le serveur Discord dédié, quelqu'un se fera un plaisir de t'aider !</p>
    <p>A très bientôt !</p>
@endsection
