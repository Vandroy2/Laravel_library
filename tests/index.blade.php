<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">
    <title>Document</title>
</head>
<body class="text-center" style="height: 100vh">

<div class="cover-container d-flex h-100 p-3 mx-auto flex-column main" style="object-fit: cover; background-image: url(https://cdn1.vectorstock.com/i/1000x1000/27/45/abstract-blue-light-circuit-background-technology-vector-16452745.jpg);">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">Cover</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="#">Home</a>
                <a class="nav-link" href="#">Features</a>
                <a class="nav-link" href="#">Contact</a>
                      <a class="nav-link" href="{{ route('admin.login') }}">admin</a>
            </nav>
        </div>
    </header>

    <main role="main" class="inner cover">
        <h1 class="cover-heading" style="color: blue">Cover your page.</h1>
        <p class="lead" style="color: gold">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>

    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">

        </div>
    </footer>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>


</body>
</html>
