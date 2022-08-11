<template>
  <app-layout title="Dashboard">
    <template #header>
 
    </template>
    
  </app-layout>
</template>

<script>
import moment from "moment";
import { defineComponent, ref } from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import { Link } from "@inertiajs/inertia-vue3";
import JetButton from '@/Jetstream/Button.vue';
import { useForm } from '@inertiajs/inertia-vue3'
import Pagination from '@/components/Pagination.vue'
import { Inertia } from "@inertiajs/inertia";
export default defineComponent({
    props: ['archivos'],
  components: {
    AppLayout,
    Link,
    JetButton,
    Pagination

  },
  setup() {
      let url = process.env.MIX_APP_URL;

 
      return {
         


      }

  }
});
</script>
