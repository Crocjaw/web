<?php
$dom = new DOMDocument();
$dom->load('data.xml');
$students = $dom->getElementsByTagName('subjects')->item(0);
$student = $students->getElementsByTagName('sub');
$index = $student->length;
$id = $student[$index - 1]->getElementsByTagName('id')->item(0)->nodeValue + 1;

/**
 * @param DOMDocument $dom
 * @param $id
 * @return DOMElement|false
 * @throws DOMException
 */
function getF(DOMDocument $dom, $id)
{
    $subj = $_POST['subject'];
    $points = $_POST['points'];
    $grade = $_POST['grade'];
    $new_subj = $dom->createElement('sub');

    $st_id = $dom->createElement('id', $id);
    $new_subj->appendChild($st_id);

    $st_name = $dom->createElement('subject', $subj);
    $new_subj->appendChild($st_name);

    $st_group = $dom->createElement('points', $points);
    $new_subj->appendChild($st_group);

    $st_isu = $dom->createElement('grade', $grade);
    $new_subj->appendChild($st_isu);
    return $new_subj;
}

if (isset($_POST['okay'])) {
    $new_student = getF($dom, $id);

    $students->appendChild($new_student);

    $dom->formatOutput = true;
    $dom->save('data.xml') or die('Error');
    header('location: index.php?page_layout=list');
}
?>
<link rel="stylesheet" href="create.css">
<div>
    <div>
        <h2>Add Subject</h2>
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
            <button name="okay" class="btn btn-success" type="submit">Add</button>
        </form>
    </div>
</div>