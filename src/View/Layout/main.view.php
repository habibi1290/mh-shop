<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Style/Style.css">
    <title>Document</title>
</head>
<body>
    <main class="flex main">
        <?php if (isset($content)) {
            echo $content;
        } ?>
    </main>
</body>
</html>

