<?php
$dom = new DOMDocument();
$dom->load('data.xml');
$students = $dom->getElementsByTagName('subjects')->item(0);
?>

<div class="container-fuild">
    <div class="card">
        <div class="card-header">
            <h1>Grades & Points</h1>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr class="row">
                    <th>No.</th>
                    <th>Subject</th>
                    <th>Points</th>
                    <th>Grade</th>
                    <th>Edit</th>
                    <th>Passed</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                $student = $students->getElementsByTagName('sub');
                while (is_object($student->item($i++))) {
                    ?>
                    <tr class="row">
                        <td><?php echo $i ?></td>
                        <td><?php echo $student->item($i - 1)->getElementsByTagName('subject')->item(0)->nodeValue ?></td>
                        <td><?php echo $student->item($i - 1)->getElementsByTagName('points')->item(0)->nodeValue ?></td>
                        <td><?php echo $student->item($i - 1)->getElementsByTagName('grade')->item(0)->nodeValue ?></td>
                        <td>
                            <a href="index.php?page_layout=update&id=<?php echo $student->item($i - 1)->getElementsByTagName('id')->item(0)->nodeValue; ?>" id="edit">
                                Edit</a></td>
                        <td>
                            <a onclick="return Del('<?php echo $student->item($i - 1)->getElementsByTagName('subject')->item(0)->nodeValue; ?>',<?php echo $i ?> )"
                               href="index.php?page_layout=delete&id=<?php echo $student->item($i - 1)->getElementsByTagName('id')->item(0)->nodeValue; ?>" id="pass">Passed</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <a href="index.php?page_layout=create" id="add">Add Subject</a>
        </div>
    </div>

</div>

<script>
    function Del(name, id) {
        var x = parseInt(id);
        var s = "th";
        if (x % 10 === 1) {
            s = "st";
        } else if (x % 10 === 2) {
            s = "nd";
        } else if (x % 10 === 3) {
            s = "rd";
        }
        return confirm("Have you really passed the " + id + s + " subject " +name+" ?");
    }
</script>