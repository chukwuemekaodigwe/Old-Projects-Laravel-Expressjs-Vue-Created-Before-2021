<template>
    <ion-modal ref="modal" trigger="new-customer-modal" :is-open="false" :can-dismiss="canDismiss"
        @willDismiss="onWillDismiss" animated="true" swipe-to-close="true">

        <ion-header>
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-button color="danger" @click="cancel">Cancel</ion-button>
                </ion-buttons>
                <ion-title>Modal</ion-title>
                <ion-buttons slot="end">
                    <ion-button class="btn btn-primary" color="success" @click="confirm">Confirm</ion-button>
                </ion-buttons>
            </ion-toolbar>
        </ion-header>
        <ion-content class="ion-padding">
            <form>
                <ion-item>
                    <ion-label position="stacked">Client Name</ion-label>
                    <ion-input v-model="form.name" type="text"></ion-input>
                </ion-item>
                <ion-item>
                    <ion-label position="stacked">Company Name (optional)</ion-label>
                    <ion-input v-model="form.desc"></ion-input>
                </ion-item>
                <ion-row>
                    <ion-col size-6>
                        <ion-item>
                            <ion-label position="stacked">Email</ion-label>
                            <ion-input v-model="form.desc"></ion-input>
                        </ion-item>

                    </ion-col>

                    <ion-col size-6>
                        <ion-item>
                            <ion-label position="stacked">Phone No</ion-label>
                            <ion-input type="text" v-model="form.selling_price"></ion-input>
                        </ion-item>
                    </ion-col>
                </ion-row>

                <ion-item>
                    <ion-label position="stacked">Company Address</ion-label>
                    <ion-input type="text" v-model="form.cost_price"></ion-input>
                </ion-item>

                <ion-row>
                    <ion-col size-6>

                        <ion-item>
                            <ion-label position="stacked">Store Location</ion-label>
                            <ion-select v-model="form.productType">
                                <ion-select-option value="brown">Brown</ion-select-option>
                                <ion-select-option value="blonde">Blonde</ion-select-option>
                                <ion-select-option value="black">Black</ion-select-option>
                                <ion-select-option value="red">Red</ion-select-option>
                            </ion-select>
                        </ion-item>
                    </ion-col>
                    <ion-col size="6">
                        <ion-item>
                            <ion-label position="stacked">Client Picture</ion-label>
                            <ion-input type="file" accept="image" v-model="form.image_url"></ion-input>
                        </ion-item>
                    </ion-col>
</ion-row>
            </form>
        </ion-content>
    </ion-modal>

</template>

<script lang="ts">
import {
    IonButtons,
    IonButton,
    IonModal,
    IonHeader,
    IonContent,
    IonToolbar,
    IonTitle,
    IonItem,
    IonInput,
    IonLabel, actionSheetController, modalController
} from "@ionic/vue";
import { OverlayEventDetail } from "@ionic/core/components";
import { defineComponent, ref, reactive } from "vue";
import { useStore } from 'vuex';
import { IProduct } from '@/vuex/Modules/products/state'
import { ProductMutationType } from "@/vuex/Modules/products/mutations";

export default defineComponent({
    name: 'addProductModal',
    components: {
        IonButtons,
        IonButton,
        IonModal,
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
            onWillDismiss, canDismiss, form, cancel, confirm
        }
    }
});


</script>