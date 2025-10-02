<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['staff_id'])) {
    header("Location: staff_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff Dashboard - TagMate</title>
<link rel="stylesheet" href="staffDashboardstyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>

 * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Taurus, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
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

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        .main-content {
            padding: 2rem 0;
        }

        .hero {
            text-align: center;
            color: white;
            margin-bottom: 3rem;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease-out;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .dashboard {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .tabs {
            display: flex;
            margin-bottom: 2rem;
            border-bottom: 2px solid #f1f1f1;
        }

        .tab {
            padding: 1rem 2rem;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            color: #666;
            transition: all 0.3s;
            border-bottom: 3px solid transparent;
        }

        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        .register-form {
            display: grid;
            gap: 1.5rem;
        }

        .form-group {
            display: grid;
            gap: 0.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        label {
            font-weight: 600;
            color: #333;
        }

        input, select {
            padding: 0.8rem;
            border: 2px solid #e1e1e1;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .baggage-list {
            display: grid;
            gap: 1rem;
        }

        .baggage-item {
            background: #f8f9ff;
            padding: 1.5rem;
            border-radius: 15px;
            border: 2px solid #e1e8ff;
            position: relative;
            overflow: hidden;
        }

        .baggage-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .baggage-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .baggage-id {
            font-weight: bold;
            color: #333;
            font-size: 1.1rem;
        }

        .status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .status.in-transit {
            background: #fff3cd;
            color: #856404;
        }

        .status.arrived {
            background: #d1edff;
            color: #0c5460;
        }

        .status.delivered {
            background: #d4edda;
            color: #155724;
        }

        .tracking-timeline {
            display: grid;
            gap: 1rem;
            margin-top: 1rem;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem;
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-title {
            font-weight: 600;
            color: #333;
        }

        .timeline-time {
            color: #666;
            font-size: 0.9rem;
        }

        .notifications {
            background: #f8f9ff;
            border-radius: 15px;
            padding: 1rem;
            margin-top: 2rem;
        }

        .notification {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            margin-bottom: 1rem;
            border-left: 4px solid #667eea;
        }

        .notification:last-child {
            margin-bottom: 0;
        }

        .notification-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #667eea;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .nfc-demo {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            margin-bottom: 2rem;
        }

        .nfc-tag {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border: 3px solid white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 1rem auto;
            font-size: 2rem;
            animation: pulse 2s infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
        }

        #staffName{
            font-size: 1rem;
            font-weight: bold;
            color: white;
        }

        .btn-logout{
            font-size: 1rem;
            font-weight: bold;
            color: white;
        }
        

</style>
</head>
<body>


<div class="app active">
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo">🏷️ Tag Mate</div>
                <div class="nav-links">
                    <span id="staffName" >Staff: <?php echo htmlspecialchars($_SESSION['staff_name']); ?></span>
                    <a href="logout.php" class="btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    </div>

    <div class="container">
        <div class="main-content">
            <div class="hero">
                <h1>Never Lose Your Baggage Again</h1>
                <p>Secure blockchain-powered baggage tracking with NFC technology</p>
            </div>

    <div class="container">
        <!-- Tab Card -->
        <div class="tab-card">
            <div class="tabs">
                <button class="tab-btn active" data-tab="register">Register Baggage</button>
                <button class="tab-btn" data-tab="update">Update Baggage</button>
                <button class="tab-btn" data-tab="track">Track Baggage</button>
            </div>

            <div class="tab-content active" id="register">
                <h2>Register Baggage</h2>

                <div class="nfc-demo">
                        <h3>Step 1: NFC Tag Registration</h3>
                        <div class="nfc-tag">
                            <i class="fas fa-wifi"></i>
                        </div>
                        <p>Tap your phone to the NFC tag on your baggage</p>
                    </div>
                <form id="baggageForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Flight Number</label>
                            <input type="text" id="flightNumber" placeholder = "AI 101"  required>
                        </div>
                        <div class="form-group">
                            <label>Departure Date</label>
                            <input type="date" id="departureDate" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>From</label>
                            <input type="text" id="fromAirport" placeholder="Mumbai (BOM)"  required>
                        </div>
                        <div class="form-group">
                            <label>To</label>
                            <input type="text" id="toAirport" placeholder="Delhi (DEL)"  required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Baggage Type</label>
                            <select id="baggageType">
                                <option>Checked Baggage</option>
                                <option>Cabin Baggage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Weight (kg)</label>
                            <input type="number" id="baggageWeight" placeholder="23" value="23" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" id="baggageDesc" placeholder="Black suitcase with silver handle" value="Black suitcase with silver handle">
                    </div>

                    <button type="button" class="btn" onclick="registerBaggage()">
                        <i class="fas fa-plus"></i> Register Baggage & Mint NFT
                    </button>
                </form>
            </div>

            <div class="tab-content" id="update">
            <h2>Update Baggage</h2>
            <form id="updateForm">
                <div class="form-row">
                    <div class="form-group">
                        <label>Select Baggage</label>
                        <select id="updateBagSelect" required>
                            <option value="">-- Select a Bag --</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="updateStatus" required>
                            <option>Registered</option>
                            <option>Checked-in</option>
                            <option>Loaded</option>
                            <option>In-Transit</option>
                            <option>Delivered</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" id="updateLocation" placeholder="Enter current location" required>
                    </div>
                </div>

                <button type="button" class="btn" onclick="updateBaggage()">
                    <i class="fas fa-edit"></i> Update Baggage
                </button>
            </form>
        </div>


            <div class="tab-content" id="track">
                <h2>Track Baggage</h2>
                <div class="bag-table" id="staffBagTable"></div>
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

// Sample baggage data
let bags = [
    { id: "BG101", status: "Checked-in", location: "Airport A" },
    { id: "BG102", status: "Loaded", location: "Flight 101" },
    { id: "BG103", status: "In-Transit", location: "Transit Hub" }
];

function renderStaffTable() {
    const container = document.getElementById('staffBagTable');
    container.innerHTML = `<h2>Registered Baggage</h2>
        <table>
            <thead>
                <tr><th>ID</th><th>Status</th><th>Location</th><th>Actions</th></tr>
            </thead>
            <tbody>
                ${bags.map(b => `<tr>
                    <td>${b.id}</td>
                    <td>${b.status}</td>
                    <td>${b.location}</td>
                    <td>
                        <button class="btn-preview" data-id="${b.id}">Preview</button>
                        <button class="btn-delete" data-id="${b.id}">Delete</button>
                    </td>
                </tr>`).join('')}
            </tbody>
        </table>`;

    container.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', e => {
            const id = e.target.dataset.id;
            bags = bags.filter(b => b.id !== id);
            renderStaffTable();
        });
    });

    container.querySelectorAll('.btn-preview').forEach(btn => {
        btn.addEventListener('click', e => {
            const b = bags.find(b => b.id === e.target.dataset.id);
            alert(`Previewing baggage:\nID: ${b.id}\nStatus: ${b.status}\nLocation: ${b.location}`);
        });
    });
}

