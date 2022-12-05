<template>
  <IonApp>
    <IonSplitPane content-id="main-content">
      <ion-menu content-id="main-content" type="overlay">
        <ion-content>
          <ion-list id="unit-list">
            <ion-list-header> Inventory System</ion-list-header>

            <ion-menu-toggle
              auto-hide="false"
              v-for="(p, i) in appPages"
              :key="i"
            
            >
              <ion-item
                @click="selectedIndex = i"
                router-direction="root"
                :router-link="p.url"
                lines="none"
                detail="false"
                class="hydrated"
                :class="{ selected: p.url === route.path }"
              >
                <ion-icon
                  slot="start"
                  :ios="p.iosIcon"
                  :md="p.mdIcon"
                ></ion-icon>
                <ion-label>{{ p.title }}</ion-label>
              </ion-item>
            </ion-menu-toggle>
          </ion-list>
        </ion-content>
      </ion-menu>
      <ion-router-outlet id="main-content"></ion-router-outlet>
    </IonSplitPane>
  </IonApp>
</template>

<script lang="ts">
import {
  IonApp,
  IonContent,
  IonIcon,
  IonItem,
  IonLabel,
  IonList,
  IonListHeader,
  IonMenu,
  IonMenuToggle,
  IonRouterOutlet,
  IonSplitPane,
} from "@ionic/vue";
import { defineComponent, ref } from "vue";
import { useRoute } from "vue-router";
import {
  layersOutline,
  pricetagsOutline,
  cashOutline,
  homeOutline,
  medkitOutline,
  settingsOutline,
  personCircleOutline,
  peopleOutline,
cartOutline,
} from "ionicons/icons";

export default defineComponent({
  name: "App",
  components: {
    IonApp,
    IonContent,
    IonIcon,
    IonItem,
    IonLabel,
    IonList,
    IonListHeader,
    IonMenu,
    IonMenuToggle,
    IonRouterOutlet,
    IonSplitPane,
  },
  setup() {
    const selectedIndex = ref(0);
    const appPages = [
      {
        title: "Home",
        url: "/",
        iosIcon: homeOutline,
        mdIcon: homeOutline,
      },
      {
        title: "Products Manager ",
        url: "/products",
        iosIcon: pricetagsOutline,
        mdIcon: pricetagsOutline,
      },

      {
        title: "Stocks Manager ",
        url: "/inventory",
        iosIcon: layersOutline,
        mdIcon: layersOutline,
      },
      {
        title: "Sales Front ",
        url: "/storeFront",
        iosIcon: cartOutline,
        mdIcon: cartOutline,
      },
      {
        title: "Customers Manager ",
        url: "/customers",
        iosIcon: peopleOutline,
        mdIcon: peopleOutline,
      },
      {
        title: "Staff Manager ",
        url: "/employees",
        iosIcon: medkitOutline,
        mdIcon: medkitOutline,
      },
      {
        title: "Settings",
        url: "/system_settings",
        iosIcon: settingsOutline,
        mdIcon: settingsOutline,
      },
      {
        title: "Profile ",
        url: "/profile",
        iosIcon: personCircleOutline,
        mdIcon: personCircleOutline,
      },
    ];
    const route = useRoute();

    return {
      selectedIndex,
      appPages,
      cashOutline,
      route,
    };
  },
});
</script>

<style scoped>
ion-menu ion-content {
  --background: var(--ion-item-background, var(--ion-background-color, #fff));
}

#main-content {
  overflow-y: scroll !important;
}
ion-menu.md ion-content {
  --padding-start: 8px;
  --padding-end: 8px;
  --padding-top: 20px;
  --padding-bottom: 20px;
}

ion-menu.md ion-list {
  padding: 20px 0;
}

ion-menu.md ion-note {
  margin-bottom: 30px;
}

ion-menu.md ion-list-header,
ion-menu.md ion-note {
  padding-left: 15px;
}

ion-menu.md ion-list#unit-list {
  border-bottom: 1px solid var(--ion-color-step-150, #d7d8da);
}

ion-menu.md ion-list#unit-list ion-list-header {
  font-size: 22px;
  font-weight: 600;
  min-height: 20px;
}

.selected {
  font-weight: bold;
}
</style>


<style>
ion-menu-button {
  color: var(--ion-color-primary);
}

#container {
  text-align: center;
  position: absolute;
  left: 0;
  right: 0;
}

#container strong {
  font-size: 20px;
  line-height: 26px;
}

#container p {
  font-size: 16px;
  line-height: 22px;
  color: #8c8c8c;
  margin: 0;
}

#container a {
  text-decoration: none;
}
</style>
