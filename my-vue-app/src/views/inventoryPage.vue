<template>
  <ion-page>
    <ion-header translucent>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-menu-button></ion-menu-button>
        </ion-buttons>
        <ion-title>Stock Manager</ion-title>
      </ion-toolbar>
      <ion-toolbar>
        <ion-searchbar placeholder="search by name, sku, location, quantity" v-model="searchkey"
          @ionChange="searchStocks()">
        </ion-searchbar>
      </ion-toolbar>
    </ion-header>

    <ion-content fullscreen>

      <ion-list>
        <ion-item button lines="full" v-for="product in products" :key="product.id">
          <ion-thumbnail slot="start" @click="viewProductImg(product.id)">
            <img
              :src="product.imageData == '' ? 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAAAAAAALAAAAAABAAEAAAICTAEAOw==' : product.imageData" />
          </ion-thumbnail>

          <ion-label class="ion-text-wrap" @click="viewStock(product.id)">
            <ion-text color="primary">
              <h2> {{ product.name }} ({{ product.sku }})</h2>
            </ion-text>

            <ion-row>
              <ion-col size="4">
                <ion-text color="success">
                  <p><strong>Status: </strong>{{ !false ? 'In Stock' : 'Out of Stock' }}</p>
                </ion-text>
              </ion-col>

              <ion-col class="product-separator" size="8">
                <ion-text color="">
                  <p><strong>N&otilde; in Stock: {{ }} </strong>
                    In {{ product.cost_price }}
                    locations
                  </p>
                </ion-text>
              </ion-col>
            </ion-row>
          </ion-label>

          <ion-icon :icon="add" slot="end" title="add more" @click="addStock(product.id)"></ion-icon>
          <ion-icon :icon="createOutline" title="Edit" slot="end" @click="editStock(product.id)"></ion-icon>
          <ion-icon :icon="sendSharp" title="transfer" slot="end" @click="deleteProduct(product.id)"></ion-icon>

        </ion-item>
      </ion-list>

      <ion-fab vertical="bottom" horizontal="end" slot="fixed">
        <ion-fab-button color="success" id="transferStock">
          <ion-icon :icon="shareOutline" size="3"></ion-icon>
        </ion-fab-button>
        <ion-fab-button color="primary" @click="addStock()">
          <ion-icon :icon="add" size="3"></ion-icon>
        </ion-fab-button>

      </ion-fab>

    </ion-content>
  </ion-page>
</template>
  
<script lang="ts">

import {
  IonButtons, IonContent, IonHeader, IonItem, IonLabel, IonList, IonMenuButton,
  IonPage, IonTitle, IonRow, IonCol, IonIcon,
  IonToolbar, IonGrid, modalController
} from "@ionic/vue";
import { add, create, createOutline, shareOutline, sendSharp, trashOutline } from "ionicons/icons";
import addStockModal from "/src/views/modals/addStockModal.vue"
import { useImageModal, useActionSheet } from "/src/composables/useActionSheet"
import { computed, onMounted, ref } from "vue";
//import axios from "axios";
import { useStore } from "vuex";

export default {
  name: "inventoryPage",
  components: {
    IonIcon,
    IonButtons,
    IonContent,
    IonHeader,
    IonMenuButton,
    IonPage,
    IonTitle,
    IonToolbar,
    IonGrid,
    IonLabel,
    IonList,
    IonItem, IonCol, IonRow
  },

  setup() {
    const store = useStore()
    const products = ref({})

    const loadStock = () => {
      const stocks = store.dispatch('loadStockByLocation', 1)
      const cmplStocks = stocks.map((element, index) => {
        return element.product = store.getters.getProductById(element.product_id)
      })

      products.value = cmplStocks
    }

    onMounted(() => {loadStock()})
    const addStock = async () => {
      await store.dispatch('setupCompanyProduct').then((data) => {

        store.state.products.showCreateModal = true
        stockModal('New Product', data)
      })

    }

    function viewProductImg(id: string) {
      store.dispatch('setActiveProduct', id).then((product) => {
        useImageModal(product.imageData, product.name, `/products/edit/:${product.id}`, `/products/view/:${product.id}`)
      })

    }

    const editStock = (id: string) => {
      //console.log(id)
      store.dispatch('setActiveProduct', id).then((product) => {
        store.state.products.showEditModal = true
        stockModal(`Update ${product.name}`, product);
      })
    }

    const viewStock = (id: string) => {
      store.dispatch('setActiveProduct', id).then((product) => {
        store.state.products.showProductModal = true
        stockModal(product.name, product)
      })

    }

    async function stockModal(title, product?, change = false) {
      const modal = await modalController.create({
        component: addStockModal,
        componentProps: { title, product, change },
        animated: true
      })

      modal.present()

      modal.canDismiss = async () => {
        const res = await useActionSheet()
        return res === 'confirm'
      }

    }

      return {

        addStock, viewProductImg, editStock, viewStock,
        products, createOutline,
        add,shareOutline,trashOutline, sendSharp
      }
    
    },
  }
</script>