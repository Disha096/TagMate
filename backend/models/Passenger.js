const mongoose = require("mongoose");

const passengerSchema = new mongoose.Schema({

  passengerId: {
    type: String,
    unique: true,
    required: true
  },

  name: {
    type: String,
    required: true
  },

  email: {
    type: String,
    unique: true,
    required: true
  },

  password: {
    type: String,
    required: true
  }

});

module.exports = mongoose.model("Passenger", passengerSchema);