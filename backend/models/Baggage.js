const mongoose = require("mongoose");

const BaggageSchema = new mongoose.Schema({
  bagId: String,
  owner: String,
  status: String
});

module.exports = mongoose.model("Baggage", BaggageSchema);
