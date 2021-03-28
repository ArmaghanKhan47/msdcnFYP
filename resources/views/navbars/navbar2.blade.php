<nav class="navbar navbar-expand-lg bg-light navbar-light">
    <a class="navbar-brand" href="/onlineorder"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
      </svg></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navb">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item">
              Region : {{session('region')}}
          </li>
      </ul>
      @if (url()->current() == url('/onlineorder'))
        <form class="form-inline my-2 my-lg-0">
            @csrf
        {{-- <input class="form-control mr-sm-2" type="text" placeholder="Search" id="searchquery">
        <button class="btn btn-success my-2 my-sm-0" id="searchbtn" type="button">Search</button> --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <select class="custom-select" id="searchoption">
                    <option value="1" selected>By Medicine</option>
                    <option value="2">By Distributor</option>
                    <option value="3">By Company</option>
                    </select>
            </div>
            <input id="searchquery" name="q" type="text" class="form-control" placeholder="Search">
            </div>
        </form>
      @endif
    </div>
  </nav>
  <script>

      window.onload = function()
      {
          $('#searchquery').on('input', function(){
              var q = $(this).val();
              if (q == '')
                {
                     location.reload();
                }
              var option = $('#searchoption').val();

              $.post({
                  "headers" : {
                        "X-CSRF-TOKEN" : "{{ csrf_token() }}"
                    },
                    "url" : "/search",
                    "data" : {
                        "query" : q.trim().toLowerCase(),
                        "option" : option
                    }
              }, function(data){
                  $('#orderDisplay').html(data);
              });
          });
      }

      //Creating AJAX to get Results for Search
    //   document.getElementById('searchbtn').addEventListener('click', function(){
    //       var q = document.getElementById('searchquery').value;
    //       var o = document.getElementById('searchoption').value;

    //       if (q == '')
    //       {
    //           location.reload();
    //       }

    //       var httpobj = new XMLHttpRequest();
    //       httpobj.onreadystatechange = function()
    //       {
    //           if (this.status == 200 && this.readyState == 4)
    //           {
    //               console.log(this.responseText);
    //               document.getElementById('orderDisplay').innerHTML = this.responseText;
    //           }
    //       };

    //       httpobj.open("POST", "/search/" + o + "/" + q.trim().toLowerCase(), true);
    //       httpobj.setRequestHeader("X-CSRF-TOKEN",  "{{ csrf_token() }}");
    //       httpobj.send();
    //   });

    //   //Overriding default enter key behaviour on text field
    //   document.getElementById('searchquery').addEventListener('keypress', function(event){
    //       if (event.keyCode == 13)
    //       {
    //           event.preventDefault();
    //           document.getElementById('searchbtn').click();
    //       }
    //   });
  </script>
