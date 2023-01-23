<!DOCTYPE html>
<html lang="en">

<h4><?= 'Kenteken auto: ' . $data['autoKenteken']; ?></h4>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3><?= $data['title']; ?></h3>
    <form action="<?= URLROOT; ?>/mankementen/addMankement" method="post">
        <label for="mankement">Mankement</label><br>
        <input type="text" name="mankement" maxlength="51" required="true" id="mankement"><br><br>
        <input type="date" name="datum" id="datum"><br><br>
        <input type="hidden" name="id" value="<?= $data['id']; ?>">
        <input type="submit" value="Voer In">
    </form>
</body>

</html>