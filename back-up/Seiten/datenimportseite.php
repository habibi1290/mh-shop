<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSV import</title>
</head>
<body>

<form action="datenimport.php" mehtod="post" enctype="multipart/form-data">
    <input type="file" name="upcsv" accept=".csv" required/>
    <input type="submit" value="upload"/>
</form>

</body>
</html>