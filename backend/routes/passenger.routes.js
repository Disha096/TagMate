const express = require("express");
const bcrypt = require("bcryptjs");
const router = express.Router();

const Passenger = require("../models/Passenger");
const Counter = require("../models/Counter");
const { passengerContract } = require("../utils/blockchain"); // ✅ ADD
/* =========================
   PASSENGER REGISTER
========================= */
router.post("/register", async (req, res) => {

  try {

    console.log("📥 Register:", req.body);

    const { name, email, password, confirmPassword } = req.body;

    /* Validation */
    if (!name || !email || !password || !confirmPassword) {
      return res.status(400).json({ message: "All fields required" });
    }

    if (password !== confirmPassword) {
      return res.status(400).json({ message: "Passwords do not match" });
    }

    /* Check existing */
    const existing = await Passenger.findOne({ email });

    if (existing) {
      return res.status(400).json({ message: "Email already registered" });
    }

    /* Auto ID */
    const counter = await Counter.findOneAndUpdate(
      { name: "passengerId" },
      { $inc: { value: 1 } },
      { new: true, upsert: true }
    );

    const passengerId =
      "PSG" + counter.value.toString().padStart(3, "0");

    /* Hash */
    const hash = await bcrypt.hash(password, 10);

    /* Save */
    const passenger = await Passenger.create({
      passengerId,
      name,
      email,
      password: hash
    });

    console.log("✅ Saved:", passenger);

    res.json({
      message: "Registered successfully",
      passengerId
    });

  } catch (err) {

    console.error("❌ Register Error:", err);

    res.status(500).json({ message: "Server error" });
  }
});


/* =========================
   PASSENGER LOGIN
========================= */
router.post("/login", async (req, res) => {

  try {

    console.log("📥 Login:", req.body);

    const { email, password } = req.body;

    if (!email || !password) {
      return res.status(400).json({ message: "All fields required" });
    }

    const passenger = await Passenger.findOne({ email });

    if (!passenger) {
      return res.status(400).json({ message: "Invalid email or password" });
    }

    const match = await bcrypt.compare(password, passenger.password);

    if (!match) {
      return res.status(400).json({ message: "Invalid email or password" });
    }

    res.json({
      message: "Login successful",
      passengerId: passenger.passengerId,
      name: passenger.name
    });

  } catch (err) {

    console.error("❌ Login Error:", err);

    res.status(500).json({ message: "Server error" });
  }
});
/* =========================
   SAVE HISTORY (BLOCKCHAIN)
========================= */
router.post("/history", async (req, res) => {

  try {

    console.log("📦 Blockchain Save:", req.body);

    const { passengerId, name, location, bags } = req.body;

    if (!passengerId || !name || !location || bags == null) {
      return res.status(400).json({
        message: "All fields required"
      });
    }

    // Send to blockchain
    const tx = await passengerContract.addPassengerRecord(
      passengerId,
      name,
      location,
      bags
    );

    await tx.wait();

    res.json({
      message: "Saved on blockchain",
      txHash: tx.hash
    });

  } catch (err) {

    console.error("❌ Blockchain Save Error:", err);

    res.status(500).json({
      message: "Blockchain error"
    });
  }
});


/* =========================
   GET HISTORY (BLOCKCHAIN)
========================= */
router.get("/history", async (req, res) => {

  try {

    console.log("📖 Fetching Blockchain History");

    const records =
      await passengerContract.getAllRecords();

    const formatted = records.map(r => ({
      passengerId: r.passengerId,
      name: r.name,
      location: r.location,
      bags: Number(r.bags),
      time: new Date(Number(r.time) * 1000)
    }));

    res.json(formatted);

  } catch (err) {

    console.error("❌ Blockchain Fetch Error:", err);

    res.status(500).json({
      message: "Blockchain error"
    });
  }
});

module.exports = router;