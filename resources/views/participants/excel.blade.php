<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Participants</title>
  </head>
  <body>
    <table>
      <tr>
          <tr>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>E-mail</th>
              <th>Title</th>
              <th>Amount of likes</th>
              <th>Amount of superlikes (1 superlike = 5 points)</th>
          </tr>
      </tr>
      @foreach($contestPhotos as $contestPhoto)
        <tr>
            <td>{{ $contestPhoto['firstname'] }}</td>
            <td>{{ $contestPhoto['lastname'] }}</td>
            <td>{{ $contestPhoto['email'] }}</td>
            <td>{{ $contestPhoto['title'] }}</td>
            <td>{{ $contestPhoto['likes'] }}</td>
            <td>{{ $contestPhoto['superlikes'] }}</td>
        </tr>
      @endforeach
    </table>
  </body>
</html>
