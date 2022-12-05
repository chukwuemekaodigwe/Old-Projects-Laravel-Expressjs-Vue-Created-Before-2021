export interface IProduct {
    _id? : string,
    id: string,
    name: string,
    desc?: string,
    cost_price: number,
    selling_price: number,
    sku: string,
    productUnit: string | undefined,
    productType: number,
    imageData?: string,
    product_img?: Blob,
    company_id: string,
    reg_date: Date,
    employee_id: string,
    deleted_at: Date | undefined
}


export const defaultState: IProduct = {
    id: 'PT-' + Date.now,
    name: '',
    desc: '',
    cost_price: 0,
    selling_price: 0,
    sku: '',
    productUnit: '',
    productType: 1,
    
    imageData: '',
    company_id: '',
    reg_date: new Date(),
    employee_id: '',
    deleted_at: undefined
}

export interface IProductState {
    loading: boolean;
    product: IProduct,
    products: IProduct[];
    showCreateModal: boolean;
    showEditModal: boolean;
    showProductModal: boolean;
    
    activeProduct: IProduct,
    isLoading: boolean,
    isCreating: boolean,
    
    isUpdating: boolean,
    
    isDeleting: boolean,
   

}

export const state: IProductState = {
    loading: false,
    product: defaultState,
    products: [],
    showCreateModal: false,
    showEditModal: false,
    showProductModal: false,
    activeProduct: defaultState,
    
    isLoading: false,
    isCreating: false,
    
    isUpdating: false,
    
    isDeleting: false,
    
}
