<h3><?= $data['title']; ?></h3>
<h4><?= 'Naam instructeur: ' . $data['instructorName']; ?></h4>
<h4><?= 'E-mailadres: ' . $data['instructorEmail']; ?></h4>
<h4><?= 'Kenteken auto: ' . $data['autoKenteken']; ?></h4>

<table border="1">
    <thead>
        <th>Datum</th>
        <th>Mankement</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
    
</table>

<br>
<a href="<?= URLROOT; ?>/mankementen/addTopic/<?= $data['lessonId']; ?>">
    <input type="button" value="Onderwerp Toevoegen">
</a>