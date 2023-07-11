/*
Call example:
flow --network='mainnet' scripts execute get-packs-in-collection.cdc 0x6237d86a2ad32f51
*/

import SportvatarPack from 0xca5c31c0c03e11be

pub fun main(address: Address): [UInt64]? {
    return SportvatarPack.getPacks(address: address)
}