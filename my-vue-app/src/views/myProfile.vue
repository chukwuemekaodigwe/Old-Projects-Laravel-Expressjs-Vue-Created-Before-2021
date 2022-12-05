<template>
    <ion-page>
      <ion-header translucent>
        <ion-toolbar>
          <ion-buttons slot="start">
            <ion-menu-button></ion-menu-button>
          </ion-buttons>
          <ion-title>Customers Manager</ion-title>
        </ion-toolbar>
      </ion-header>
  
      <ion-content fullscreen>
        <div id="containe">
          <ion-searchbar slot="start" placeholder="search for products.."></ion-searchbar>
          <ion-list>
            <ion-item lines="full" v-for="product in products" :key="product.id">
              <ion-thumbnail slot="start" @click="viewProductImg(product.id)">
                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAAAAAAALAAAAAABAAEAAAICTAEAOw==" />
              </ion-thumbnail>
  
              <ion-label class="ion-text-wrap" @click="viewProduct()">
                <ion-text color="primary">
                  <h1> Name {{product.name}} ({{product.sku}})</h1>
                </ion-text>
                <ion-row>
                    <ion-col class="product-separator">
                    <ion-text color="secondary">
                      <p><strong>Last Seen: {{product.cost_price}}</strong></p>
                    </ion-text>
                  </ion-col>

                  <ion-col class="product-separator">
                    <ion-text color="secondary">
                      <p><strong>Phone N&otilde;: {{product.selling_price}}</strong></p>
                    </ion-text>
                  </ion-col>
                  <ion-col class="product-separator">
                    <ion-text color="secondary">
                      <p><strong>Access Level: {{product.cost_price}}</strong></p>
                    </ion-text>
                  </ion-col>
  
                  <ion-col class="">
                    <ion-text color="success">
                      <p><strong>Address: </strong></p>
                    </ion-text>
                  </ion-col>
                </ion-row>
              </ion-label>
              
              <ion-icon :icon="createOutline" slot="end" @click="editProduct(product.id)"></ion-icon>
              <ion-icon :icon="trashOutline" slot="end" @click="deleteProduct(product.id)"></ion-icon>
            </ion-item>
          </ion-list>
        </div>
  
        <ion-fab vertical="bottom" horizontal="center" slot="fixed">
          <ion-fab-button id="open-modal">
            <ion-icon :icon="add"></ion-icon>
          </ion-fab-button>
        </ion-fab>
  <add-product-modal></add-product-modal>
      </ion-content>
    </ion-page>
  </template>
  
  <script lang="ts">
  
  import {
IonButtons, IonContent, IonFab, IonFabButton,
IonHeader, IonItem, IonLabel, IonList, IonMenuButton,
IonPage, IonTitle,
IonToolbar
} from "@ionic/vue";
import { add, addCircle, createOutline, trashOutline } from "ionicons/icons";
  
  import addProductModal from "@/views/modals/addProductModal.vue";
import { computed } from "vue";
  //import axios from "axios";
  import { useStore } from "vuex";
  /* import { v4 as uuidv4 } from "uuid";
  import { useRoute } from "vue-router";
  import { OverlayEventDetail } from "@ionic/core/components";
  import { shadow } from "@ionic/core/dist/types/utils/transition/ios.transition";
  import { dismiss } from "@ionic/core/dist/types/utils/overlays"; */
  export default {
    name: "ProductList",
    components: {
      addProductModal,
      IonButtons,
      IonContent,
      IonHeader,
      IonMenuButton,
      IonPage,
      IonTitle,
      IonToolbar,
      IonFab,
      IonFabButton,
      IonLabel,
      IonList,
      IonItem
    },
    setup() {
      const store  = useStore();
      
      
      return {
      products: computed(() => store.state.products.products),
      
        add,
        createOutline,
        trashOutline,
        addCircle
      };
    },
  };
  </script>