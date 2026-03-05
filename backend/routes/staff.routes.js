const express = require("express");
const router = express.Router();
const Staff = require("../models/Staff");

const {
  hashPassword,
  comparePassword
} = require("../utils/hash");

/* ============================
   STAFF LOGIN
============================ */

router.post("/login", async (req, res) => {
  try {

    const { email, password } = req.body;

    if (!email || !password) {
      return res.status(400).json({
        message: "Email and password required"
      });
    }

    const staff = await Staff.findOne({
      email: email.toLowerCase()
    });

    if (!staff) {
      return res.status(400).json({
        message: "Invalid email or password"
      });
    }

    // Compare password
    const isMatch = await comparePassword(
      password,
      staff.password
    );

    if (!isMatch) {
      return res.status(400).json({
        message: "Invalid email or password"
      });
    }

    res.json({
      message: "Login successful",
      staff: {
        staffId: staff.staffId,
        name: staff.name,
        role: staff.role,
        email: staff.email
      }
    });

  } catch (err) {

    console.error("❌ Staff Login Error:", err);

    res.status(500).json({
      message: "Server error"
    });
  }
});

module.exports = router;