<link rel="stylesheet" href="assets/css/faq.css">

<section>
    <?php
    use \Source\Models\Faq\Question;

    $this->layout("master");

    $faq = new Question();
    $res = $faq->selectAll();

    foreach ( $res as $question ) {
        echo
        "<div class='faq-item'>
            <h3>{$question->question}</h3>
            <p>{$question->answer}</p>
        </div>
        <br>";
    }
    ?>
</section>
