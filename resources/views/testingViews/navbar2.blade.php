<nav class="navbar navbar-expand-lg bg-light navbar-light">
    <a class="navbar-brand" href="{{url()->previous()}}"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
      </svg></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navb">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item">
              Region : HAZARA
          </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" id="searchquery">
        <button class="btn btn-success my-2 my-sm-0" id="searchbtn" type="button">Search</button>
      </form>
    </div>
  </nav>
  <script>
      document.getElementById('searchbtn').addEventListener('click', function(){
          var q = document.getElementById('searchquery').value;
          alert(q);
      });
  </script>
