<template>
  <ion-page>

    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-button color="danger" @click="cancel">Cancel</ion-button>
        </ion-buttons>
        <ion-title>Modal</ion-title>
        <ion-buttons slot="end">
          <ion-button color="success" @click="confirm">Confirm</ion-button>
        </ion-buttons>
      </ion-toolbar>

    </ion-header>
    <ion-content class="ion-padding">
      
          <ion-searchbar placeholder="search by name, sku" v-model="searchkey"></ion-searchbar>
          <ion-list>
            <ion-item @click="selectproduct" v-for="product in products" :key="product.id">
              <ion-label>{{ product.name }}</ion-label>
            </ion-item>
          </ion-list>
        
        <ion-row>
          <ion-col size=6>
            <ion-item>
              <ion-label position="stacked">Stock Quantity</ion-label>
              <ion-input type="number"></ion-input>
            </ion-item>
          </ion-col>

          <ion-col size=6>
            <ion-item>
              <ion-label position="stacked">Initial Location</ion-label>

              <ion-select>
                <ion-select-option value="brown">Brown</ion-select-option>
                <ion-select-option value="blonde">Blonde</ion-select-option>
                <ion-select-option value="black">Black</ion-select-option>
                <ion-select-option value="red">Red</ion-select-option>
              </ion-select>
            </ion-item>
          </ion-col>
        </ion-row>

    </ion-content>
  </ion-page>

</template>

<script lang="ts">
import {
  IonButtons,
  IonButton,
  IonPage,
  IonHeader,
  IonContent,
  IonToolbar,
  IonTitle,
  IonItem,
  IonInput,
  IonLabel, actionSheetController, modalController
} from "@ionic/vue";
import { OverlayEventDetail } from "@ionic/core/components";
import { defineComponent, ref, reactive, onMounted } from "vue";
import { useStore } from 'vuex';

export default defineComponent({
  name: 'addStock',
  components: {
    IonButtons,
    IonButton,
    IonPage,
    IonHeader,
    IonContent,
    IonToolbar,
    IonTitle,
    IonItem,
    IonInput,
    IonLabel,
  },
  setup() {
    const store = useStore();
    const form = reactive({})
    const searchkey = ref('')

    const p = store.state.products.products
    const products = ref(p)

    function searchproducts() {
      const search = searchkey.value
      console.log(searchkey.value)
      
      if (search == '') {
        products.value = store.state.products.products
      } else {
        store.dispatch('searchProduct', search.toLowerCase()).then((a) => {
          products.value = JSON.parse(JSON.stringify(a))
        })


      }

    }

    function selectproduct(ev) {
      var a = ev.detail.value
      console.log(a)
    }
    const cancel = () => {
      return modalController.dismiss(null, 'cancel');
    };

    function confirm() {
      modalController.dismiss(form, 'confirm');
      const res = store.commit('CREATE_PRODUCT', form)

    }

    const canDismiss = async () => {
      const actionSheet = await actionSheetController.create({
        header: 'Are you sure?',
        buttons: [
          {
            text: 'Yes',
            role: 'confirm',
          },
          {
            text: 'No',
            role: 'cancel',
          },
        ],
      });
      actionSheet.present();
      const { role } = await actionSheet.onWillDismiss();
      return role === 'confirm';
    };

    const onWillDismiss = (ev: CustomEvent<OverlayEventDetail>) => {
      if (ev.detail.role === "confirm") {
        //Message.value = `Hello, ${ev.detail.data}!`;
      }
    };

    return {
      onWillDismiss, canDismiss, form, cancel, selectproduct, products, confirm, searchkey, searchproducts
    }
  }
});


</script>