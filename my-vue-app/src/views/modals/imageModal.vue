<template>
    
        <div id="example-modal">
            <div class="wrapper">
                <div id="img-position">
                    <ion-img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAAAAACH5BAAAAAAALAAAAAABAAEAAAICTAEAOw==">
                    </ion-img>
                </div>
                <div id="footer">
                    <ion-buttons>
                        <ion-button>
                            <ion-icon name="heart"></ion-icon>
                        </ion-button> |
                        <ion-button>
                            <ion-icon name="heart"></ion-icon>
                        </ion-button> |
                        <ion-button>
                            <ion-icon name="heart"></ion-icon>
                        </ion-button>
                    </ion-buttons>
                </div>
            </div>
        </div>
</template>


<style>
#example-modal {
    --width: 250px;
    --max-width: 250px;
    --height: 250px;
    --border-radius: 10px 0px;
    --box-shadow: 0 28px 48px rgba(0, 0, 0, 0.4);
}

#example-modal #img-position {
    width: 100%;
    height: 200px;
}

#example-modal ion-icon {

    width: 8px;
    height: 8px;
}

#example-modal .wrapper {
    margin-bottom: 10px;
}
#footer{

}

#footer ion-buttons {
    display: flex;
    align-items: center;
    justify-content: space-between;

}
</style>


<script lang="ts">
import {
    IonButton,
    IonModal,
    IonHeader,
    IonContent,
    IonToolbar,
    IonTitle,
    
    IonIcon, IonImg
} from '@ionic/vue';
import { personCircle, heart } from 'ionicons/icons';
import { defineComponent } from 'vue';

export default defineComponent({
    components: {
        IonButton,
        IonModal,
        IonHeader,
        IonContent,
        IonToolbar,
        IonTitle,
        IonImg,
        IonIcon, 
    },
    methods: {
        dismiss() {
            //this.$refs.modal.$el.dismiss();
        },
    },
    setup() {
        return { personCircle, heart };
    }
});
</script>

<style>

</style>