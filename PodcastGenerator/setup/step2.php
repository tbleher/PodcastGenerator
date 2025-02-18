<?php
############################################################
# PODCAST GENERATOR
#
# Created by Alberto Betella and Emil Engler
# http://www.podcastgenerator.net
#
# This is Free Software released under the GNU/GPL License.
############################################################
require "securitycheck.php";
if (!isset($_SESSION)) {
    session_start();
}

// Dirs
$media = "../media/";
$images = "../images/";
$scripts = "../";

$media_write = false;
$images_write = false;
$scripts_write = false;

$testfile = "test.txt";

// Creating all testfiles
// TODO Loop this and put the strings in arrays
// Checking media
$f = fopen($media . $testfile, 'w');
fwrite($f, "test");
fclose($f);

// Now create test file for images
$f = fopen($images . $testfile, 'w');
fwrite($f, "test");
fclose($f);

// Now do this with the root
$f = fopen($scripts . $testfile, 'w');
fwrite($f, "test");
fclose($f);

// Now verify if the files actually exists
if (file_exists($media . $testfile)) {
    unlink($media . $testfile);
    $media_write = true;
}

if (file_exists($images . $testfile)) {
    unlink($images . $testfile);
    $images_write = true;
}

if (file_exists($scripts . $testfile)) {
    unlink($scripts . $testfile);
    $scripts_write = true;
}

function textColor($success)
{
    return $success ? 'green' : 'red';
}
function isIsNot($success)
{
    return $success ? 'is' : 'is not';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Podcast Generator - Step 2</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../core/bootstrap/style.css">
</head>

<body class="bg-light">
    <div class="container m-auto">
        <div class="align-items-center justify-content-md-center p-3 row vh-100">
            <div class="col-xl-7 col-lg-7 col-md-10 col-sm-12 bg-white p-4 shadow">
                <h2>Podcast Generator - <small>Step 2</small></h2>
                <p><small>We are now checking if our data directories are writable so you can actual store the data.</small></p>
                <p style="color: <?= textColor($media_write) ?>">Media <?= isIsNot($media_write) ?> writable</p>
                <p style="color: <?= textColor($images_write) ?>">Images <?= isIsNot($images_write) ?> writable</p>
                <p style="color: <?= textColor($scripts_write) ?>">Scripts <?= isIsNot($scripts_write) ?> writable</p>
                <?php if (!$media_write || !$images_write || !$scripts_write) { /* Try to adjust file permissions */ ?>
                    <p>Try to adjust file permissions</p>
                    <?php
                        chmod("$media_directory", 0777);
                        chmod("$images_directory", 0777);
                        chmod("$script_directory", 0777);
                    ?>
                    <strong><p style="color: red;">Please <a href="step2.php">reload</a> this page, if you still see this page you need to adjust the permissions manually</p></strong>
                <?php } else { ?>
                    <a href="step3.php" class="btn btn-success btn-block">Continue</a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>
