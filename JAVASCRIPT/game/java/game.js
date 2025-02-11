const parts = [
    { name: "RAM", image: "image/RAM.png" },
    { name: "CPU", image: "image/CPU.jpg" },
    { name: "Mouse", image: "image/mouse.png" },
    { name: "Keyboard", image: "image/keyboard.jpg" },
    { name: "Monitor", image: "image/monitor.jpg" },
    { name: "Printer", image: "image/printer.png" },
    { name: "Hard Drive", image: "image/drive.jpg" },
    { name: "Headphone", image: "image/headphone.png" },
    { name: "Motherboard", image: "image/motherboard.jpg" },
    { name: "Scanner", image: "image/scanner.png" }
];

let currentQuestion = 0;
let level1Completed = false;

// Load Level 1 Question
function loadLevel1() {
    document.getElementById("level1").style.display = "block";
    document.getElementById("level2").style.display = "none";
    document.getElementById("congrats").style.display = "none";

    if (currentQuestion >= parts.length) {
        showCongratulations(1);
        return;
    }

    document.getElementById("progress").textContent = ${currentQuestion}/10;
    let question = parts[currentQuestion];

    document.getElementById("level1-image").src = question.image;

    let options = getRandomOptions(question.name);
    document.getElementById("option1").textContent = options[0];
    document.getElementById("option2").textContent = options[1];
    document.getElementById("option3").textContent = options[2];

    document.getElementById("message").textContent = "";
}

// Generate random wrong answers
function getRandomOptions(correctAnswer) {
    let wrongAnswers = parts
        .map(part => part.name)
        .filter(name => name !== correctAnswer)
        .sort(() => Math.random() - 0.5)
        .slice(0, 2);

    let options = [correctAnswer, ...wrongAnswers];
    return options.sort(() => Math.random() - 0.5);
}

// Check Level 1 Answer
function checkLevel1Answer(button) {
    let correctAnswer = parts[currentQuestion].name;
    if (button.textContent === correctAnswer) {
        currentQuestion++;
        loadLevel1();
    } else {
        document.getElementById("message").textContent = "Wrong! ❌ Try Again.";
    }
}

// Show Congratulations Screen
function showCongratulations(level) {
    document.getElementById("level1").style.display = "none";
    document.getElementById("level2").style.display = "none";
    document.getElementById("congrats").style.display = "block";

    if (level === 1) {
        document.getElementById("congrats-message").textContent = "You've completed Level 1! 👑 Do you want to continue?";
        document.getElementById("next-level-btn").style.display = "block";
    } else {
        document.getElementById("congrats-message").textContent = "Congratulations! 👑You've completed the game!";
        document.getElementById("next-level-btn").style.display = "none";
    }
}

// Load Level 2
function loadLevel2() {
    document.getElementById("level1").style.display = "none";
    document.getElementById("level2").style.display = "block";
    document.getElementById("congrats").style.display = "none";
    document.getElementById("level").textContent = "2";
    currentQuestion = 0;
    loadLevel2Question();
}

// Load a Level 2 Question
function loadLevel2Question() {
    if (currentQuestion >= parts.length) {
        showCongratulations(2);
        return;
    }

    let question = parts[currentQuestion];
    document.getElementById("level2-name").textContent = question.name;

    let images = getRandomImages(question.image);
    document.getElementById("image1").src = images[0];
    document.getElementById("image2").src = images[1];
    document.getElementById("image3").src = images[2];

    document.getElementById("message").textContent = "";
}

// Generate random image options
function getRandomImages(correctImage) {
    let wrongImages = parts
        .map(part => part.image)
        .filter(image => image !== correctImage)
        .sort(() => Math.random() - 0.5)
        .slice(0, 2);

    let images = [correctImage, ...wrongImages];
    return images.sort(() => Math.random() - 0.5);
}
// Check Level 2 Answer
function checkLevel2Answer(img) {
    let correctImage = parts[currentQuestion].image;
    if (img.src.includes(correctImage)) {
        currentQuestion++;
        loadLevel2Question();
    } else {
        document.getElementById("message").textContent = "Wrong! ❌ Try Again.";
    }
}

// Reset the game
function resetGame() {
    currentQuestion = 0;
    document.getElementById("level").textContent = "1";
    loadLevel1();
}

// Initialize game
window.onload = loadLevel1;