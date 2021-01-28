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
          @csrf
        {{-- <input class="form-control mr-sm-2" type="text" placeholder="Search" id="searchquery">
        <button class="btn btn-success my-2 my-sm-0" id="searchbtn" type="button">Search</button> --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <select class="custom-select" id="searchoption">
                    <option value="1" selected>By Medicine</option>
                    <option value="2">By Distributor</option>
                    <option value="3">By Formula</option>
                    <option value="4">By Company</option>
                  </select>
            </div>
            <input id="searchquery" type="text" class="form-control" placeholder="Search">
            <div class="input-group-prepend">

                <button class="btn btn-success" type="button" id="searchbtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                      </svg>
                </button>
            </div>
          </div>
      </form>
    </div>
  </nav>
  <script>
      document.getElementById('searchbtn').addEventListener('click', function(){
          var q = document.getElementById('searchquery').value;
          var o = document.getElementById('searchoption').value;

          if (q == '')
          {
              location.reload();
          }

          var httpobj = new XMLHttpRequest();
          httpobj.onreadystatechange = function()
          {
              if (this.status == 200 && this.readyState == 4)
              {
                  console.log(this.responseText);
                  document.getElementById('orderDisplay').innerHTML = this.responseText;
              }
          };

          httpobj.open("POST", "/search/" + o + "/" + q.trim().replace(/\s+/g, '').toLowerCase(), true);
          httpobj.setRequestHeader("X-CSRF-TOKEN",  "{{ csrf_token() }}");
          httpobj.send();
      });
  </script>
