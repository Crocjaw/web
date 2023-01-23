<?php
$id = $_GET['id'];
$dom = new DOMDocument();
$dom->load('data.xml');
$students = $dom->getElementsByTagName('subjects')->item(0);
$sub = $students->getElementsByTagName('sub');

if (isset($_POST['okay'])) {
    $subjects = $_POST['subject'];
    $points = $_POST['points'];
    $grade = $_POST['grade'];
    $new_subj = $dom->createElement('sub');

    $st_id = $dom->createElement('id', $id);
    $new_subj->appendChild($st_id);

    $s_name = $dom->createElement('subject', $subjects);
    $new_subj->appendChild($s_name);

    $st_group = $dom->createElement('points', $points);
    $new_subj->appendChild($st_group);

    $st_isu = $dom->createElement('grade', $grade);
    $new_subj->appendChild($st_isu);
    $i = 0;
    while (is_object($sub->item($i++))) {
        $std = $sub->item($i - 1)->getElementsByTagName('id')->item(0);
        $std_id = $std->nodeValue;
        if ($std_id == $id) {
            $students->replaceChild($new_subj, $sub->item($i - 1));
            break;
        }
    }

    $dom->formatOutput = true;
    $dom->save('data.xml') or die('Error');
    header('location: index.php?page_layout=list');
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
<div class="container-fluid">

    <div>
        <h2>Edit Grade</h2>
    </div>
    <div>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-item">
                <label for="subject">Subject</label>
                <input type="text" name="subject" class="form-control" required placeholder="Enter the name">
            </div>
            <div class="form-item">
                <label id="points" for="points">Points</label>
                <input type="number" name="points" class="form-control" required placeholder="only numbers">
            </div>
            <div class="form-item">
                <label id="grade" for="grade">Grade</label>
                <input type="text" name="grade" class="form-control" required placeholder="only numbers">
            </div>
            <button name="okay" class="btn btn-success" type="submit">Save</button>
        </form>
    </div>

</div>
</body>
</html>