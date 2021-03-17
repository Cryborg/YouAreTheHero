<table class="table">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Joueur</th>
            <th scope="col">Note</th>
            <th scope="col">Commentaire</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ratings as $rating)
        <tr>
            <td class="moment_date">{{ $rating->created_at }}</td>
            <td>{{ $rating->user->username }}</td>
            <td>{{ $rating->rating }}</td>
            <td>{{ $rating->comment ?? '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
