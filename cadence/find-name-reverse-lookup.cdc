/*
Call example:
flow --network='mainnet' scripts -o 'json' execute find-name-reverse-lookup.cdc 0xa7ed1eba0b4b718f
*/

import FIND, Profile from 0x097bafa4e0b48eef

pub fun main(address: Address) :  String? {
    return FIND.reverseLookup(address)
}