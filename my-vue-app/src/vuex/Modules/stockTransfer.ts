import { ActionContext, ActionTree, GetterTree, MutationTree } from "vuex"
import { rootState } from '@/vuex'

export interface transferInterface {
    id?: string,
    product: string,
    quantity: number,
    location_from: string,
    location_to: string,
    sent_by: string,
    received_by?: string,
    created_at: Date,
    updated_at?: Date
}


export const defaultTransfer = {
    id: '',
    product: '',
    quantity: 0,
    location_from: '',
    location_to: '',
    sent_by: '',
    received_by: '',
    created_at: new Date
}

export interface transferState {
    transferList : transferInterface[]
    transfer : transferInterface
    company_id : string,
    location: string
}

export const transferState = {
    transferList : [],
    transfer : defaultTransfer,
    company_id : '',
    location: ''
}

export const transferMutation: MutationTree<transferState> = {
    saveTransfer(state, payload){
        state.transferList.unshift(payload)

    },
    receivetransfer(state, {transfer, employee}){
        const index = state.transferList.findIndex(element => element.id === transfer.id)
        transfer.received_by = employee
        state.transferList.splice(index, 1, transfer)

    }
}

export const transferAction: ActionTree<transferState, rootState> = {
    makeTransfer({commit, rootState}, newTransfer: transferInterface){
        
        commit('saveTransfer', newTransfer)
    }
}
export const transferGetters: GetterTree<transferState, rootState> = {
    countTransferByLocation(state){
        state.transferList.filter((element) => {
            return (element.location_to === state.location) && (element.received_by == '')

        })
    },

}



export default {
   state: transferState,
   mutation: transferMutation,
    action: transferAction,
   getters:  transferGetters
}