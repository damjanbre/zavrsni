<?php include('dbconnection.php'); ?>



<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>
<body>

<?php include('header.php'); ?>

    <div class="va-l-container">
        <main class="va-l-page-content">

            <?php
                if (isset($_GET['id'])) 
                {

                    $sql = "SELECT * FROM posts WHERE id = {$_GET['id']}";

                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $singlePost = $statement->fetch();

            
                    $sql = "SELECT * FROM comments WHERE id =  {$_GET['id']}";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $comments = $statement->fetchAll();
                } else {
                        echo('post_id nije prosledjen kroz $_GET');
                    }
            ?>
            
               <div class="row">

                <div class="col-sm-8 blog-main">

                <div class="blog-post">
                </div><h1><a href="single-post.php?id=<?php echo($singlePost['id']) ?>"><?php echo($singlePost['title']) ?></a></h1>
                <p class="blog-post-meta"><?php echo($singlePost['created_at']) ?><a href="#"><?php echo($singlePost['author']) ?></a></p>

        <p>This blog post shows a few different types of content that's supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
        <hr>
        <p><?php echo($singlePost['body']) ?>

            <?php foreach($comments as $comment) 
                { ?>
                            <p><?php echo $comment['author'] ?></p>
                            <ul>
                            <div class="single-comment">
                            <li><?php echo $comment['text'] ?></li>                            
                            </ul>
                           
             <?php } ?>
                           
                

    <?php include('sidebar.php'); ?>
    <?php include('footer.php'); ?>
</body>
</html>
