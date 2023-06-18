/*
Call example:
flow --network='mainnet' scripts execute get-sportvatars-in-collection.cdc 0xc967ab07284b463f
*/

import Sportvatar from 0xca5c31c0c03e11be

pub fun main(address: Address): [Sportvatar.SportvatarData] {
    return Sportvatar.getSportvatars(address: address)
}