renderStaffTable();

// Register new baggage
function registerBaggage() {
    const id = "BG" + (Math.floor(Math.random() * 900 + 100));
    const newBag = {
        id: id,
        status: "Registered",
        location: document.getElementById('fromAirport').value
    };
    bags.push(newBag);
    renderStaffTable();
    alert("Baggage registered successfully with ID: " + id);
    document.getElementById('baggageForm').reset();
}
</script>

<script>
    // Fetch bags from DB and render
function fetchBags() {
    fetch('get_baggage.php')
        .then(res => res.json())
        .then(data => {
            bags = data;
            renderStaffTable();
            populateUpdateDropdown();
        });
}

// Render Table
function renderStaffTable() {
    const container = document.getElementById('staffBagTable');
    container.innerHTML = `<h2>Registered Baggage</h2>
        <table>
            <thead>
                <tr><th>ID</th><th>Flight</th><th>Status</th><th>Location</th><th>Actions</th></tr>
            </thead>
            <tbody>
                ${bags.map(b => `<tr>
                    <td>${b.bag_id}</td>
                    <td>${b.flight_number}</td>
                    <td>${b.status}</td>
                    <td>${b.location}</td>
                    <td>
                        <button class="btn-preview" data-id="${b.bag_id}">Preview</button>
                        <button class="btn-delete" data-id="${b.bag_id}">Delete</button>
                    </td>
                </tr>`).join('')}
            </tbody>
        </table>`;

    container.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', e => {
            const id = e.target.dataset.id;
            if(confirm("Delete this baggage?")){
                fetch(`delete_baggage.php?bag_id=${id}`)
                    .then(()=>fetchBags());
            }
        });
    });

    container.querySelectorAll('.btn-preview').forEach(btn => {
        btn.addEventListener('click', e => {
            const b = bags.find(b => b.bag_id === e.target.dataset.id);
            alert(`Preview:\nID: ${b.bag_id}\nFlight: ${b.flight_number}\nStatus: ${b.status}\nLocation: ${b.location}`);
        });
    });
}

// Register baggage
function registerBaggage() {
    const data = {
        flight_number: document.getElementById('flightNumber').value,
        departure_date: document.getElementById('departureDate').value,
        from_airport: document.getElementById('fromAirport').value,
        to_airport: document.getElementById('toAirport').value,
        baggage_type: document.getElementById('baggageType').value,
        weight: document.getElementById('baggageWeight').value,
        description: document.getElementById('baggageDesc').value
    };

    fetch('register_baggage.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(resp => {
        if(resp.status === "success"){
            alert("Registered with ID: " + resp.bag_id);
            document.getElementById('baggageForm').reset();
            fetchBags();
        } else {
            alert("Error: " + resp.msg);
        }
    });
}

// Initial fetch
fetchBags();

</script>
<script>
    // Populate the Update dropdown whenever bags change
function populateUpdateDropdown() {
    const select = document.getElementById('updateBagSelect');
    select.innerHTML = `<option value="">-- Select a Bag --</option>`;
    bags.forEach(b => {
        select.innerHTML += `<option value="${b.bag_id}">${b.bag_id} - ${b.flight_number}</option>`;
    });
}

// Call after fetching bags
// function fetchBags() {
//     fetch('get_baggage.php')
//         .then(res => res.json())
//         .then(data => {
//             bags = data;
//             renderStaffTable();
//             populateUpdateDropdown();
//         });
// }

// When a bag is selected, fill current status/location
document.getElementById('updateBagSelect').addEventListener('change', e => {
    const bag = bags.find(b => b.bag_id === e.target.value);
    if(bag){
        document.getElementById('updateStatus').value = bag.status;
        document.getElementById('updateLocation').value = bag.location || bag.from_airport;
    } else {
        document.getElementById('updateStatus').value = 'Registered';
        document.getElementById('updateLocation').value = '';
    }
});

// Update baggage
function updateBaggage() {
    const bag_id = document.getElementById('updateBagSelect').value;
    const status = document.getElementById('updateStatus').value;
    const location = document.getElementById('updateLocation').value;

    if(!bag_id){
        alert("Please select a bag!");
        return;
    }

    fetch('update_baggage.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ bag_id, status, location })
    })
    .then(res => res.json())
    .then(resp => {
        if(resp.status === "success"){
            alert("Baggage updated successfully!");
            fetchBags(); // refresh table & dropdown
        } else {
            alert("Error: " + resp.msg);
        }
    });
}

</script>

</body>
</html>
