<html>

<head>
    <title>
        добавление карточки
    </title>
    <style>
        .complite {
            background-color: greenyellow;
        }
    </style>
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
                let br = document.createElement('br');
                p.innerHTML = word.word + "   :";
                input.id = word.id;
                input.oninput = translationComparison;
                let div = document.getElementById("test");
                div.append(p);
                div.append(input);
                div.append(br);
            }
        }

        function input(event) {
            let card = window.cards[window.currentCardPosition - 1];
            if (event.target.value == card.text) {
                createTest(card.words);
                event.target.classList.add("complite");
            }
        }

        async function translationComparison(event) {
            let card = window.cards[window.currentCardPosition - 1];
            let words = card.words;
            let id = event.target.id;
            let word = null;
            for (let i = 0; i != words.length; i++) {
                if (words[i].id == id) {
                    word = words[i];
                }
            }
            if (word.translation == event.target.value) {
                event.target.classList.add("complite");
                let url = "/increment/" + word.id;
                console.log(url);
                let response = await fetch(url);
                window.countOfRightWords += 1;
                if (window.countOfRightWords == words.length) {
                    window.countOfRightWords = 0;
                    next();
                    
                }
            }

        }

        document.addEventListener("DOMContentLoaded", async function () {
            window.countOfRightWords = 0;
            let cards = await getCards();
            for (let i = 0; i != cards.length; i++) {
                cards[i].words = await getWordsByCardId(cards[i].id);
            }
            window.cards = cards;
            window.currentCardPosition = 1;
            window.AllCards = cards.length;
            let positionDiv = document.getElementById("position");
            positionDiv.innerHTML = window.currentCardPosition + "/" + window.AllCards;
            document.getElementById("text").innerHTML = cards[window.currentCardPosition - 1].text;
        });

        async function next() {
            window.currentCardPosition += 1;
            let div = document.getElementById("test");
            while (div.lastChild != null) {
                div.removeChild(div.lastChild);
            }
            let positionDiv = document.getElementById("position");
            positionDiv.innerHTML = window.currentCardPosition + "/" + window.AllCards;
            document.getElementById("text").innerHTML = window.cards[window.currentCardPosition - 1].text;
        }
        async function prev() {
            window.currentCardPosition -= 1;
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