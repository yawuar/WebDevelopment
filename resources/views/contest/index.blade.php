<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Contest Photos</title>
</head>
<body>
	{{ $contestPhotos }}
	@foreach($contestPhotos as $contestPhoto)
		<img src="{{ $contestPhoto['photo_path'] }}" alt="{{ $contestPhoto['title'] }}">
	@endforeach
</body>
</html>