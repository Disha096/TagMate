<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['passenger_id'])) {
    header("Location: passengerLogin.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Passenger Dashboard - TagMate</title>
<link rel="stylesheet" href="staffDashboardstyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ===== Shared CSS from Staff Dashboard ===== */
* { 
    margin:0; 
    padding:0; 
    box-sizing:border-box; 
}

body { 
    
    font-family:'Segoe UI', sans-serif;
     background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
      min-height:100vh;
       line-height:1.6;
    }

.container { 
    max-width:1200px; 
    margin:0 auto; 
    padding:0 20px; 
}

.navbar { 
    background: rgba(255,255,255,0.1); 
    backdrop-filter: blur(10px); padding:1rem 0; 
    border-bottom:1px solid rgba(255,255,255,0.2);
}

.nav-content { 
    display:flex; 
    justify-content:space-between; 
    align-items:center; 
}

.logo { 
    font-size:1.8rem; 
    font-weight:bold; 
    color:white; 
}

.nav-links { 
    display:flex; 
    gap:2rem; 
}

.nav-links span, .nav-links a { 
    color:white; 
    font-weight:bold; 
}

.main-content { 
    padding:2rem 0;
}

.hero { 
    text-align:center; 
    color:white; 
    margin-bottom:3rem; 
}

.hero h1 { 
    font-size:3rem; 
    margin-bottom:1rem; 
    animation: fadeInUp 1s ease-out; 
}

.hero p { 
    font-size:1.2rem; 
    opacity:0.9; 
    animation: fadeInUp 1s ease-out 0.2s both; 
}

.tab-card { 
    background: rgba(255,255,255,0.95); 
    border-radius:20px; 
    padding:2rem; 
    box-shadow:0 20px 40px rgba(0,0,0,0.1); 
}

.tabs { 
    display:flex; 
    margin-bottom:2rem; 
    border-bottom:2px solid #f1f1f1; 
}

.tab-btn { 
    padding:1rem 2rem; 
    background:none; border:none; 
    cursor:pointer; font-size:1rem; 
    color:#666; transition:all 0.3s; 
    border-bottom:3px ; 
}

.tab-btn.active { 
    color:#667eea; 
    border-bottom-color:#667eea; 
}

.tab-content { 
    display:none; 
}

.tab-content.active { 
    display:block; 
    animation: fadeIn 0.5s ease-out; 
}

table { 
    width:100%; 
    border-collapse: 
    collapse; margin-top:1rem; 
}

table th, table td { 
    border:1px solid #e1e1e1; 
    padding:0.8rem; 
    text-align:left; 
}

table th { 
    background:#f1f1f1; 
}

.btn { 
    background:linear-gradient(135deg,#667eea 0%,#764ba2 100%); 
    color:white; border:none; padding:1rem 2rem; 
    border-radius:10px; font-size:1rem; cursor:pointer; 
    transition: transform 0.3s, box-shadow 0.3s; 
}

.btn:hover { 
    transform:translateY(-2px); 
    box-shadow:0 10px 20px rgba(102,126,234,0.3); 
}


@keyframes fadeInUp { 
    from {opacity:0; transform:translateY(30px);} 
    to {opacity:1; transform:translateY(0);} 
}

@keyframes fadeIn { 
    from {opacity:0;}
     to {opacity:1;} 
}

@media(max-width:768px) {
    .hero h1 { font-size:2rem; }
    .nav-links { display:none; }
}

/* Baggage table styles */
.bag-table h2 { 
    margin-bottom:1rem; 
    color:#333; 
}

.bag-table table { 
    border-radius:10px; 
    overflow:hidden; 
}

.bag-table th { 
    background:#667eea; 
    color:white; 
}

.bag-table td { 
    background:#f8f9ff; 
}

.help-text {
    padding: 1rem;
    background: #f8f9ff;
    border-radius: 15px;
} 


</style>

<style>
    

/* Base styles from staff dashboard, simplified for passenger view */
/* body {
    font-family: 'Segoe UI', Taurus, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    color: #333;
}
.navbar {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 1rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}
.nav-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.logo {
    font-size: 1.8rem;
    font-weight: bold;
    color: white;
}
.nav-links span, .nav-links a {
    color: white;
    font-weight: bold;
    margin-left: 1rem;
}
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}
.hero {
    text-align: center;
    color: white;
    margin-bottom: 3rem;
}
.hero h1 {
    font-size: 2.5rem;
}
.hero p {
    font-size: 1.2rem;
    opacity: 0.9;
}
.tab-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}
.tabs {
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
    border-bottom: 2px solid #f1f1f1;
}
.tab-btn {
    padding: 1rem 2rem;
    cursor: pointer;
    border: none;
    background: none;
    font-size: 1rem;
    color: #666;
    border-bottom: 3px solid transparent;
    transition: all 0.3s;
}
.tab-btn.active {
    color: #667eea;
    border-bottom-color: #667eea;
}
.tab-content {
    display: none;
}
.tab-content.active {
    display: block;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}
th, td {
    border: 1px solid #e1e1e1;
    padding: 0.75rem;
    text-align: left;
}
th {
    background: #f1f1f1;
}
.status {
    padding: 0.3rem 0.6rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.9rem;
}
.status.in-transit { background: #fff3cd; color: #856404; }
.status.arrived { background: #d1edff; color: #0c5460; }
.status.delivered { background: #d4edda; color: #155724; }
.help-text {
    padding: 1rem;
    background: #f8f9ff;
    border-radius: 15px;
} */
</style>


</head>
<body>

<div class="navbar">
    <div class="container nav-content">
        <div class="logo">🏷️ Tag Mate</div>
        <div class="nav-links">
            <span>Passenger: <?php echo htmlspecialchars($_SESSION['passenger_name']); ?></span>
            <a href="selection.html">Logout</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="hero">
        <h1>Never Lose Your Baggage Again</h1>
        <p>Track your baggage in real-time with NFC & blockchain</p>
    </div>

    <div class="tab-card">
        <div class="tabs">
            <button class="tab-btn active" data-tab="track">Track Baggage</button>
            <button class="tab-btn" data-tab="help">Help</button>
        </div>

        <div class="tab-content active" id="track">
            <div id="passengerBagTable"></div>
        </div>

        <div class="tab-content" id="help">
            <div class="help-text">
                <h3>How to Track Your Baggage</h3>
                <ul>
                    <li>Go to the Track Baggage tab.</li>
                    <li>Enter your Baggage ID or Flight Number.</li>
                    <li>See the current status and location of your baggage.</li>
                    <li>For further assistance, contact airport support.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
const tabs = document.querySelectorAll('.tab-btn');
const contents = document.querySelectorAll('.tab-content');
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        contents.forEach(c => c.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById(tab.dataset.tab).classList.add('active');
    });
});

// Fetch baggage for logged-in passenger
let bags = [];
function fetchBags() {
    fetch('get_baggage.php?passenger_id=<?php echo $_SESSION['passenger_id']; ?>')
    .then(res => res.json())
    .then(data => {
        bags = data;
        renderTable();
    });
}

function renderTable() {
    const container = document.getElementById('passengerBagTable');
    if(bags.length === 0){
        container.innerHTML = "<p>No baggage registered yet.</p>";
        return;
    }

    container.innerHTML = `<table>
        <thead>
            <tr><th>ID</th><th>Flight</th><th>Status</th><th>Location</th></tr>
        </thead>
        <tbody>
            ${bags.map(b => `<tr>
                <td>${b.bag_id}</td>
                <td>${b.flight_number}</td>
                <td><span class="status ${b.status.toLowerCase()}">${b.status}</span></td>
                <td>${b.location}</td>
            </tr>`).join('')}
        </tbody>
    </table>`;
}

// Initial fetch
fetchBags();
</script>

</body>
</html>
