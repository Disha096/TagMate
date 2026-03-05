const mongoose = require("mongoose");

const passengerBlockSchema = new mongoose.Schema({

  index: Number,

  passengerId: String,

  name: String,

  location: String,

  bags: Number,

  time: {
    type: Date,
    default: Date.now
  },

  previousHash: String,

  hash: String

});

module.exports = mongoose.model(
  "PassengerBlock",
  passengerBlockSchema,
  "passengerBlocks"
);