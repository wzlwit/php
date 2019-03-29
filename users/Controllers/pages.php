<?php
 // <controllers>
class Pages extends Controller
{
    function homepage($f3)
    // * when controller is called, this function will be executed, so args required, different logic
    {
        $f3->set("error", array());
        // echo "This is my homepage";
        echo $f3->get('twig')->render("home.html");
    }

    function about()
    {
        echo "this is my about page. I am super cool";
    }

    function temp($f3)
    { //pass in global var $f3
        $f3->set("error", array());
        echo $f3->get('twig')->render("book_form.html", array());
    }
}

?>

<! -- --> 