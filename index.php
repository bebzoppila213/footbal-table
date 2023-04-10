<?php
require_once "./app/app.php";

$app = new App('./app/data.json');
$app->loadDataFromFile();
$footbalService = $app->getFootballMatchService();
$tourIndex = 0;


// print_r("<pre>");
// print_r($footbalService->getMatchesByParams(1, 1));
// print_r("</pre>");

// print_r("<pre>");
// print_r(count($footbalService->getMatchesByParams(1, 1)));
// print_r("</pre>");
// die();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./src/style.css">
</head>

<body>
    <div class="wrapper">
        <?php for ($circle = 1; $circle <= 2; $circle++) : ?>
            <div class="table-wrapper">
                <h3 class="table-title">Круг <?= $i ?></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Владелец</th>
                            <th>Гость</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($footbalService->getMatchesByCircle($circle) as $v) : ?>
                            <?php
                                $owner = $v->getOwner();
                                $quest = $v->getQuest();
                            ?>
                            <?php if ($tourIndex % 10 == 0) : ?>
                                <tr>
                                    <th colspan="2">Тур номер <?= $tourIndex / 10 + 1 ?></th>
                                </tr>
                            <?php endif; ?>
                            <?php $tourIndex += 1 ?>
                            <tr>
                                <td data-id="<?= $owner->getId() ?>"><?= $owner->getName() ?></td>
                                <td data-id="<?= $quest->getId() ?>"><?= $quest->getName() ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endfor; ?>
    </div>

    <script>
        function addActiveClassTdElements(elementId) {
            const allElements = document.querySelectorAll(`[data-id="${elementId}"]`)
            allElements.forEach(el => {
                el.classList.add("td--active")
            })
        }

        function removeActiveClassTdElements() {
            const allElements = document.querySelectorAll("td")
            allElements.forEach(el => {
                el.classList.remove("td--active")
            })
        }

        let prefId = null

        document.addEventListener("click", (event) => {
            const element = event.target

            if (event.target.tagName == "TD") {
                removeActiveClassTdElements()
                const elementId = element.dataset.id
                addActiveClassTdElements(elementId)
            }
        })
    </script>
</body>

</html>