<template>

    <div class="cont">
      <ion-img @click="ClickImage()" class="img" :src="imageUrl" />
   <ion-buttons class="btn">
      <!-- <ion-button v-if="render" @click="Save()">Save</ion-button> -->
      <ion-button color="primary" @click="ClickImage()"> Upload</ion-button>
      <ion-button color="danger" v-if="render" @click="Clear()">Clear</ion-button>
    </ion-buttons>
    </div>

</template>

<script lang="ts">
import { IonContent, IonImg, IonButton, IonButtons } from '@ionic/vue';
import { defineComponent, ref, computed } from 'vue';
import { useStore } from "vuex";
import { Camera, CameraResultType } from '@capacitor/camera';


export default defineComponent({
  
props: {
  image: {
    default: 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAAAAAAALAAAAAABAAEAAAICTAEAOw==',
    type: String
  }
},

  setup(props){
  const imageUrl = ref(props.image)
  const render = computed(() => {return imageUrl.value == '' ? false : true})
    const store = useStore()
    const checkAvailable = () => {
      if(props.image != ''){
        imageUrl.value = props.image
      }
    }

    checkAvailable()
    return{
      store, imageUrl, render, 
    }
  }, 
  name: 'ImageUploader',
  components: {
    IonButtons,
    IonButton,
    IonImg
  },
  methods: {
    async Clear() {
      this.imageUrl = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAAAAAAALAAAAAABAAEAAAICTAEAOw==';
      this.render = false;
    },
    async ClickImage() {
      await Camera.getPhoto({
        quality: 60,
        allowEditing: true,
        resultType: CameraResultType.Uri,
        promptLabelHeader: 'Select Image Source',

      }).then((image) => {
        //console.log(image)
        this.render = true;
        this.imageUrl = String(image.webPath)
        this.Save().then((data) => {
          //console.log(data)
          this.$emit('saveImage', data);
        })
        
        
       // this.store.commit('saveNewImage', imageObj)

      });
    },

    convertBlobToBase64(blob: Blob) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader;
        reader.onerror = reject;
        reader.onload = () => {
          resolve(reader.result);
        };
        reader.readAsDataURL(blob);
      });
    },
    
    async Save() {
      const response = await fetch(this.imageUrl);
      const blob = await response.blob();
      const base64Data = await this.convertBlobToBase64(blob) as string;
      
      //console.log(base64Data);

      //   const savedFile = await Filesystem.writeFile({
      //       path: new Date().getTime() + '.jpeg',
      //       data: base64Data,
      //       directory: Directory.Documents
      // });

      return {'blob': blob, 'imgData': base64Data}
    },

    /*
      pickImage(sourceType) {
        const options: CameraOptions = {
          quality: 100,
          sourceType: sourceType,
          destinationType: this.camera.DestinationType.DATA_URL,
          encodingType: this.camera.EncodingType.JPEG,
          mediaType: this.camera.MediaType.PICTURE
        }
    
        this.camera.getPicture(options).then((imageData) => {
          // imageData is either a base64 encoded string or a file URI
          this.croppedImagePath = 'data:image/jpeg;base64,' + imageData;
        }, (err) => {
          // Handle error
        });
      }
    
      async selectImage() {
        const actionSheet = await this.actionSheetController.create({
          header: "Select Image source",
          buttons: [{
            text: 'Load from Library',
            handler: () => {
              this.pickImage(this.camera.PictureSourceType.PHOTOLIBRARY);
            }
          },
          {
            text: 'Use Camera',
            handler: () => {
              this.pickImage(this.camera.PictureSourceType.CAMERA);
            }
          },
          {
            text: 'Cancel',
            role: 'cancel'
          }
          ]
        });
        await actionSheet.present();
      }
    }*/
  }
});

</script>


<style scoped>
.cont {
  
  display: flex;
  width: 100%;
  justify-content: center;
  align-items: center;
  margin-top: 12px;
}
.btn{
  background-color: black;
  color: #fff;
  font-weight: bold;
}
.img {
  height: 300px;
  width: 300px;
}
</style>