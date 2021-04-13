<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Page Title</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	</head>
	<body>
        <div class="container">
            <h1>Create Article</h1>
            {{-- show error message --}}
            @if(Session::has('error'))
                <p class="text-danger">{{ Session::get('error') }}</p>
            @endif
            <form action="{{ route('article.update',$article->id) }}" method="POST">
                @csrf
                @method('PUT')
                <fieldset class="form-group">
                    <label for="formGroupExampleInput">Article Name</label>
                    <input type="text" name="name" class="form-control" id="formGroupExampleInput" value="{{ $article->name }}">
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Description</label>
                    <input type="text" name="description" class="form-control" id="formGroupExampleInput2" value="{{ $article->description }}"> 
                </fieldset>
                <fieldset class="form-group">
                    <label for="formGroupExampleInput2">Content</label>
                    <input type="text" name="content" class="form-control" id="formGroupExampleInput2" value="{{ $article->content }}">
                </fieldset>
                <fieldset class="form-group">
                    <label for="exampleSelect1">Category</label>
                    <select class="form-control" id="eexampleSelect11" name="category_id">
                        <option></option>
                        @foreach ($categories as $category_id => $name )
                            <option value="{{ $category_id }}" {{ old('category_id',$article->category_id)==$category_id ? 'selected' : null }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </fieldset>
                <button type="submit" class="btn btn-primary">Create Article</button>

            </form>
        </div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script></body>
</html>