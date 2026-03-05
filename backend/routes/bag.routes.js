const express = require("express");

const Bag = require("../models/bag");
const Counter = require("../models/Counter");

const router = express.Router();

/* =========================
   REGISTER BAG
========================= */
router.post("/register", async (req, res) => {
  try {

    const {
      ticketId,
      flightId,
      from,
      to,
      type,
      weight
    } = req.body;

    if (!ticketId || !flightId || !from || !to || !type || !weight) {
      return res.status(400).json({
        message: "All fields are required"
      });
    }

    // Check ticket duplicate
    const existing = await Bag.findOne({ ticketId });

    if (existing) {
      return res.status(400).json({
        message: "This ticket is already registered"
      });
    }

    // Auto Bag ID
    const counter = await Counter.findOneAndUpdate(
      { name: "bagId" },
      { $inc: { value: 1 } },
      { new: true, upsert: true }
    );

    const bagId =
      `BAG${counter.value.toString().padStart(4, "0")}`;

    // Save
    const bag = await Bag.create({

      ticketId,
      bagId,

      flightId,
      from,
      to,

      type,
      weight,

      status: "Registered",
      location: from
    });

    res.json({
      message: "Baggage registered successfully",
      bagId: bag.bagId
    });

  } catch (err) {

    console.error("Bag Register Error:", err);

    res.status(500).json({
      message: "Server error"
    });
  }
});


/* =========================
   GET ALL BAGS
========================= */
router.get("/", async (req, res) => {
  try {

    const bags = await Bag.find().sort({ createdAt: -1 });

    res.json(bags);

  } catch (err) {

    res.status(500).json({
      message: "Server error"
    });
  }
});


/* =========================
   UPDATE BAG
========================= */
router.post("/update", async (req, res) => {
  try {

    const { bagId, status, location } = req.body;

    if (!bagId || !status || !location) {
      return res.status(400).json({
        message: "All fields required"
      });
    }

    const bag = await Bag.findOneAndUpdate(
      { bagId },
      { status, location },
      { new: true }
    );

    if (!bag) {
      return res.status(404).json({
        message: "Bag not found"
      });
    }

    res.json({
      message: "Baggage updated successfully"
    });

  } catch (err) {

    res.status(500).json({
      message: "Server error"
    });
  }
});


/* =========================
   GET BY TICKET ID
========================= */
router.get("/ticket/:ticketId", async (req, res) => {
  try {

    const bag = await Bag.findOne({
      ticketId: req.params.ticketId
    });

    if (!bag) {
      return res.status(404).json({
        message: "Bag not found"
      });
    }

    res.json(bag);

  } catch (err) {

    res.status(500).json({
      message: "Server error"
    });
  }
});

module.exports = router;