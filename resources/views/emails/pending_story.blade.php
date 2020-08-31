<!DOCTYPE html>
<html lang="{{ $user->locale }}">
    <head>
        <meta charset="utf-8">
        <title>@lang('mail.pending_story_subject')</title>
    </head>
    <body>
        @lang('mail.pending_story_body', [
            'mail' => $user->email,
            'username' => $user->username
        ])
    </body>
</html>
