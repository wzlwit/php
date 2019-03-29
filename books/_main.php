<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Styleguide</title>
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="css/style.css" type="text/css"> </head>

<body>
  <div class="py-2 text-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="display-3 text-capitalize">My Library</h1>
          <ul class="nav">
            <li class="nav-item">
        			<a class="nav-link" href="index.php">Home</a>
        		</li>
						<li class="nav-item">
        			<a class="nav-link" href="edit_books.php">Create Book</a>
        		</li>
        		<li class="nav-item">
        			<a class="nav-link" href="books.php">List Books</a>
        		</li>
        		<li class="nav-item">
        			<a href="members.php#create" class="nav-link">Create Member</a>
        		</li>
        		<li class="nav-item">
        			<a class="nav-link" href="members.php#list">List Members</a>
        		</li>
        	</ul>
        </div>
      </div>
    </div>
  </div>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>List of books</h2>
          <hr>
          <div class="table-responsive col-md-12">
            <table class="table table-hover table-striped table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Striped table</th>
                  <th scope="col">bordered</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>example</td>
                  <td>one</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>example</td>
                  <td>two</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>example</td>
                  <td>three</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="text-right">There are 3 books in the library</p>
        </div>
      </div>
    </div>
  </div>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Create a book</h2>
          <hr> </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">
          <form class="">
            <div class="form-group">
              <label>Book Title</label>
              <input type="text" class="form-control">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Author</label>
              <input type="text" class="form-control">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Year of Publication</label>
              <select class="form-control">
                <option value=""></option>
              </select>
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Editor</label>
              <input type="text" class="form-control">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" rows="3" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
