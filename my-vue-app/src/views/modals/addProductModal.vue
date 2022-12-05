<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-button color="danger" @click="cancel">
            <ion-icon class="modal-button" size="medium" :icon="arrowBackSharp"></ion-icon>
            <ion-back-button></ion-back-button>
          </ion-button>
        </ion-buttons>
        <ion-title>
          {{ modalTitle }}
        </ion-title>
        <ion-buttons slot="end">
          <ion-button color="success" @click="confirm">
            <ion-icon :icon="checkmarkDoneOutline" size="medium"></ion-icon>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>

    <ion-content class="ion-padding">
      <div v-if="$props.change">
        <ion-item>
          <product-search @product-selected="changeProduct"></product-search>
        </ion-item>
        <ion-row>
          <ion-col size=6>
            <ion-item>
              <ion-label position="stacked">Old Cost Price</ion-label>
              <ion-input type="number" readonly="readonly" v-model="changePrice.cost_price"></ion-input>
            </ion-item>
          </ion-col>

          <ion-col size=6>
            <ion-item>
              <ion-label position="stacked">Old Selling Price</ion-label>
              <ion-input type="number" readonly="readonly" v-model="changePrice.selling_price"></ion-input>
            </ion-item>
          </ion-col>

        </ion-row>

        <ion-row>
          <ion-col size=6>
            <ion-item>
              <ion-label position="stacked">New Cost Price</ion-label>
              <ion-input type="number" v-model="changePrice.new_cost"></ion-input>
            </ion-item>
          </ion-col>

          <ion-col size=6>
            <ion-item>
              <ion-label position="stacked">New Selling Price</ion-label>
              <ion-input type="number" v-model="changePrice.new_selling"></ion-input>
            </ion-item>
          </ion-col>
        </ion-row>
<!-- 
        <ion-row>
          <ion-col size=8>
            <ion-item>
              <ion-label>
                Change on specific stores?
              </ion-label>
              <ion-checkbox color="primary" slot="end" v-model="changePrice.specific_location"></ion-checkbox>
            </ion-item>
          </ion-col>

          <ion-col size=4>
            <ion-item>
              <ion-label position="stacked"> Select store locations</ion-label>
              <ion-select v-model="changePrice.locations" multiple>

                <ion-select-option value="brown">Brown</ion-select-option>
                <ion-select-option value="blonde">Blonde</ion-select-option>
                <ion-select-option value="black">Black</ion-select-option>
                <ion-select-option value="red">Red</ion-select-option>
              </ion-select>
            </ion-item>
          </ion-col>

        </ion-row> -->

      </div>
      <div v-else>

        <ion-grid>
          <ion-row>

            <ion-col size-xs="12" size-md="6">

              <ion-item>
                <ion-label position="stacked">Product Name</ion-label>
                <ion-input :readonly="readonly" v-model="form.name" type="text"></ion-input>
              </ion-item>
              <ion-item>
                <ion-label position="stacked">Product Code/SKU </ion-label>
                <ion-input :readonly="readonly" type="text" v-model="form.sku"></ion-input>
              </ion-item>

              <ion-item>
                <ion-label position="stacked">Initial Cost Price</ion-label>
                <ion-input :readonly="readonly" type="number" v-model="form.cost_price"></ion-input>
              </ion-item>
              <ion-item>
                <ion-label position="stacked">Initial Selling Price</ion-label>
                <ion-input :readonly="readonly" type="number" v-model="form.selling_price"></ion-input>
              </ion-item>

              <ion-item>
                <ion-label position="stacked">Type of Product</ion-label>
                <ion-select :readonly="readonly" v-model="form.productType">
                  <ion-select-option value="brown">Brown</ion-select-option>
                  <ion-select-option value="blonde">Blonde</ion-select-option>
                  <ion-select-option value="black">Black</ion-select-option>
                  <ion-select-option value="red">Red</ion-select-option>
                </ion-select>
              </ion-item>

              <ion-item>
                <ion-label position="stacked">Unit of Measurement</ion-label>
                <ion-select :readonly="readonly" v-model="form.productUnit">
                  <ion-select-option value="brown">Brown</ion-select-option>
                  <ion-select-option value="blonde">Blonde</ion-select-option>
                  <ion-select-option value="black">Black</ion-select-option>
                  <ion-select-option value="red">Red</ion-select-option>
                </ion-select>
              </ion-item>

              <ion-item>
                <ion-label position="stacked">Comment</ion-label>
                <ion-textarea :readonly="readonly" v-model="form.desc" placeholder="optional"></ion-textarea>
              </ion-item>
            </ion-col>

            <ion-col size-xs="12" size-md="6" style="min-height: 300px; height:fit-content">

              <ion-label position="stacked">Product Image</ion-label>
              <image-uploader :image="imageUrl" @save-image="saveImage"></image-uploader>


            </ion-col>
          </ion-row>
        </ion-grid>
      </div>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import {
  IonButtons,
  IonButton, IonBackButton,
  IonHeader,
  IonContent,
  IonToolbar, IonGrid,
  IonTitle, IonRow, IonCol,
  IonItem, IonPage,
  IonInput, IonSelect, IonSelectOption, IonTextarea,
  IonLabel, modalController
} from "@ionic/vue";
import { closeOutline, checkmarkDoneOutline, arrowBackSharp } from "ionicons/icons";
import { defineComponent, computed, ref, onMounted, reactive } from "vue";
import { useStore } from 'vuex';
import ImageUploader from "/src/views/modals/formImage.vue";
import { defaultState, IProduct } from "/src/vuex/Modules/products/state";
import productSearch from '/src/components/useProductSearchModal.vue'

