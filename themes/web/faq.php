<link rel="stylesheet" href="assets/css/faq.css">

<?php
    use \Source\Models\Faq\Question;
    use \Source\Models\Faq\Type;

    $this->layout("master");

    $separatedData = [];
    foreach ($dataQuestions as $item) {
        $categoryId = $item->type_id;
        if (!isset($separatedData[$categoryId])) {
            $separatedData[$categoryId] = [];
        }
        $separatedData[$categoryId][] = $item;
    }

    $categories = [];
    foreach ($dataTypes as $type) {
        $categories[$type->id] = $type->description;
    }

    foreach ($separatedData as $categoryId => $items) {
        $categoryName = $categories[$categoryId];
        $stringHTML =
        "<div class='faq-type'>
            <h2>{$categoryName}</h2>";

        foreach ($items as $item) {
            $stringHTML .= "<div class='faq-item'>";
            $stringHTML .= "<h3>{$item->question}</h3>";
            $stringHTML .= "<p>{$item->answer}</p>";
            $stringHTML .= "</div>";
        }
        $stringHTML .= "</div>";

        echo $stringHTML;
    }