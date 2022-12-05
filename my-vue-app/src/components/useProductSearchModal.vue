<template>

    <ion-input type="text" readonly @click="openSearch" placeholder="Click to search for products"
        v-model="selected"></ion-input>

    <ion-modal :is-open="isOpen" :initialBreakpoint="0.5" :breakpoints="[0, 0.25, 0.50]" @didDismiss="closeModal()">

        <ion-content class="ion-padding">
            <ion-searchbar placeholder="search by product name or sku" :debounce="100" @ionChange="searchProducts()"
                autofocus="true" v-model="searchkey"></ion-searchbar>
            <ion-list v-if="products">
                <ion-item button lines="full" v-for="product in products" :key="product.id"
                    @click="selectProduct(product)">
                    <ion-avatar slot="start">
                        <ion-img :src="product.imageData"></ion-img>
                    </ion-avatar>
                    <ion-label>
                        <h4>{{ product.name.toUpperCase() }}</h4>
                        <small> SKU: {{ product.sku }}</small>

                    </ion-label>
                </ion-item>
            </ion-list>
            <ion-list v-else>
                <ion-label>No active products yet</ion-label>
            </ion-list>
        </ion-content>

    </ion-modal>

</template>

<script lang="ts">
import {
    IonContent, IonModal, IonPage, IonImg, IonList, IonSearchbar, IonItem, IonLabel, IonAvatar, IonInput
} from "@ionic/vue"
import { useStore } from 'vuex'
import { ref, reactive, defineComponent, computed } from 'vue'


export default defineComponent({
    name: 'productSearchModal',
    components: {
        IonContent, IonModal, IonImg, IonPage, IonList, IonItem, IonLabel, IonAvatar, IonInput, IonSearchbar
    },

    setup(props, context) {
        const store = useStore()
        const selected = ref('')
        const searchkey = ref('')
        const products = ref(store.state.products.products)

        const isOpen = ref(false)
        const openSearch = () => {
            isOpen.value = true;
        }

        const closeModal = () => {
            isOpen.value = false;
        }
        const searchProducts = () => {
            const term = searchkey.value
            if (term == '') {
                products.value = store.state.products.products
            } else {
                store.dispatch('searchProduct', term.toLowerCase()).then((a) => {
                    products.value = JSON.parse(JSON.stringify(a))
                })
            }
        }
        const selectProduct = (event) => {
            selected.value = event.name

            context.emit('productSelected', event)
            isOpen.value = false
        }

        return { isOpen, searchkey, closeModal, openSearch, products, searchProducts, selected, selectProduct }
    },
});
</script>