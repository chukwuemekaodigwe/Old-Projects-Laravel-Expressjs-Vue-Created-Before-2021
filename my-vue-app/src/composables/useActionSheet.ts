import { actionSheetController } from "@ionic/vue"
import { ref } from "vue";
import { useStore } from "vuex";
import { modalController, alertController } from "@ionic/vue";
import imageModal from "@/views/modals/imageModal.vue"

export const useActionSheet = async () => {
  const actionSheet = await actionSheetController.create({
    header: 'Are you sure ?',
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

  await actionSheet.present();
  const { role } = await actionSheet.onWillDismiss();
  return role
}

export const useImageModal = async (image, header, editPath, viewPath) => {

  const src = (image);

  const alert = await alertController.create({
    header: header,
    //subHeader: 'Important message',
    message: `<div class="cont">
      <div class="img-position">
        <ion-img src="${src}">
  
        </ion-img>
      </div>
      <div class="img-modal-footer">
        <Ion-buttons>
          <ion-button color="danger" @click="">
            EDIT <!--<ion-icon :icon="createOutline" slot="start"></ion-icon>-->
          </ion-button>
          <ion-button color="primary" @click="">
          VIEW  
          <!-- <ion-icon :icon="informationCircleOutline" slot="end"></ion-icon>-->
          </ion-button>
        </Ion-buttons>
      </div>
    </div>`,
    cssClass: 'img-modal',
    animated: true,
    // buttons: [
    //   {
    //     text: '&bigstar;',
    //     role: 'cancel',
    //     handler: () => {
    //       handlerMessage.value = 'Alert canceled';
    //     },
    //   },
    //   {
    //     text: 'OK',
    //     role: 'confirm',
    //     handler: () => {
    //       handlerMessage.value = 'Alert confirmed';
    //     },
    //   },
    // ],
  });

  await alert.present();
};


export const useSearchProduct = () => {
  const store = useStore()
  const searchkey = ref('')

  const p = store.state.products.products
  const products = ref(p)


  function searchproducts() {
    const search = searchkey.value
    if (search == '') {
      products.value = store.state.products.products
    } else {

      store.dispatch('searchProduct', search.toLowerCase()).then((a) => {
        products.value = JSON.parse(JSON.stringify(a))
      })
    }

  }
  return { searchkey, products, searchproducts }

}

