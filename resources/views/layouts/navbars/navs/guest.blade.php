
<nav class="navbar navbar-expand-lg" style="background: #194262">
    <a href="{{ route('main') }}" class="nav-link">
        <i class="fa-solid fa-list"></i>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-list text-light"></i>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">

      </ul>
      <div class="dropdown dropleft">
        <div class="row">
            <div class="col-sm-2">
                <i class="fa-solid fa-globe mt-3 text-light"></i>
            </div>
            <div class="col-sm-10" style="
            background: rgb(2,0,36);
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(146,36,131,1) 0%, rgba(241,110,42,1) 100%);
            color: white;
            ">
                  <h5 class="font-weight-bold mt-3"><i class="fa-solid fa-clock"></i> &nbsp; {{date("m/d/Y , h:m:s a")}}</h5>
            </div>
        </div>  
      </div>
    </div>
</nav>