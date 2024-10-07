<nav id="scrollspy" class="navbar page-navbar navbar-dark navbar-expand-md fixed-top affix " data-offset-top="20">
<!-- "background-color: #007BFF;" -->
    <div class="container">
        <a class="navbar-brand" href="/">
            <!-- <img src="/imgs/Logo.ico" alt="INACO Logo" class="mr-2"> -->
            <img src="/imgs/Logo.png" alt="INACO Logo" style="width: 80px; height: auto;">
            <strong class="text-light"><strong class="text-primary">INACO</strong> | e-Module</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
    <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="{{ route('ocai.index') }}">
        OCAI
    </a>
</li>


                <li class="nav-item">
                    <form id="logout" action="/logout" method="POST">
                        @csrf
                        <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="javascript:;"
                            onclick="document.getElementById('logout').submit();">Logout</a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
