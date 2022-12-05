import {createStore} from 'vuex';
import createPersistedState from "vuex-persistedstate"
import productsModule from './Modules/productModule'
import { IProductState } from './Modules/products/state';
import stocks, { stockInterface } from './Modules/stocks';
import stockTransfer, { transferInterface } from './Modules/stockTransfer';

export interface rootState{
    products: IProductState,
    stocks: stockInterface,
    stockTransfer: transferInterface
}
const store = createStore<rootState>({
    plugins: [createPersistedState()],
    modules: {
        products: productsModule,
        inventory: stocks,
        stockTransfer: stockTransfer,

    }
    
    

});

export default store
