<html>

<head>
    <title>
        добавление карточки
    </title>
    <script>
        async function getWordsByCardId(cardId) {
            let response = await fetch('/words/' + cardId);
            if (response.ok) { // если HTTP-статус в диапазоне 200-299
                // получаем тело ответа (см. про этот метод ниже)
                let json = await response.json();
                return json;
            } else {
                alert("Ошибка HTTP: " + response.status);
            }
        }
        async function getCards(){
            let response = await fetch('/cards/');
            let json =  await response.json();
            return json;
        };
        document.addEventListener("DOMContentLoaded", function () {
        });

    </script>

</head>

<body>


</body>

</html>