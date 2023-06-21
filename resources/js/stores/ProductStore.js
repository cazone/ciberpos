import axios from 'axios';
import { watchDebounced } from '@vueuse/core'
import { defineStore } from 'pinia'
import { ref , watch, onMounted} from 'vue'
import { usePosStore } from "@/stores/PosStore";

export const useProductStore = defineStore('product', () => {
    const posStore = usePosStore();
    const centerDialogVisible = ref(false);
    const valSearch = ref('');
    const products = ref([]);
    const loading = ref(false);
    const currentRow = ref(null);

    const handleCurrentChange = async(val) => {

        await  posStore.saveSetInvoice(val);
        valSearch.value = '';
        products.value = [];
        currentRow.value = await null;
        centerDialogVisible.value = false;


      }
    const openDialog =  async () => {


        centerDialogVisible.value = true;
      };

      watchDebounced(
        valSearch,
        () => { search()},
        { debounce: 500, maxWait: 1000 },
      )

      const search = async () => {
        loading.value = true;
        const res = await axios.post(route('product.search'),{search :valSearch.value } )
        products.value = res.data.data;
        loading.value = false;

      };

    return {
        centerDialogVisible , openDialog,valSearch, products, loading, currentRow, handleCurrentChange
    }

});