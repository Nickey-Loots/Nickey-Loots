<?php

function getPage()
{
    if (isset($_GET["page"])) {
        $_SESSION["page"] = $_GET["page"];
    }
    if (!isset($_SESSION["page"])) {
        $_SESSION["page"] = "landingspage";
    }
    return "../resources/views/" . $_SESSION["page"] . ".view.php";
}
