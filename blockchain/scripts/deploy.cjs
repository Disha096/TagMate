const hre = require("hardhat");

async function main() {

  // Get contract factory
  const Passenger = await hre.ethers.getContractFactory(
    "PassengerContract"
  );

  // Deploy
  const passenger = await Passenger.deploy();

  // Wait for deployment (ethers v5)
  await passenger.deployed();

  // Print address (ethers v5)
  console.log(
    "PassengerContract deployed to:",
    passenger.address
  );
}

main().catch((err) => {
  console.error(err);
  process.exit(1);
});