<!doctype html>
<html class=" no-js" lang="en">

<head>
    <title>Reset your password</title>

    <?php include("includes/head.inc"); ?>
</head>

<body class="bg-primary">

    <div class="cover" style="background-image: url(img/cover3.jpg)"></div>

    <div class="overlay bg-primary"></div>

    <div class="center-wrapper">
        <div class="center-content">
            <?php include($view); ?>

        </div>
    </div>
    <script type="text/javascript">
        var el = document.getElementById("year"),
            year = (new Date().getFullYear());
        el.innerHTML = year;
    </script>
</body>

</html>
