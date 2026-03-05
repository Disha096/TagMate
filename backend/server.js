require("dotenv").config();
const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");

const app = express();


/* ======================
   MIDDLEWARE
====================== */

app.use(cors());
app.use(express.json());


/* ======================
   DATABASE
====================== */

mongoose.connect("mongodb://127.0.0.1:27017/tagmate")
.then(() => console.log("✅ MongoDB Connected"))
.catch(err => console.error("❌ Mongo Error:", err));

/* ======================
   STAFF ROUTES  ✅ ADD THIS
====================== */

app.use("/api/staff",
  require("./routes/staff.routes")
);


/* ======================
   BAG MODEL
====================== */

const bagSchema = new mongoose.Schema({

  bagId: { type: String, unique: true },

  ticketId: String,

  from: String,

  to: String,

  type: String,

  weight: Number,

  status: { type: String, default: "Registered" },

  location: String

},{ timestamps:true });


const Bag = mongoose.model("Bag", bagSchema);


/* ======================
   PASSENGER ROUTES
====================== */

app.use(
  "/api/passenger",
  require("./routes/passenger.routes")
);


/* ======================
   BAG ROUTES
====================== */

app.post("/api/bag/register", async (req, res) => {

  try {

    console.log("📥 Bag:", req.body);

    let { ticketId, from, to, type, weight } = req.body;

    if (!ticketId || !from || !to || !type || !weight) {
      return res.status(400).json({ message: "All fields required" });
    }

    weight = Number(weight);

    const bagId = "BG" + Date.now();

    const bag = new Bag({

      bagId,
      ticketId,
      from,
      to,
      type,
      weight,
      location: from

    });

    await bag.save();

    console.log("✅ Bag Saved:", bagId);

    res.json({
      success: true,
      bagId
    });

  } catch (err) {

    console.error("❌ Bag Error:", err);

    res.status(500).json({
      message: "Server Error"
    });
  }

});


app.get("/api/bag/all", async (req, res) => {

  try {

    const bags = await Bag.find().sort({ createdAt: -1 });

    res.json(bags);

  } catch (err) {

    console.error("❌ Fetch Error:", err);

    res.status(500).json({ message: "Server Error" });
  }

});


app.post("/api/bag/update", async (req, res) => {

  try {

    const { bagId, status, location } = req.body;

    if (!bagId) {
      return res.status(400).json({ message: "Bag ID required" });
    }

    await Bag.findOneAndUpdate(
      { bagId },
      { status, location }
    );

    res.json({
      success: true,
      message: "Updated"
    });

  } catch (err) {

    console.error("❌ Update Error:", err);

    res.status(500).json({ message: "Server Error" });
  }

});
/* ======================
   GET BAG BY TICKET ID
====================== */

app.get("/api/bag/track/:ticketId", async (req, res) => {

  try {

    const ticketId = req.params.ticketId;

    console.log("🔍 Tracking:", ticketId);

    const bags = await Bag.find({ ticketId });

    if (bags.length === 0) {
      return res.status(404).json({
        message: "No baggage found for this ticket"
      });
    }

    res.json(bags);

  }
  catch(err){

    console.error("❌ Track Error:", err);

    res.status(500).json({
      message: "Server error"
    });

  }

});


/* ======================
   SERVER
====================== */

app.listen(5000, () => {
  console.log("🚀 Server running on port 5000");
});