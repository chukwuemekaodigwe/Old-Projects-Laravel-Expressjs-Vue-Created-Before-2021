import { rootState } from "@/vuex"
import { ActionContext, ActionTree } from "vuex"
import { IProduct, IProductState, defaultState } from "./state"
//  import { saveNewProduct, updateProduct } from "../../dbconnect"

export const actions: ActionTree<IProductState, rootState> = {

  async setActiveProduct(context, id) {
   // await context.dispatch('resetProductState').then(()=>{
      const presentProduct = context.getters.getProductById(id)
      //context.commit('setActiveProduct', presentProduct)
      return presentProduct
   // })
    


    //return presentProduct
  },

  resetProductState({ commit }) {

    //this.dispatch('setupCompanyProduct')
    commit('setCreateModal', false)
    commit('setEditModal', false)
    commit('setProductIsCreating', false)
    commit('setProductIsLoading', false)
    commit('setProductModal', false)
    commit('setProductIsUpdating', false)
    commit('setProductIsDeleting', false)
  },

   actionSaveProduct({ commit, dispatch }, product: IProduct) {

    //saveNewProduct(product);
    commit('createProduct', product)
    dispatch('resetProductState')
    
    //

  },
  actionUpdateProduct({ commit, dispatch }, product: IProduct) {
    commit('updateProduct', product)
    dispatch('resetProductState')
  },
  actionDeleteProduct({ commit, dispatch }, product: IProduct) {
    commit('deleteProduct', product)
    dispatch('resetProductState')
  },
  searchProduct({ state }, searchkey) {
     return state.products.filter((element: IProduct, index, searchResult) => {
      //console.log(index)
      return (element.name.toLowerCase().includes(searchkey) || element.sku.toLowerCase().includes(searchkey))

    })
    
    
  },
  /**
   * 
   * @param param0 Active product houses the recent activated active product
   * Product houses the default product setting of the company
   */

  async setupCompanyProduct({ state }) {
    const company_id = ('STR-' + Date.now().toString().slice(5))
    const employee_id = 'EM-001';
  //commit('setupProduct', { company_id, employee_id })

    //Object.assign(state, resetState)
    const storeP = defaultState;
    storeP.company_id = company_id
    storeP.employee_id = employee_id
    storeP.id = employee_id + '/' + 'PT'+ Date.now()
    return storeP
  },

  deleteProductState({ state }) {
    state.products = []
    //return state.products
  },

 
}