<template>
    <ion-page>
      <ion-header translucent>
        <ion-toolbar>
          <ion-buttons slot="start">
            <ion-menu-button></ion-menu-button>
          </ion-buttons>
          <ion-title>Stock Manager</ion-title>
        </ion-toolbar>
      </ion-header>
  
      <ion-content fullscreen>
        <div id="">
          <ion-searchbar slot="start" placeholder="Type to search by location, storeroom, date....."></ion-searchbar>
          
          <ion-list>
            <ion-item lines="full" v-for="product in products" :key="product.id">
              <ion-thumbnail slot="start" @click="viewProductImg(product.id)">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAAAAAAALAAAAAABAAEAAAICTAEAOw==" />
              </ion-thumbnail>
  
              <ion-label class="ion-text-wrap" @click="viewProduct()">
                <ion-text color="primary">
                  <h1> {{product.name}} ({{product.sku}})</h1>
                </ion-text>
                <ion-row>
                  <ion-col class="product-separator" size="3">
                    <ion-text color="secondary">
                      <p><strong>Total Stock: {{product.selling_price}}</strong></p>
                    </ion-text>
                  </ion-col>
                  <ion-col class="product-separator" size="8">
                    <ion-text color="secondary">
                      <p><strong>Transferred: {{product.cost_price}}</strong></p>
                    </ion-text>
                  </ion-col>
  
                  <ion-col class="">
                    <ion-text :color="status?success:warning">
                      <p><strong>Status: </strong></p>
                    </ion-text>
                  </ion-col>
                </ion-row>
              </ion-label>
              <ion-icon :icon="add" slot="end" title="add more" @click="editProduct(product.id)"></ion-icon>
              <ion-icon :icon="createOutline" title="Edit" slot="end" @click="editProduct(product.id)"></ion-icon>
              <ion-icon :icon="sendSharp" title="transfer" slot="end" @click="deleteProduct(product.id)"></ion-icon>
            </ion-item>
          </ion-list>
        </div>
  
        <ion-fab vertical="bottom" horizontal="center" slot="fixed">
          
        <ion-button color="primary" id="open-modal">Add Stock</ion-button>
        <ion-button color="success" id="transfer-modal"> Transfer</ion-button>
        <ion-button color="danger"> Acknowlegde</ion-button>
        
      
        </ion-fab>
  <add-stock-modal></add-stock-modal>
  <transfer-stock-modal></transfer-stock-modal>
      </ion-content>
    </ion-page>
  </template>
  
  <script lang="ts">
  
  import {
IonButtons, IonContent, IonFabButton,
IonHeader, IonItem, IonLabel, IonList, IonMenuButton,
IonPage, IonTitle,
IonToolbar
} from "@ionic/vue";
import { add, createOutline, sendSharp, trashOutline, warning } from "ionicons/icons";
  
  import addStockModal from "@/views/modals/addStockModal.vue";
import transferStockModal from "@/views/modals/transferStockModal.vue";

import { computed, ref } from "vue";
  //import axios from "axios";
  import { useStore } from "vuex";
import TransferStockModal from "./modals/transferStockModal.vue";
  /* import { v4 as uuidv4 } from "uuid";
  import { useRoute } from "vue-router";
  import { OverlayEventDetail } from "@ionic/core/components";
  import { shadow } from "@ionic/core/dist/types/utils/transition/ios.transition";
  import { dismiss } from "@ionic/core/dist/types/utils/overlays"; */
  export default {
    name: "ProductList",
    components: {
    addStockModal,
    IonButtons,
    IonContent,
    IonHeader,
    IonMenuButton,
    IonPage,
    IonTitle,
    IonToolbar,
    transferStockModal,
    IonFabButton,
    IonLabel,
    IonList,
    IonItem,
    TransferStockModal
},
    setup() {
      const store  = useStore();
      const status = ref(false)
      
      return {
      products: computed(() => store.state.products.products),
      status,
        add,
        createOutline,
        trashOutline,
        sendSharp
      };
    },
  };
  </script>