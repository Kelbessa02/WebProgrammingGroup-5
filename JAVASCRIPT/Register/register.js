// general console
// String to Number
let strNumber = "123";
let convertedNumber = Number(strNumber);
console.log("String to Number:", convertedNumber, "Type:", typeof convertedNumber);

// Number to String
let num = 456;
let convertedString = String(num);
console.log("Number to String:", convertedString, "Type:", typeof convertedString);

let age = 18;
if (age >= 18) {
    console.log("You are eligible to vote.");
} else {
    console.log("You are not eligible to vote.");
}

// For Loop
console.log("For Loop:");
for (let i = 1; i <= 5; i++) {
    console.log("Iteration:", i);
}

// While Loop
console.log("While Loop:");
let count = 1;
while (count <= 3) {
    console.log("Count:", count);
    count++;
}

// Do-While Loop
console.log("Do-While Loop:");
let num2 = 1;
do {
    console.log("Number:", num2);
    num2++;
} while (num2 <= 3);

let fruits = ["Apple", "Banana", "Cherry"];
console.log("Single Array:", fruits);

// Accessing elements
console.log("First fruit:", fruits[0]);

let multiArray = [
    ["John", 25],
    ["Alice", 30],
    ["Bob", 22]
];

console.log("Multi-Dimensional Array:", multiArray);

// Accessing specific elements
console.log("First Person's Name:", multiArray[0][0]);
console.log("Second Person's Age:", multiArray[1][1]);

// // general console
document.getElementById("registrationForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        document.getElementById('emailError').innerHTML = 'Please enter a valid email.';
        valid = false;
    }
    document.getElementById('password').value;
    // Validate Password
    const password = document.getElementById('password').value;
    if (password.length < 6) {
        document.getElementById('passwordError').innerHTML = 'Password must be at least 6 characters long.';
        valid = false;

    }
    const phone = document.getElementById("phone").value;
    const termsAccepted = document.getElementById("terms").checked;

    if (name && email && phone && termsAccepted) {
        alert("Welcome to our website!" + "../../Web Folder/index.html");
        window.location.href = "../../Web Folder/index.html";
    } else {
        alert("Please fill in all fields and accept the terms.");
    }
});