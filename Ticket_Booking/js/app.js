function search() {
    window.location = "results.html";
}

function openFare() {
    document.getElementById("fareModal").style.display = "block";
}

function closeFare() {
    document.getElementById("fareModal").style.display = "none";
}

function goDetails() {
    window.location = "details.html";
}

function openPayment() {
    document.getElementById("paymentModal").style.display = "block";
}

function closePayment() {
    document.getElementById("paymentModal").style.display = "none";
}

function payCounter() {
    window.location = "confirmation.html";
}

function payOnline() {
    document.getElementById("loader").classList.remove("hidden");
    setTimeout(() => {
        window.location = "confirmation.html";
    }, 2000);
}
