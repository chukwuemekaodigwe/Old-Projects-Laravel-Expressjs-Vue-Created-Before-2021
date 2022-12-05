import { ActionTree, GetterTree, MutationTree } from "vuex"
import { rootState } from '@/vuex/'

export interface stockInterface {
    _id: string,
    id: string,
    product_id: string,
    location_id: string,
    company_id: string,
    quantity: number,
    registered_by: string,
    created_at: Date,
    deleted_at?: Date,
}

export const defaultStock: stockInterface = {
    _id: '',
    id: '',
    product_id: '',
    location_id: '',
    company_id: '',
    quantity: 0,
    registered_by: '',
    created_at: new Date(),

}

export interface stockStateInterface {
    loading: boolean,
    stock: stockInterface,
    stocks: stockInterface[],
    location: string,
    showCreateModal: boolean,
    showEditModal: boolean,
    showProductModal: boolean,
    isLoading: boolean,
    isCreating: boolean,
    isUpdating: boolean,
    isDeleting: boolean,

}

export const stockState: stockStateInterface = {
    loading: false,
    stock: defaultStock,
    stocks: [],
    location: '',
    showCreateModal: false,
    showEditModal: false,
    showProductModal: false,
    isLoading: false,
    isCreating: false,
    isUpdating: false,
    isDeleting: false,
}

export const stockMutation: MutationTree<stockStateInterface> = {
    addStock(state, newStock) {
        state.stocks.unshift(newStock)
    },

    deleteStock(state, stock: stockInterface) {
        const d = state.stocks.findIndex(element => element.id == stock.id)
        if (d === -1) return
        state.stocks.splice(d, 1, stock)
    },

    updateStock(state, stock: stockInterface) {
        const d = state.stocks.findIndex(element => element.id == stock.id)
        if (d === -1) return
        state.stocks.splice(d, 1, stock)
    },

    getStockByProduct(state , id: string) {
        const a = state.stocks.filter((e) => (e._id === id)).reduce((element1, element) => {

            return element1 + element.quantity
        }, 0)

      //  console.log(a)
        return a
    },

    setLoading(state, value) {
        state.loading = value
        //console.log('I\'m loading')
    },

    setCreateModal(state, value) {
        state.showCreateModal = value
    },

    setEditModal(state, value) {
        state.showEditModal = value
        //state.activeProductId = value.productId
    },

    setProductModal(state, value) {
        state.showProductModal = value
        //state.activeProductId = productId
    },

    setStockIsLoading(state, isLoading) {
        state.isLoading = isLoading
    },

    setStockIsCreating(state, isCreating) {
        state.isCreating = isCreating
    },

    setStockIsUpdating(state, isUpdating) {
        state.isUpdating = isUpdating
    },

    setStockIsDeleting(state, isDeleting) {
        state.isDeleting = isDeleting
    },

    getStockByLocation(state, location){
        if(location == 1) return state.stocks
        const stocks = state.stocks.filter((e)=> e.location_id === location)
        return stocks

    }

    

}

export const stockAction: ActionTree<stockStateInterface, rootState> = {
    addNewStock({ commit }, newStock) {
        commit('addStock', newStock)
    },

    updateStock({ commit }, Stock) {
        commit('updateStock', Stock)
    },

    loadStockByLocation({commit}, location) {
commit('getStockByLoaction', location)
    },

    
}

export const stockGetters: GetterTree<stockStateInterface, rootState> = {

     loadStock(state, getters , rootState) {
        const Products = rootState.products.products.filter((element) => element.deleted_at == undefined).sort()
        const inventoryArray =  Products.map((element)=>{
            
            state.stocks.filter(item => item.product_id == element.id).reduce((n, e)=>{
                element.quantity += e.quantity
                 element.location += (e.location_id) ? 1 : 0
            })
        })

        console.log(inventoryArray);
    },


    // sortStockAlphabet(state, rootState) {
    //       const  storeKey = rootState.products.state
    //         console.log('running mutation');
    //         const jobs = this.state.jobs;
    //         jobs.sort((a, b) => {
    //             let compare = 0;
    //             if (a[sortKey] > b[sortKey]) {
    //                 compare = 1;
    //             } else if (b[sortKey] > a[sortKey]) {
    //                 compare = -1;
    //             }
    //             return compare;
    //         });
    //         state.jobs = jobs;
    //     }
    // },
}


export default {
    state: stockState,
    mutations: stockMutation,
    actions: stockAction,
    getters: stockGetters
}