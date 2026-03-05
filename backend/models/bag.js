const mongoose = require("mongoose");

const bagSchema = new mongoose.Schema({

  ticketId: {
    type: String,
    required: true,
    unique: true
  },

  bagId: {
    type: String,
    unique: true
  },

  flightId: {
    type: String,
    required: true
  },

  from: {
    type: String,
    required: true
  },

  to: {
    type: String,
    required: true
  },

  type: {
    type: String,
    required: true
  },

  weight: {
    type: Number,
    required: true
  },

  status: {
    type: String,
    default: "Registered"
  },

  location: {
    type: String,
    default: ""
  },

  createdAt: {
    type: Date,
    default: Date.now
  }

});

module.exports = mongoose.model("Bag", bagSchema, "bags");