export default defineComponent({
  name: 'addProductModal',
  props: {
    title: {
      type: String
    },

    product: {
      default: defaultState
    },
    change: {
      type: Boolean,
      default: false
    }
  },
  components: {
    IonButtons, productSearch,
    IonButton,

    IonHeader, IonGrid,
    IonContent, IonPage,
    IonToolbar, IonBackButton,
    IonTitle, IonRow, IonCol,
    IonItem,
    IonInput, IonSelect, IonSelectOption, IonTextarea,
    IonLabel, ImageUploader
  },
  setup(props) {

    const store = useStore();
    const changePrice = reactive({
      cost_price: '',
      selling_price: '',
      new_cost: '',
      new_selling: '',

      product: {}
    })
    const form = { ...props.product }
    const modalTitle = ref(props.title)
    const imageUrl = props.product.imageData
    const readonly = computed(() => {
      return (store.state.products.showProductModal == true)

    })
    const cancel = () => {
      modalController.dismiss(null, 'cancel').then(() => {
        store.dispatch('resetProductState')
      })

    };

    function confirm() {
      modalController.dismiss(form, 'confirm').then(() => {
        if (store.state.products.showEditModal) {
          updateProduct(form);
          store.state.products.showEditModal = false
        } else if (store.state.products.showCreateModal) {
          saveNewProduct(form)
          store.state.products.showCreateModal = false
        } else if (props.change) {
          changePrice.product.cost_price = changePrice.new_cost
          changePrice.product.selling_price = changePrice.new_selling
          updateProduct(changePrice.product)

        }
      })
    }

    const saveImage = (image: any) => {
      form.product_img = image.blob
      form.imageData = image.imgData
      //store.commit('saveNewImage', image)

    }

    const saveNewProduct = (data: IProduct) => {

      store.dispatch('actionSaveProduct', data)

    }

    const updateProduct = async function (data: IProduct) {

      await store.dispatch('actionUpdateProduct', data)
    }

    const changeProduct = (product) => {

      if (product) {
        changePrice.selling_price = product.selling_price
        changePrice.cost_price = product.cost_price
        changePrice.product = product
      }
    }

    return {
      form, readonly, changePrice, changeProduct, cancel, confirm, modalTitle, saveImage, imageUrl, arrowBackSharp, checkmarkDoneOutline, closeOutline
    }
  },

});



</script>