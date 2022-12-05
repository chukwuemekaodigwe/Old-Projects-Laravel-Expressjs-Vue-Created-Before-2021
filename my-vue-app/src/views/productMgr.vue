<template>
  <ion-page>
    <ion-header translucent>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-menu-button></ion-menu-button>
        </ion-buttons>
        <ion-title> Products</ion-title>

      </ion-toolbar>
      <ion-toolbar>
        <ion-searchbar placeholder="search by name, sku" v-model="searchkey" @ionChange="searchproducts()">
        </ion-searchbar>
      </ion-toolbar>
    </ion-header>

    <ion-content fullscreen>
      <div id="containe">

        <ion-list>
          <ion-item button lines="full" v-for="product in products" :key="product.id">
            <ion-thumbnail slot="start" @click="viewProductImg(product.id)">
              <img
                :src="product.imageData == '' ? 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAAAAAAALAAAAAABAAEAAAICTAEAOw==' : product.imageData" />
            </ion-thumbnail>

            <ion-label class="ion-text-wrap" @click="viewProduct(product.id)">
              
                <h4> {{ product.name }} ({{ product.sku }})</h4>
              
              <ion-row>
                <ion-col class="separator" size-md="4" size-xs="12">
                  
                    <small>Selling Price: {{ product.selling_price }}</small>
                  
                </ion-col>
                <ion-col class="separator" size-md="4" size-xs="12">
                  
                <small>    Cost Price: {{ product.cost_price }} </small>
                  
                </ion-col>
              
              </ion-row>
            </ion-label>
            <ion-icon :icon="createOutline" slot="end" @click="editProduct(product.id)"></ion-icon>
            <ion-icon :icon="trashOutline" slot="end" @click="deleteProduct(product.id)"></ion-icon>
          </ion-item>

        </ion-list>
      </div>


      <ion-fab vertical="bottom" horizontal="end" slot="fixed">
        <ion-fab-button color="primary" @click="addProduct()">
          <ion-icon :icon="add" size="3"></ion-icon>
        </ion-fab-button>
        <ion-fab-button color="success" @click="changePriceModal()">
          <ion-icon :icon="createOutline" size="3"></ion-icon>
        </ion-fab-button>


      </ion-fab>

      <update-price></update-price>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
//Number.NEGATIVE_INFINITY;
import {
  IonButtons,
  IonMenuButton,
  IonPage,
  IonList,
  IonItem,
  IonFab,
  IonContent,
  IonLabel,
  IonFabButton,
  IonHeader, IonText, IonSearchbar, IonThumbnail, IonIcon,
  IonTitle,
  IonToolbar, IonRow, modalController
} from "@ionic/vue";
import { add, trashOutline, informationCircleOutline, createOutline, search } from "ionicons/icons";
import { computed, onMounted, reactive, ref } from "vue";
import showModal from "/src/views/modals/addProductModal.vue";
import { useActionSheet, useImageModal } from "../composables/useActionSheet"

//import axios from "axios";
import { useStore } from "vuex";
import { defaultState, IProduct } from "/src/vuex/Modules/products/state.ts";
import { useRouter, useRoute } from 'vue-router'

export default {
  name: "ProductList",
  components: {

    IonButtons,
    IonContent,
    IonHeader, IonText, IonSearchbar, IonThumbnail, IonIcon,
    IonMenuButton,
    IonPage,
    IonTitle,
    IonToolbar, IonRow,
    IonFab,
    IonFabButton,
    IonLabel,
    IonList,
    IonItem,
  },
  setup() {
    const store = useStore();
    const route = useRoute()
    //   const router = useRouter()


    const searchkey = ref('')

    const p = store.state.products.products
    const products = ref(p)

    //const products = reactive({...st})
    const addProduct = async () => {
      await store.dispatch('setupCompanyProduct').then((data) => {
        store.state.products.showCreateModal = true
        productModal('New Product', data)
      })

    }

    function viewProductImg(id: string) {
      store.dispatch('setActiveProduct', id).then((product) => {
        useImageModal(product.imageData, product.name, `/products/edit/:${product.id}`, `/products/view/:${product.id}`)
      })

    }

    const editProduct = (id: string) => {
      //console.log(id)
      store.dispatch('setActiveProduct', id).then((product) => {
        store.state.products.showEditModal = true
        productModal(`Update ${product.name}`, product);
      })
      //console.log(store.state.products)

    }

    const viewProduct = (id: string) => {
      //console.log(id)
      store.dispatch('setActiveProduct', id).then((product) => {
        //console.log(store.state.products)
        store.state.products.showProductModal = true
        productModal(product.name, product)
      })

    }

    const deleteProduct = async (id: string) => {

      const role = await useActionSheet()
      if (role === 'confirm') {
        store.dispatch('setActiveProduct', id).then((product) => {
          store.dispatch('actionDeleteProduct', product)
        })

      }

    }

    const changePriceModal = () => {
      productModal('Update Product Price', defaultState, true)
    }

    const productModal = async function (title: string, product: IProduct, change = false) {
      const modal = await modalController.create({
        component: showModal,
        componentProps: { title, product, change },
        animated: true
      });

      modal.present();

      modal.canDismiss = async () => {
        const res = await useActionSheet()
        return res === 'confirm';
      }
    }

    function searchproducts() {
      let search = searchkey.value
      if (search == '') {
        products.value = store.state.products.products
      } else {
        store.dispatch('searchProduct', search.toLowerCase()).then((a) => {
          products.value = JSON.parse(JSON.stringify(a))
        })
      }

    }
    return {
      changePriceModal,
      editProduct, addProduct, viewProductImg, viewProduct, deleteProduct, productModal,
      add, searchproducts, searchkey,
      createOutline, informationCircleOutline,
      trashOutline, products

    };
  },
};
</script>

<style>
.img-modal .alert-head {
  padding: 5px;
  text-align: center;
  color: transparent;
  background: #000;
  opacity: .5;
}

.img-modal .alert-wrapper {
  position: relative;

}

.img-modal .alert-message {
  padding: 0px;

  max-height: 300px;
}

.img-modal .alert-title {
  text-align: center;
  color: gold;

}

.img-modal .alert-button-group {
  padding: 0px;
  background-color: black;
}

.cont {
  display: flex;
  flex-flow: column nowrap;
  height: inherit;

}

.img-position {
  height: 250px;
  width: 100%;
}

.img-position ion-img {
  height: inherit;
}

.img-modal-footer {
  height: 50px;
  border-top: 1px solid gray;
  display: flex;
  flex-flow: row nowrap;
  justify-content: space-around;


}

.img-modal-footer ion-buttons {
  padding: 10px;
}

.separator{
  margin: 0 !important;
  padding: 1px !important;
  height: 20px;

}


</style>