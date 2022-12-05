import { GetterTree } from "vuex";
import { rootState } from "@/vuex";
import { IProductState, IProduct } from "./state";

export type GettersType = {
    totalProductCount(state: IProductState): number
    getProductById(state: IProductState): (id: string) => IProduct | undefined
    getProducts(state: IProductState): IProduct[]
}

export const getters: GetterTree<IProductState, rootState> & GettersType = {
    totalProductCount(state) {
        return state.products.filter(element => element.deleted_at == undefined).length
    },
    getProductById: (state) => (id: string) => {
        return state.products.find(product => product.id === id)
    },
    
    getProducts: (state) => {
        return state.products.filter(element => element.deleted_at != undefined)
    },
    productList: state => state.products,
    product: state => state.product,
    isLoading: state => state.isLoading,
    isCreating: state => state.isCreating,
    isUpdating: state => state.isUpdating,
    isDeleting: state => state.isDeleting,
    
}

