<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>List USER!</title>
  </head>
  <body>

    <div class="container mt-5">

      <h1 class="text-center">Danill EMPLOOYERS!</h1>

      <div class="container mt-5">
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
          <p>{{ $message }}</p>
      </div>
      @endif
      <a class="btn btn-success shadow mb-3" href={{ route('posts.create') }}>
         Add User
      </a>
      <ul class="list-group shadow">
        <li class="list-group-item active" aria-current="true">List</li>
        <li style="list-style: none;">
          <table class="table">
          <thead class="thead-light">
              <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">action</th>
              </tr>
          </thead>
          <tbody>
              @foreach($users as $p)
                  <tr>
                    <th scope="row"></th>
                      <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>
                      <form action="{{ route('posts.destroy', $p->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-info m-2 text-light" href={{ route('posts.edit', $p->id) }}>edit</a>
                        <button type="submit" class="btn btn-danger m-2 text-light" href={{ route('posts.destroy', $p->id) }}>Hapus</button>
                      </form>
                    </td> 
                  </tr>
              @endforeach
          </tbody>
          </table>
        </li>
      </ul>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>