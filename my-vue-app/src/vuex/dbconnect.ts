import PouchDb from "//cdn.jsdelivr.net/npm/pouchdb@7.3.0/dist/pouchdb.min.js";
import { IProduct } from "./Modules/products/state";
require('pouchdb-adapter-cordova-sqlite')


const productDB = new PouchDb('store_products')
const employeesDB = new PouchDB('employees')
const stockDB = new PouchDb('inventory')
const customersDB = new PouchDb('customers')
const salesDB = new PouchDb('sales')

export function saveNewProduct(product:IProduct){
    product._id = product.id
    productDB.put(product).then((res)=>{
        console.log(res)
    }).catch((err) => {
        console.log(err)
    })
}

export function updateProduct(oldProduct:IProduct, newProduct:IProduct){

    productDB.get(oldProduct.id).then((product)=>{
        return productDB.put({
            ...newProduct,
            _rev: product._rev
        }).then((res)=>{
            console.log(res)
        })
    })
}

