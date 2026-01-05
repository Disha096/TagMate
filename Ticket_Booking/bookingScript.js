function showFlights() {
    document.getElementById("results").style.display = "block";
}

function openPayment() {
    document.getElementById("overlay").style.display = "block";
}

function payCounter() {
    alert("Booking Confirmed!\nPayment at Counter");
    closePayment();
}

function payOnline() {
    const status = document.getElementById("paymentStatus");
    status.innerText = "Processing payment...";
    setTimeout(() => {
        status.innerText = "Payment Successful ✅";
        setTimeout(closePayment, 1000);
    }, 2000);
}

function closePayment() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("paymentStatus").innerText = "";
}

let adults = 1, children = 0, infants = 0;
let travelClass = "Economy";

function toggleTravellerPopup() {
    const popup = document.getElementById("travellerPopup");
    popup.style.display = popup.style.display === "block" ? "none" : "block";
}

function setCount(type, value) {
    if (type === "adult") adults = value;
    if (type === "child") children = value;
    if (type === "infant") infants = value;

    // remove active from same group
    const group = event.target.parentElement.querySelectorAll("button");
    group.forEach(btn => btn.classList.remove("active"));

    // add active to clicked
    event.target.classList.add("active");
}


function setClass(btn) {
    document.querySelectorAll(".class-options button")
        .forEach(b => b.classList.remove("active"));
    btn.classList.add("active");
    travelClass = btn.innerText;
}

function applyTraveller() {
    const total = adults + children + infants;
    document.getElementById("travellerText").innerText = total + " Traveller";
    document.getElementById("classText").innerText = travelClass;
    document.getElementById("travellerPopup").style.display = "none";
}

// Calendar Pop-up 

function toggleCalendar() {
    const cal = document.getElementById("calendarPopup");
    cal.style.display = cal.style.display === "block" ? "none" : "block";
}

function setDate(value) {
    const date = new Date(value);
    const options = { day: 'numeric', month: 'short', year: '2-digit' };
    const day = date.toLocaleDateString('en-US', { weekday: 'long' });

    document.getElementById("depDate").innerText =
        date.toLocaleDateString('en-GB', options).replace(',', '');

    document.getElementById("depDay").innerText = day;
    document.getElementById("calendarPopup").style.display = "none";
}

// Airport Location
let activeField = "from";

function openAirport(type) {
    activeField = type;
    document.getElementById("airportPopup").style.display = "block";
}

function selectAirport(code, city, airport) {
    if (activeField === "from") {
        document.getElementById("fromCity").innerText = city;
        document.getElementById("fromCode").innerText = `${code}, ${airport}`;
    } else {
        document.getElementById("toCity").innerText = city;
        document.getElementById("toCode").innerText = `${code}, ${airport}`;
    }
    document.getElementById("airportPopup").style.display = "none";
}

