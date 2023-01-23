<?php
$products = array(
    array(
        'id' => 1,
        'subject' => 'Math',
        'points' => 98,
        'grade' => 'A'
    ),
    array(
        'id' => 2,
        'subject' => 'English',
        'points' => 76,
        'grade' => 'C'
    ),
    array(
        'id' => 3,
        'subject' => 'Web',
        'points' => 80,
        'grade' => 'B'
    ),
);
$xml = new DOMDocument('1.0', 'UTF-8');

$root = $xml->createElement('subjects');
$xml->appendChild($root);

foreach ($products as $value) {
    $subject = $xml->createElement('sub');
    foreach ($value as $key => $value) {
        $node = $xml->createElement($key, $value);
        $subject->appendChild($node);
    }
    $root->appendChild($subject);

}
$xml->formatOutput = true;
$xml->save('data.xml') or die('Error');
