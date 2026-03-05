const { ethers } = require("ethers");
require("dotenv").config();

// Debug ENV
console.log("🔗 RPC:", process.env.RPC_URL);
console.log("🔑 KEY:", process.env.PRIVATE_KEY ? "Loaded" : "Missing");
console.log("📜 CONTRACT:", process.env.PASSENGER_CONTRACT_ADDRESS);

// Provider
const provider = new ethers.JsonRpcProvider(
  process.env.RPC_URL
);

// Wallet
const wallet = new ethers.Wallet(
  process.env.PRIVATE_KEY,
  provider
);

// ABI
const PASSENGER_ABI =
  require("../../blockchain/artifacts/contracts/PassengerContract.sol/PassengerContract.json").abi;

// Contract
const passengerContract = new ethers.Contract(
  process.env.PASSENGER_CONTRACT_ADDRESS,
  PASSENGER_ABI,
  wallet
);

module.exports = {
  passengerContract
};