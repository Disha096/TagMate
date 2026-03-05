const mongoose = require("mongoose");
const Counter = require("./Counter");

const StaffSchema = new mongoose.Schema({

  staffId: {
    type: String,
    unique: true
  },

  name: {
    type: String,
    required: true
  },

  email: {
    type: String,
    required: true,
    unique: true,
    lowercase: true
  },

  password: {
    type: String,
    required: true
  },

  role: {
    type: String,
    enum: ["admin", "staff", "manager"],
    default: "staff"
  },

  createdAt: {
    type: Date,
    default: Date.now
  }

});


// ✅ AUTO INCREMENT staffId
StaffSchema.pre("save", async function (next) {

  if (this.staffId) return next();

  try {

    const counter = await Counter.findOneAndUpdate(
      { name: "staff" },              // counter name
      { $inc: { value: 1 } },         // increase value
      { new: true, upsert: true }     // create if not exists
    );

    this.staffId =
      "STF" + counter.value.toString().padStart(3, "0");

    next();

  } catch (err) {
    next(err);
  }

});


module.exports = mongoose.model("Staff", StaffSchema, "staffs");