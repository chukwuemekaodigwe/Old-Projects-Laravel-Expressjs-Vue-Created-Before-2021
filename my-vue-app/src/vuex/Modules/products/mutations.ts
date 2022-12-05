import { MutationTree } from "vuex";
import { IProduct, IProductState, defaultState } from "./state";

export enum ProductMutationType {
    createProduct = 'createProduct',
    setProducts = 'setProducts',
    deleteProduct = 'deleteProduct',
    editProduct = 'editProduct',
    updateProduct = 'updateProduct',
    setLoading = 'setLoading',
    setCreateModal = 'setCreateModal',
    setEditModal = 'setEditModal',
    setProductModal = 'setProductModal',
}

export type ProductMutations = {
    [ProductMutationType.createProduct](state: IProductState, product: IProduct): void
    [ProductMutationType.setProducts](state: IProductState, products: IProduct[]): void
    [ProductMutationType.deleteProduct](
        state: IProductState,
        product: Partial<IProduct> & { id: number }
    ): void

    [ProductMutationType.editProduct](
        state: IProductState,
        product: Partial<IProduct> & { id: number }
    ): void

    [ProductMutationType.updateProduct](
        state: IProductState,
        product: Partial<IProduct> & { id: number }
    ): void

    [ProductMutationType.setLoading](state: IProductState, value: boolean): void
    [ProductMutationType.setCreateModal](state: IProductState, value: boolean): void
    [ProductMutationType.setEditModal](state: IProductState, value: { showModal: boolean, productId: number | undefined }): void
    [ProductMutationType.setProductModal](state: IProductState, value: { showModal: boolean, productId: number | undefined }): void
}

export const mutations: MutationTree<IProductState>  = {
    [ProductMutationType.createProduct](state, product) {
        state.products.unshift(product)
        //state.createdData = product
    },

    [ProductMutationType.setProducts](state, Products) {
        state.products = Products
    },
    [ProductMutationType.deleteProduct](state, Product) {
        const product = state.products.findIndex(element => element.id === Product.id)
        if (product === -1) return
        //If Task exist in the state, remove it
        state.products.splice(product, 1)
    },

    [ProductMutationType.updateProduct](state, Product) {
        const index = state.products.findIndex(element => element.id === Product.id)
        if (index === -1) return
        state.products.splice(index, 1, Product)

            //state.updatedData = Product;
            //return true
    
    },

    [ProductMutationType.setLoading](state, value) {
        state.loading = value
        //console.log('I\'m loading')
    },

    [ProductMutationType.setCreateModal](state, value) {
        state.showCreateModal = value
    },

    [ProductMutationType.setEditModal](state, value) {
        state.showEditModal = value
        //state.activeProductId = value.productId
    },

    [ProductMutationType.setProductModal](state, value) {
        state.showProductModal = value
        //state.activeProductId = productId
    },

    setProductIsLoading(state, isLoading) {
        state.isLoading = isLoading
    },

    setProductIsCreating(state, isCreating) {
        state.isCreating = isCreating
    },

    setProductIsUpdating(state, isUpdating) {
        state.isUpdating = isUpdating
    },

    setProductIsDeleting(state, isDeleting) {
        state.isDeleting = isDeleting
    },

    saveNewImage(state, imageObj){
        
        const {...newProduct} = state.activeProduct
        newProduct.product_img = imageObj.blob
        newProduct.imageData = imageObj.imgData

        Object.assign(state.activeProduct, newProduct);
        
    },

    setActiveProduct(state, product) {
        Object.assign(state.activeProduct, product)
        //console.log(state.activeProduct)
      },
    
}

export default mutations