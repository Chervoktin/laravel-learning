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
        async function getCards() {
            let response = await fetch('/cards/');
            let json = await response.json();
            return json;
        };

        function createTest(words) {
            for (let i = 0; i != words.length; i++) {
                let word = words[i];
                let input = document.createElement('input');
                let p = document.createElement('span');
                p.innerHTML = word.word + "   :";
                input.id = word.id;
                input.value = word.translation;
                let div = document.getElementById("test");
                div.append(p);
                div.append(input);
            }
        }

        function input(event){
            console.log(event.target.value);
        }

        document.addEventListener("DOMContentLoaded", async function () {
            let cards = await getCards();
            window.cards = cards;
            window.currentCardPosition = 1;
            window.AllCards = cards.length;
            let positionDiv = document.getElementById("position");
            positionDiv.innerHTML = window.currentCardPosition + "/" + window.AllCards;
            document.getElementById("text").innerHTML = cards[window.currentCardPosition - 1].text;
        });

        async function next() {
            document.getElementById("prev").disabled = true;
            window.currentCardPosition += 1;
            let words = await getWordsByCardId(window.cards[window.currentCardPosition - 1].id);
            document.getElementById("prev").disabled = false;
            let div = document.getElementById("test");
            while (div.lastChild != null) {
                div.removeChild(div.lastChild);
            }
            
            let positionDiv = document.getElementById("position");
            positionDiv.innerHTML = window.currentCardPosition + "/" + window.AllCards;
            document.getElementById("text").innerHTML = window.cards[window.currentCardPosition - 1].text;
        }
        async function prev() {
            document.getElementById("prev").disabled = true;
            window.currentCardPosition -= 1;
            let words = await getWordsByCardId(window.cards[window.currentCardPosition - 1].id);
            document.getElementById("prev").disabled = false;
            let div = document.getElementById("test");
            while (div.lastChild != null) {
                div.removeChild(div.lastChild);
            }
            let positionDiv = document.getElementById("position");
            positionDiv.innerHTML = window.currentCardPosition + "/" + window.AllCards;
            document.getElementById("text").innerHTML = window.cards[window.currentCardPosition - 1].text;
        }

    </script>

</head>

<body>

    <div id="text">
    </div>
    <input type="text" oninput="input(event)"></input>
    <div id="position"></div>
    <button onclick="prev()" id="prev"> prev </button> <button onclick="next()" id="next"> next </button>
    <div id="test">

    </div>
</body>

</html>