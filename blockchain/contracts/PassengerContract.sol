// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract PassengerContract {

    struct PassengerRecord {
        string passengerId;
        string name;
        string location;
        uint256 bags;
        uint256 time;
    }

    PassengerRecord[] public records;

    // Add passenger history
    function addPassengerRecord(
        string memory _passengerId,
        string memory _name,
        string memory _location,
        uint256 _bags
    ) public {

        records.push(
            PassengerRecord(
                _passengerId,
                _name,
                _location,
                _bags,
                block.timestamp
            )
        );
    }

    // Get all records
    function getAllRecords()
        public
        view
        returns (PassengerRecord[] memory)
    {
        return records;
    }
}