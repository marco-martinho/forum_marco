<!DOCTYPE html class="h-100">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>cerebro</title>

    <link rel="stylesheet" href="bootstrap-4.5.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
 <header>
 <h1>cerebro</h1>
   <form method="get" action="index.php">
       <input type="text" name="search">
       <button>&#x1F50D</button>
   </form>
 </header>
 <nav>
    <form method="post" action="index.php">
       <button >Home</button>
    </form>
   <form method="post" action="index.php?edit=true">
       <button >Edit</button>
   </form>
 </nav>
<main>
   